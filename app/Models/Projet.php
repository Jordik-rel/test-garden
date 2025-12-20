<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Projet extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'titre',
        'taille_poste',
        'duree',
        'niveau_experience',
        'type_emploi',
        'tarif_type',
        'tarif_min',
        'tarif_max',
        'budget',
        'description',
        'support',
        'status',
        'is_Public',
        'is_Post',
        'user_id',
    ];

    public function getRelativeDateAttribute()
    {
        $date = $this->created_at;
        $now  = now();

        $diffHours = $date->diffInHours($now);
        $diffDays  = $date->diffInDays($now);

        if ($diffHours < 24) {
            return "il y a $diffHours h";
        }

        if ($diffDays >= 1 && $diffDays < 2){
             return "hier";
        }

        if ($diffDays >= 2 && $diffDays < 3){
            return "avant-hier";
        } 

        return "il y a $diffDays jours";
    }


    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function competence():BelongsToMany
    {
        return $this->belongsToMany(Competence::class);
    }

    public function propositions():HasMany
    {
        return $this->hasMany(Proposition::class);
    }

    public function mission():HasOne
    {
        return $this->hasOne(Mission::class);
    }

    public function avis_particulier():HasOne
    {
        return $this->hasOne(AvisParticulier::class);
    }           
}
