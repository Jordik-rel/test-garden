<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plant extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nom',
        'nom_scientifique',
        'nom_local',
        'image',
        'description',
        'precautions',
        'conseil_culture',
    ];

    protected $casts = [
        'image' => 'array',
    ];

    public function plant_categorie():BelongsToMany
    {
        return $this->belongsToMany(PlantCategorie::class);
    }

    public function valeur_nutritionnelle():BelongsToMany
    {
        return $this->belongsToMany(ValeurNutritionnelle::class);
    }

    public function vertu_medicinale():BelongsToMany
    {
        return $this->belongsToMany(VertuMedicinale::class);
    }
}
