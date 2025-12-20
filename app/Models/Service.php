<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'titre',
        'description',
        'prix',
        'jardinier_id'
    ];

    public function jardinier():BelongsTo
    {
        return $this->belongsTo(Jardinier::class);
    }
}
