<?php

namespace App\Http\Controllers;

use App\Http\Requests\FundraiserVerification\StoreFundraiserVerificationRequest;
use Illuminate\Http\Request;

class FundraiserVerificationController extends Controller
{
    // Step-by-step form data from the flow description, submitted as one payload here.
    public function store(StoreFundraiserVerificationRequest $request)
    {
        $data = $request->validated();

        // Sensitive documents are stored in a private (non-public) disk,
        // never directly web-accessible - only served through an authorized controller.
        foreach (['ktp_photo', 'selfie_and_ktp_photo', 'statement_letter', 'other_documents'] as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = $request->file($field)->store('verifications', 'private');
            }
        }

        $data['status'] = 'pending';

        $verification = $request->user()->fundraiser()->create($data);

        return response()->json([
            'message' => 'Pengajuan verifikasi terkirim, menunggu peninjauan admin.',
            'verification' => $verification,
        ], 201);
    }

    public function show(Request $request)
    {
        $verification = $request->user()->fundraiser;

        return response()->json(['verification' => $verification]);
    }
}
