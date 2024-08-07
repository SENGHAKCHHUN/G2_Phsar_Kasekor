<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Frontuser extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    public $guard = 'front';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'bio',
        'phone',
        'profile',
        'shop',
        'check_id',
        'gender',
        'address',
        'facebook',
        'telegram',
        'location_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Products()
    {
        return $this->hasMany(Products::class);
    }

    public function message()
    {
        return $this->hasMany(Message::class);
    }

    public function location()
    {
        return $this->belongsTo(Locations::class, 'location_id');
    }
    public function CheckUser()
    {
        return $this->hasOne(CheckUser::class, 'frontuser_id');
    }
}
