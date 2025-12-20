<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Realisation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'titre',
        'status',
        'duree',
        'description',
        'archive_img',
        'jardinier_id'
    ];

    public function jardinier():BelongsTo
    {
        return $this->belongsTo(Jardinier::class);
    }
}
