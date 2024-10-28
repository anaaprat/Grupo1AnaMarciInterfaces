<?php

namespace App\Models;

// use Illuminate\\Contracts\\Auth\\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',          // Añadir el campo 'role'
        'actived',       // Añadir el campo 'actived'
        'email_confirmed'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'email_confirmed' => 'boolean',
        'password' => 'hashed',
    ];

    // En User model
    public function markEmailAsVerified()
    {
        $this->email_verified_at = now();
        $this->email_confirmed = true;  // Actualiza el campo a true
        $this->save();
    }

}