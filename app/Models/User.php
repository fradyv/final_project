<?php

namespace App\Models;

<<<<<<< HEAD
// use Illuminate\Contracts\Auth\MustVerifyEmail;
=======
>>>>>>> master
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

<<<<<<< HEAD
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
=======
    protected $fillable = [
        'name',
        'display_name',
        'legal_name',
        'email',
        'password',
        'phone_number',
        'address',
        'profile_photo',
        'bio',
        'donate_anonymously',
        'is_active',
        'legal_name_locked_at',
        'two_factor_enabled',
        'two_factor_secret',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at'   => 'datetime',
            'password'            => 'hashed',
            'is_active'           => 'boolean',
            'donate_anonymously'  => 'boolean',
            'legal_name_locked_at' => 'datetime',
            'two_factor_enabled'  => 'boolean',
>>>>>>> master
        ];
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

<<<<<<< HEAD
    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

=======
>>>>>>> master
    public function fundraiser()
    {
        return $this->hasOne(Fundraiser::class);
    }

<<<<<<< HEAD
    public function otps()
    {
        return $this->hasMany(Otp::class);
    }

    public function shops()
    {
        return $this->hasMany(Shop::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class, 'donor_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'buyer_id');
=======
    public function shop()
    {
        return $this->hasOne(Shop::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
>>>>>>> master
    }

    public function productReviews()
    {
        return $this->hasMany(ProductReview::class);
    }
<<<<<<< HEAD
=======

    public function identityVerification()
    {
        return $this->hasOne(IdentityVerification::class);
    }

    public function notificationPreferences()
    {
        return $this->hasOne(UserNotificationPreference::class);
    }

    public function privacySettings()
    {
        return $this->hasOne(UserPrivacySetting::class);
    }

    public function paymentMethods()
    {
        return $this->hasMany(PaymentMethod::class);
    }

    public function hasRole(string $role): bool
    {
        return $this->roles()->where('name', $role)->exists();
    }

    public function hasAnyRole(array $roles): bool
    {
        return $this->roles()->whereIn('name', $roles)->exists();
    }

    public function isFundraiserApproved(): bool
    {
        return $this->fundraiser()->where('status', 'approved')->exists();
    }

    public function isPenggalang(): bool
    {
        return $this->hasRole('penggalang') && $this->isFundraiserApproved();
    }

    public function publicDisplayName(): string
    {
        return $this->display_name ?? $this->name;
    }

    public function isLegalNameLocked(): bool
    {
        return $this->legal_name_locked_at !== null
            || $this->identityVerification?->status === \App\Enums\IdentityVerificationStatus::Approved;
    }
>>>>>>> master
}
