<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'referral_code',
        'is_active',
        'bio',
        'instagram',
        'facebook',
        'whatsapp',
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
            'is_active' => 'boolean',
        ];
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    /**
     * Check if user is sales
     */
    public function isSales(): bool
    {
        return $this->hasRole('sales');
    }

    /**
     * Get the sales page for this user
     */
    public function salesPage(): HasOne
    {
        return $this->hasOne(SalesPage::class);
    }

    /**
     * Get the referral codes for this user
     */
    public function referralCodes(): HasMany
    {
        return $this->hasMany(ReferralCode::class);
    }

    /**
     * Get the testimonials for this user
     */
    public function testimonials(): HasMany
    {
        return $this->hasMany(Testimonial::class);
    }

    /**
     * Get the referral code for this user (single, for admin panel compatibility)
     */
    public function referralCode(): HasOne
    {
        return $this->hasOne(ReferralCode::class, 'user_id');
    }

    /**
     * Scope for active users
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for admin users
     */
    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    /**
     * Scope for sales users
     */
    public function scopeSales($query)
    {
        return $query->where('role', 'sales');
    }

    /**
     * Boot method to assign roles automatically
     */
    protected static function booted()
    {
        static::created(function ($user) {
            // Assign role based on the role field
            if ($user->role === 'admin') {
                $user->assignRole('admin');
            } elseif ($user->role === 'sales') {
                $user->assignRole('sales');
            }
        });

        static::updated(function ($user) {
            // Update role if role field changes
            if ($user->isDirty('role')) {
                $user->syncRoles([$user->role]);
            }
        });
    }
}
