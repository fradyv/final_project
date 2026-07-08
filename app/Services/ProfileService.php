<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\UploadedFile;

class ProfileService
{
    public function update(User $user, array $data, ?UploadedFile $photo = null): User
    {
        if ($photo) {
            $data['profile_photo'] = $photo->store('profiles', 'public');
        }

        if ($user->isLegalNameLocked() && isset($data['legal_name'])) {
            unset($data['legal_name']);
        }

        unset($data['email']);

        $user->update($data);

        return $user->fresh();
    }
}
