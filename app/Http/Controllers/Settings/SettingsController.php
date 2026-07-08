<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\StoreIdentityRequest;
use App\Http\Requests\Settings\StorePaymentMethodRequest;
use App\Http\Requests\Settings\UpdateNotificationPreferencesRequest;
use App\Http\Requests\Settings\UpdatePasswordRequest;
use App\Http\Requests\Settings\UpdatePrivacySettingsRequest;
use App\Models\IdentityVerification;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function identity(Request $request)
    {
        return view('settings.identity', [
            'verification' => $request->user()->identityVerification,
        ]);
    }

    public function storeIdentity(StoreIdentityRequest $request)
    {
        $data = $request->validated();
        $data['ktp_photo'] = $request->file('ktp_photo')->store('identity', 'private');
        $data['selfie_photo'] = $request->file('selfie_photo')->store('identity', 'private');
        $data['status'] = 'pending';

        IdentityVerification::create([
            ...$data,
            'user_id' => $request->user()->id,
        ]);

        return redirect()->route('settings.identity')->with('success', 'Data verifikasi identitas terkirim.');
    }

    public function security(Request $request)
    {
        return view('settings.security', ['user' => $request->user()]);
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $request->user()->update([
            'password' => $request->validated('password'),
        ]);

        return back()->with('success', 'Password berhasil diubah.');
    }

    public function toggle2fa(Request $request)
    {
        $user = $request->user();
        $user->update(['two_factor_enabled' => ! $user->two_factor_enabled]);

        return back()->with('success', $user->two_factor_enabled ? '2FA diaktifkan.' : '2FA dinonaktifkan.');
    }

    public function notifications(Request $request)
    {
        $prefs = $request->user()->notificationPreferences()
            ->firstOrCreate(['user_id' => $request->user()->id]);

        return view('settings.notifications', compact('prefs'));
    }

    public function updateNotifications(UpdateNotificationPreferencesRequest $request)
    {
        $request->user()->notificationPreferences()->updateOrCreate(
            ['user_id' => $request->user()->id],
            $request->validated(),
        );

        return back()->with('success', 'Preferensi notifikasi disimpan.');
    }

    public function privacy(Request $request)
    {
        $settings = $request->user()->privacySettings()
            ->firstOrCreate(['user_id' => $request->user()->id]);

        return view('settings.privacy', compact('settings'));
    }

    public function updatePrivacy(UpdatePrivacySettingsRequest $request)
    {
        $request->user()->privacySettings()->updateOrCreate(
            ['user_id' => $request->user()->id],
            $request->validated(),
        );

        return back()->with('success', 'Pengaturan privasi disimpan.');
    }

    public function paymentMethods(Request $request)
    {
        $methods = $request->user()->paymentMethods;

        return view('settings.payment-methods', compact('methods'));
    }

    public function storePaymentMethod(StorePaymentMethodRequest $request)
    {
        $data = $request->validated();
        $user = $request->user();

        if ($data['is_default'] ?? false) {
            $user->paymentMethods()->update(['is_default' => false]);
        }

        $user->paymentMethods()->create($data);

        return back()->with('success', 'Metode pembayaran ditambahkan.');
    }

    public function destroyPaymentMethod(Request $request, PaymentMethod $paymentMethod)
    {
        if ($paymentMethod->user_id !== $request->user()->id) {
            abort(403);
        }

        $paymentMethod->delete();

        return back()->with('success', 'Metode pembayaran dihapus.');
    }

    public function account(Request $request)
    {
        return view('settings.account', ['user' => $request->user()]);
    }

    public function deactivate(Request $request)
    {
        $request->user()->update(['is_active' => false]);
        auth()->logout();

        return redirect()->route('home')->with('success', 'Akun dinonaktifkan.');
    }
}
