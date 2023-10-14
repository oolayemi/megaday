<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids, HasRoles; //SoftDeletes

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'phone',
        'email',
        'password',
        'provider',
        'fcm_token',
        'image_url',
        'banner_image',
        'phone_verified_at',
        'is_vendor_verified',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'fcm_token',
        'created_at',
        'updated_at',
        'provider',
        'email_verified_at',
        'phone_verified_at',
        'roles',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_vendor_verified' => 'boolean',
    ];

    protected $appends = ['unread_notification_count', 'is_email_verified', 'is_phone_verified'];

    public function virtualAccount(): HasOne
    {
        return $this->hasOne(VirtualAccount::class);
    }

    public function unreadNotificationCount(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->notifications()
                ->where('is_read', false)
                ->count(),
        );
    }

    public function isEmailVerified(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->email_verified_at != null,
        );
    }

    public function isPhoneVerified(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->phone_verified_at != null,
        );
    }

    public function otp(): HasOne
    {
        return $this->hasOne(Otp::class);
    }

    public function wallet(): HasOne
    {
        return $this->hasOne(Wallet::class);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    public function feedbacks(): HasMany
    {
        return $this->hasMany(Feedback::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function views(): HasMany
    {
        return $this->hasMany(ProductView::class);
    }

    public function impressions(): HasMany
    {
        return $this->hasMany(ProductImpression::class);
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }

    public function favourites(): HasMany
    {
        return $this->hasMany(Favourite::class);
    }

    public function wishLists(): HasMany
    {
        return $this->hasMany(WishList::class);
    }

    public function reportAbuses(): HasMany
    {
        return $this->hasMany(ReportAbuse::class);
    }

    public function callBacks(): HasMany
    {
        return $this->hasMany(CallBack::class);
    }
}
