<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class FedaPayement extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'numero_recu',
        'reference',
        // 'moyen_payement',
        'montant',
        'status',
        'numero_payement',
        'date',
        'user_id',
        'mission_id'
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function mission():BelongsTo
    {
        return $this->belongsTo(Mission::class);
    }
}
