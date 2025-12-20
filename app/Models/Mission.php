<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mission extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'jardinier_id',
        'projet_id',
        'montant',
        'status',
        'date_debut'
    ];

    public function projet(): BelongsTo
    {
        return $this->belongsTo(Projet::class);
    }

    public function jardinier():BelongsTo
    {
        return $this->belongsTo(Jardinier::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function feda_payement():HasOne
    {
        return $this->hasOne(FedaPayement::class);
    }

    public function jardinier_payement():BelongsTo
    {
        return $this->belongsTo(JardinierPayement::class);
    }
}
