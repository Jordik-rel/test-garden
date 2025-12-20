<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certification extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nom',
        'description',
        'date_obtention',
        'date_expiration',
        'image',
        'jardinier_id',
    ];

    public function jardinier():BelongsTo
    {
        return $this->belongsTo(Jardinier::class);
    }
}
