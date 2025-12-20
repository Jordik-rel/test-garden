<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Competence extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nom',
        'description',
    ];

    public function jardinier():BelongsToMany
    {
        return $this->belongsToMany(Jardinier::class);
    }

    public function projet():BelongsToMany
    {
        return $this->belongsToMany(Projet::class);
    }
}
