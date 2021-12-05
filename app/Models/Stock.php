<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function flowers(): BelongsToMany
    {
        return $this->belongsToMany(Flower::class);
    }
}
