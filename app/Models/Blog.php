<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'subtitle',
        'image',
        'description',
        'status',
        'like',
        'jardinier_id'
    ];

    public function jardinier():BelongsTo
    {
        return $this->belongsTo(Jardinier::class);
    }

}
