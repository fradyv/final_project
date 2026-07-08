<?php

namespace App\Http\Controllers\Admin;

use App\Enums\FundraiserStatus;
use App\Enums\IdentityVerificationStatus;
use App\Http\Controllers\Controller;
use App\Models\Fundraiser;
use App\Models\IdentityVerification;
use App\Models\Role;
use App\Models\Wallet;

class AdminFundraiserController extends Controller
{
    public function index()
    {
        $fundraisers = Fundraiser::with('user:id,name,email')
            ->latest()
            ->paginate(20);

        return view('admin.fundraisers.index', compact('fundraisers'));
    }

    public function approve(Fundraiser $fundraiser)
    {
        if ($fundraiser->status === FundraiserStatus::Approved) {
            return back()->with('error', 'Penggalang sudah disetujui.');
        }

        $fundraiser->update(['status' => FundraiserStatus::Approved]);

        $penggalangRole = Role::firstOrCreate(['name' => 'penggalang']);
        $fundraiser->user->roles()->syncWithoutDetaching([$penggalangRole->id]);

        Wallet::firstOrCreate(
            ['fundraiser_id' => $fundraiser->id],
            ['balance' => 0],
        );

        return back()->with('success', 'Penggalang disetujui.');
    }

    public function reject(Fundraiser $fundraiser)
    {
        $fundraiser->update(['status' => FundraiserStatus::Rejected]);

        return back()->with('success', 'Pengajuan penggalang ditolak.');
    }

    public function identityIndex()
    {
        $verifications = IdentityVerification::with('user:id,name,email')
            ->latest()
            ->paginate(20);

        return view('admin.identity.index', compact('verifications'));
    }

    public function approveIdentity(IdentityVerification $verification)
    {
        $verification->update([
            'status'      => IdentityVerificationStatus::Approved,
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ]);

        $verification->user->update([
            'legal_name'           => $verification->legal_name,
            'legal_name_locked_at' => now(),
        ]);

        return back()->with('success', 'Identitas disetujui. Nama legal dikunci.');
    }

    public function rejectIdentity(\Illuminate\Http\Request $request, IdentityVerification $verification)
    {
        $verification->update([
            'status'      => IdentityVerificationStatus::Rejected,
            'admin_notes' => $request->input('admin_notes'),
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ]);

        return back()->with('success', 'Identitas ditolak.');
    }
}
