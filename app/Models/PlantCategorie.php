<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlantCategorie extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nom',
        'role'
    ];

    public function plant():BelongsToMany
    {
        return $this->belongsToMany(Plant::class);
    }
}
