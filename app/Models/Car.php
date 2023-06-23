<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    public $timestamps = false;
    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'model',
        'brand',
        'power',
        'volume',
        'dealerships_id',
    ];

    public function parentCategory(): BelongsTo
    {
        return $this->belongsTo(Dealership::class);
    }
}
