<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    /** @use HasFactory<\Database\Factories\BrandFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'alternatives',
    ];

    /**
     * Define the relationship: A brand can be associated with multiple boycotts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function boycotts(): HasMany
    {
        // Defines the one-to-many relationship with Boycott model
        return $this->hasMany(Boycott::class);
    }
}
