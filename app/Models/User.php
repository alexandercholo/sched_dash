<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    protected $fillable = [
        'username',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'password',
        'role',
        'signature_path',
        'program', // Add program to fillable
    ];

    // Add program constants for better maintainability
    const PROGRAMS = [
        'bpa' => 'Bachelor of Performing Arts',
        'bpubad' => 'Bachelor of Public Administration',
        'bsbio' => 'Bachelor of Science in Biology',
        'bsenv' => 'Bachelor of Science in Environmental Science',
        'bsess' => 'Bachelor of Science in Exercise Sports and Sciences',
        'bsmath' => 'Bachelor of Science in Mathematics',
        'bssw' => 'Bachelor of Science in Social Work',
        'lap' => 'Liberal Arts Program',
    ];

    // Helper method to get program full name
    public function getProgramNameAttribute()
    {
        return self::PROGRAMS[$this->program] ?? 'Not Assigned';
    }


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
        'password' => 'hashed',
    ];

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function getFullnameAttribute()
{
    return trim("{$this->first_name} {$this->middle_name} {$this->last_name}");
}
    
}
