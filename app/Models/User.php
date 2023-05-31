<?php

namespace App\Models;


use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function types()
    {
        return $this->hasMany(\App\Models\Type::class);
    }

    public function brands()
    {
        return $this->hasMany(\App\Models\Brand::class);
    }

    public function products()
    {
        return $this->hasMany(\App\Models\Product::class);
    }
    public function dosedurations()
    {
        return $this->hasMany(\App\Models\Doseduration::class);
    }
    public function doseintervals()
    {
        return $this->hasMany(\App\Models\Doseinterval::class);
    }
    public function timings()
    {
        return $this->hasMany(\App\Models\Timing::class);
    }
    public function schemes()
    {
        return $this->hasMany(\App\Models\Scheme::class);
    }
    /**
     * Get the user's most recent order/Prescription.
     */
    public function latestOrder() //latestPrescription
    {
        return $this->hasOne(Prescription::class)->latestOfMany();
    }
}
