<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appoinment extends Model
{
    protected $fillable = [
        'user_id',
        'trainer_id',
        'time',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }
}
