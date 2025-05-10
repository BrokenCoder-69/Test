<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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


    public function bookedAppointments()
    {
        return $this->hasMany(Appoinment::class, 'user_id');
    }

    // Users who received bookings (trainers)
    public function receivedAppointments()
    {
        return $this->hasMany(Appoinment::class, 'trainer_id');
    }


    public function bookedSeminars()
    {
        return $this->hasMany(Seminar::class, 'user_id');
    }

    // Users who received bookings (trainers)
    public function receivedSeminars()
    {
        return $this->hasMany(Seminar::class, 'trainer_id');
    }
     public function givenReviews()
    {
        return $this->hasMany(Review::class, 'user_id');
    }
    
    public function receivedReviews()
    {
        return $this->hasMany(Review::class, 'trainer_id');
    }
    
    public function averageRating()
    {
        return $this->receivedReviews()->avg('rating');
    }
}
