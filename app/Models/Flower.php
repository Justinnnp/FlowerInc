<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Flower extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'photo_url'];

    public function stocks(): BelongsToMany
    {
        return $this->belongsToMany(Stock::class)->withPivot('total');
    }
}
