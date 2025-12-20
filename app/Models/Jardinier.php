<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jardinier extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'profession',
        'description',
        'tarif_horaire',
        'tarif_journalier',
        'disponible',
        'note_moyenne',
        'nombre_missions',
        'site_web',
        'user_id',
    ];

    public function certifications():HasMany
    {
        return $this->hasMany(Certification::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function competences():BelongsToMany
    {
        return $this->belongsToMany(Competence::class);
    }

    public function services():HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function realisations():HasMany
    {
        return $this->hasMany(Realisation::class);
    }

    public function experiences():HasMany
    {
        return $this->hasMany(Experience::class);
    }

    public function educations():HasMany
    {
        return $this->hasMany(Education::class);
    }

     public function blogs():HasMany
    {
        return $this->hasMany(Blog::class);
    }

    public function mission():HasMany
    {
        return $this->hasMany(Mission::class);
    }

    public function avis_particulier():HasMany
    {
        return $this->hasMany(AvisParticulier::class);
    }

    public function jardinier_payement():HasMany
    {
        return $this->hasMany(JardinierPayement::class);
    }
}
