<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proposition extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'tarif_propose',
        'duree',
        'message',
        'support',
        'status',
        'projet_id',
        'user_id'
    ];

    public function projet():BelongsTo
    {
        return $this->belongsTo(Projet::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
