<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AvisParticulier extends Model
{
    use SoftDeletes;

    protected $fillable = [ 
        'note',
        'commentaire',
        'projet_id',
        'user_id',
        'jardinier_id',
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function jardinier():BelongsTo
    {
        return $this->belongsTo(Jardinier::class);
    }

    public function projet():BelongsTo
    {
        return $this->belongsTo(Projet::class);
    }
}
