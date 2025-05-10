<?php

namespace App\Http\Controllers;

use App\Models\Appoinment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppoinmentController extends Controller
{
    public function book(Request $request){
        $user_id = Auth::id();              // Get the currently authenticated user's ID
        $appointment = Appoinment::create([
            'user_id' => $user_id, 
            'trainer_id' => $request->trainer_id,
            'time' => $request->appointment_time,
        ]);
    
        return response()->json($appointment, 201);     //HTTP status 201 (Created)
    }

}
