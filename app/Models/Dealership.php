<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Dealership extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name',
        'address',
        'brand',
    ];


    public function products(): HasMany
    {
        return $this->hasMany(Car::class);
    }
}
