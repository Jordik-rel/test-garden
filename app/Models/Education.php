<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Education extends Model
{
    use SoftDeletes;


    protected $fillable = [
        'nomEcole',
        'ville',
        'pays',
        'dateDebut',
        'dateFin',
        'niveauetude',
        'domaine',
        'description',
        'jardinier_id',
        'nomFormation'
    ];

    public function jardinier():BelongsTo
    {
        return $this->belongsTo(Jardinier::class);
    }
}
