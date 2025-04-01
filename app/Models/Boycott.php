<?php

namespace App\Models;

use App\Models\User;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Boycott extends Model
{
    /** @use HasFactory<\Database\Factories\BoycottFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'brand_id',
        'reason',
        'start_date',
        'end_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    /**
     * Define the relationship: A boycott belongs to one brand.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand(): BelongsTo
    {
        // Defines the inverse of the one-to-many relationship with Brand model
        return $this->belongsTo(Brand::class);
    }

    /**
     * Define the relationship: A boycott can have many participating users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        // Defines the many-to-many relationship with User model
        // using the 'boycott_user' pivot table
        return $this->belongsToMany(User::class);
    }
}
