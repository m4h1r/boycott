<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'member_id', // Allow mass assignment
        'email', // Allow mass assignment
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email', // Hide the email hash as well
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function boycotts(): BelongsToMany
    {
        // Defines the many-to-many relationship with Boycott model
        // using the 'boycott_user' pivot table
        return $this->belongsToMany(Boycott::class);
    }

    protected static function boot()
     {
         parent::boot();

         static::creating(function ($user) {
             // Generate a unique member_id before saving the user
             $user->member_id = static::generateUniqueMemberId();
         });
     }

     /**
      * Generate a unique member ID.
      * Ensures the generated ID doesn't already exist in the database.
      *
      * @return string
      */
     protected static function generateUniqueMemberId(): string
     {
         do {
             // Generate a random string (e.g., 'USR_abc123')
             $memberId = Str::random(8);
         } while (static::where('member_id', $memberId)->exists()); // Check if it already exists

         return $memberId;
     }

    /**
     * Find a user by their hashed email for login.
     * !! SECURITY WARNING: Using MD5 for email lookup is not secure or truly anonymous. !!
     * !! This implements the request but is not recommended for production. !!
     *
     * @param string $email The plain email address provided by the user.
     * @return User|null
     */
    public static function findByEmail(string $email): ?User
    {
        // Calculate the MD5 hash of the provided email
        $emailHash = md5(strtolower(trim($email)));
        // Find the user by the calculated hash
        return static::where('email', $emailHash)->first();
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn (string $name) => Str::of($name)->substr(0, 1))
            ->implode('');
    }
}
