<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Services\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct(private ProfileService $profileService) {}

    public function edit(Request $request)
    {
        $user = $request->user();

        return view('profile.edit', compact('user'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = $this->profileService->update(
            $request->user(),
            $request->safe()->except(['profile_photo']),
            $request->file('profile_photo'),
        );

        if ($request->expectsJson()) {
            return response()->json(['user' => $user]);
        }

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil disimpan.');
    }
}
