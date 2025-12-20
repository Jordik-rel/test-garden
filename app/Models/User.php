<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'username',
        'email',
        'phone',
        'password',
        'role',
        'profile_photo_path'
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
        ];
    }

    public function localisation():HasMany
    {
        return $this->hasMany(Localisation::class);
    }

    public function jardinier():HasOne
    {
        return $this->hasOne(Jardinier::class);
    }

    public function payements():HasMany
    {
        return $this->hasMany(Payement::class);
    }


    public function projets():HasMany
    {
        return $this->hasMany(Projet::class);
    }

    public function propositions():HasMany
    {
        return $this->hasMany(Proposition::class);
    }

    public function mission():HasMany
    {
        return $this->hasMany(Mission::class);
    }

    public function avis_particulier():HasMany
    {
        return $this->hasMany(AvisParticulier::class);
    }

    public function feda_payement():HasMany
    {
        return $this->hasMany(FedaPayement::class);
    }
}
