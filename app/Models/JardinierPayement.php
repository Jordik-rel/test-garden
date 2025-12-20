<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class JardinierPayement extends Model
{
    // use SoftDeletes;
    
    protected $fillable = [
        'numero_admin',
        'numero_jardinier',
        'reference',
        'transaction_id',
        'montant',
        'jardinier_id',
        'mission_id'
    ];

    public function mission():HasMany
    {
        return $this->hasMany(Mission::class);
    }

    public function jardinier():BelongsTo
    {
        return $this->belongsTo(Jardinier::class);
    }
}
