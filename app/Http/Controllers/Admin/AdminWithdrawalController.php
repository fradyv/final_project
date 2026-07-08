<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WithdrawalRequest;
use App\Services\WithdrawalService;
use Illuminate\Http\Request;

class AdminWithdrawalController extends Controller
{
    public function __construct(private WithdrawalService $withdrawalService) {}

    public function index()
    {
        $requests = WithdrawalRequest::with(['fundraiser.user:id,name', 'campaign:id,title'])
            ->latest()
            ->paginate(20);

        return view('admin.withdrawals.index', compact('requests'));
    }

    public function approve(Request $request, WithdrawalRequest $withdrawalRequest)
    {
        $this->withdrawalService->approve(
            $withdrawalRequest,
            $request->user(),
            $request->input('admin_notes'),
        );

        return back()->with('success', 'Penarikan disetujui.');
    }

    public function reject(Request $request, WithdrawalRequest $withdrawalRequest)
    {
        $request->validate(['admin_notes' => 'required|string|max:500']);

        $this->withdrawalService->reject(
            $withdrawalRequest,
            $request->user(),
            $request->input('admin_notes'),
        );

        return back()->with('success', 'Penarikan ditolak.');
    }
}
