<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminFundraiserController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminWithdrawalController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DigitalProductController;
use App\Http\Controllers\FundraiserVerificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Settings\SettingsController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\WithdrawalController;
use App\Enums\PaymentStatus;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $campaigns = \App\Models\Campaign::where('status', 'active')
        ->orderByDesc('current_amount')
        ->take(4)
        ->get();

    $products = \App\Models\Product::with(['shop', 'campaign'])
        ->where('stock', '>', 0)
        ->inRandomOrder()
        ->take(13)
        ->get();

    $totalUsers = \App\Models\User::count();
    $totalHeroes = \App\Models\Role::where('name', 'penggalang')->first()?->users()->count() ?? 0;
    $totalSaviors = \App\Models\Order::where('payment_status', PaymentStatus::Paid)->distinct('user_id')->count('user_id');
    $programsSupported = \App\Models\Campaign::where('status', 'active')->count();

    $heroes = \App\Models\User::whereHas('roles', fn ($q) => $q->where('name', 'penggalang'))
        ->orWhereHas('shop')
        ->with(['shop.products' => fn ($q) => $q->take(3)])
        ->inRandomOrder()
        ->take(8)
        ->get();

    return view('index', compact('campaigns', 'products', 'totalUsers', 'totalHeroes', 'totalSaviors', 'programsSupported', 'heroes'));
})->name('home');

Route::get('/login', fn () => view('login.signin'))->name('login')->middleware('guest');
Route::get('/register', fn () => view('login.signup'))->name('register')->middleware('guest');

Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1')->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:5,1')->name('register.post');

Route::get('/products', [DigitalProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [DigitalProductController::class, 'show'])->name('products.show');
Route::get('/products/{product}/reviews', [ProductReviewController::class, 'index'])->name('products.reviews');
Route::get('/campaigns', [CampaignController::class, 'index'])->name('campaigns.index');
Route::get('/campaigns/{campaign}', [CampaignController::class, 'show'])->name('campaigns.show');
Route::get('/campaigns/{campaign}/products', [CampaignController::class, 'products'])->name('campaigns.products');
Route::get('/shops/{shop}', [ShopController::class, 'show'])->name('shops.show');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/me', [AuthController::class, 'me'])->name('me');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Settings
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/identity', [SettingsController::class, 'identity'])->name('identity');
        Route::post('/identity', [SettingsController::class, 'storeIdentity'])->name('identity.store');
        Route::get('/security', [SettingsController::class, 'security'])->name('security');
        Route::put('/security/password', [SettingsController::class, 'updatePassword'])->name('security.password');
        Route::post('/security/2fa/toggle', [SettingsController::class, 'toggle2fa'])->name('security.2fa');
        Route::get('/notifications', [SettingsController::class, 'notifications'])->name('notifications');
        Route::put('/notifications', [SettingsController::class, 'updateNotifications'])->name('notifications.update');
        Route::get('/privacy', [SettingsController::class, 'privacy'])->name('privacy');
        Route::put('/privacy', [SettingsController::class, 'updatePrivacy'])->name('privacy.update');
        Route::get('/payment-methods', [SettingsController::class, 'paymentMethods'])->name('payment-methods');
        Route::post('/payment-methods', [SettingsController::class, 'storePaymentMethod'])->name('payment-methods.store');
        Route::delete('/payment-methods/{paymentMethod}', [SettingsController::class, 'destroyPaymentMethod'])->name('payment-methods.destroy');
        Route::get('/account', [SettingsController::class, 'account'])->name('account');
        Route::post('/account/deactivate', [SettingsController::class, 'deactivate'])->name('account.deactivate');
    });

    // Cart & Checkout
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::delete('/cart/{product}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    // Orders (riwayat pembelian)
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    // Toko & Produk
    Route::post('/shops', [ShopController::class, 'store'])->name('shops.store');
    Route::put('/shops/{shop}', [ShopController::class, 'update'])->name('shops.update');
    Route::post('/products', [DigitalProductController::class, 'store'])->name('products.store');
    Route::put('/products/{product}', [DigitalProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [DigitalProductController::class, 'destroy'])->name('products.destroy');
    Route::post('/products/{product}/reviews', [ProductReviewController::class, 'store'])->name('products.reviews.store');

    // Verifikasi penggalang
    Route::post('/fundraiser-verifications', [FundraiserVerificationController::class, 'store'])->name('fundraiser.store');
    Route::get('/fundraiser-verifications/me', [FundraiserVerificationController::class, 'show'])->name('fundraiser.show');

    // Penggalang: campaign & wallet
    Route::middleware(['role:penggalang', 'fundraiser.approved'])->group(function () {
        Route::post('/campaigns', [CampaignController::class, 'store'])->name('campaigns.store');
        Route::put('/campaigns/{campaign}', [CampaignController::class, 'update'])->name('campaigns.update');
        Route::get('/wallet', [WithdrawalController::class, 'index'])->name('wallet.index');
        Route::post('/withdrawals', [WithdrawalController::class, 'store'])->name('withdrawals.store');
    });

    // Admin
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('/stats', [AdminDashboardController::class, 'index'])->name('stats');
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::patch('/users/{user}/deactivate', [AdminUserController::class, 'deactivate'])->name('users.deactivate');
        Route::get('/fundraisers', [AdminFundraiserController::class, 'index'])->name('fundraisers.index');
        Route::patch('/fundraisers/{fundraiser}/approve', [AdminFundraiserController::class, 'approve'])->name('fundraisers.approve');
        Route::patch('/fundraisers/{fundraiser}/reject', [AdminFundraiserController::class, 'reject'])->name('fundraisers.reject');
        Route::get('/identity', [AdminFundraiserController::class, 'identityIndex'])->name('identity.index');
        Route::patch('/identity/{verification}/approve', [AdminFundraiserController::class, 'approveIdentity'])->name('identity.approve');
        Route::patch('/identity/{verification}/reject', [AdminFundraiserController::class, 'rejectIdentity'])->name('identity.reject');
        Route::get('/withdrawals', [AdminWithdrawalController::class, 'index'])->name('withdrawals.index');
        Route::patch('/withdrawals/{withdrawalRequest}/approve', [AdminWithdrawalController::class, 'approve'])->name('withdrawals.approve');
        Route::patch('/withdrawals/{withdrawalRequest}/reject', [AdminWithdrawalController::class, 'reject'])->name('withdrawals.reject');
    });
});
