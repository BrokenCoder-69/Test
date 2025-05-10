<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    // Specify the fields that can be mass-assigned
    protected $fillable = ['user_id', 'trainer_id', 'rating', 'comment'];

    // Define the relationship between Review and User
    public function user()
    {
        return $this->belongsTo(User::class);  // A review belongs to a user
    }

    // Define the relationship between Review and Trainer
    public function trainer()
    {
        return $this->belongsTo(Trainer::class);  // A review belongs to a trainer
    }
}
