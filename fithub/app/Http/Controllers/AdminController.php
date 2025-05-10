<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    // Count all users where role is 'user', ordered by latest created
    public function user_count(){
        $user = User::where('role', 'user')->orderBy('created_at', 'desc')->count();
        return response()->json($user, 200);                    //Success code
    }

    // Count all users where role is 'user', ordered by latest created
    public function trainer_count(){
        $trainer = User::where('role', 'trainer')->orderBy('created_at', 'desc')->count();
        return response()->json($trainer, 200);                 //Success code
    }
}
