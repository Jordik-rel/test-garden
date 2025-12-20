<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ValeurNutritionnelle extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nom'
    ];

    public function plant():BelongsToMany
    {
        return $this->belongsToMany(Plant::class);
    }
}
