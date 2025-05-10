<?php

namespace App\Http\Controllers;

use App\Models\Appoinment;
use App\Models\Seminar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeminarController extends Controller
{
    public function book(Request $request){
        $user_id = Auth::id();
        $appointment = Seminar::create([
            'user_id' => $user_id, // client
            'trainer_id' => $request->trainer_id,
            'title' => $request->title,
            'description' => $request->description,
            'phone_number' =>  $request->phone_number,
            'date_time' => $request->date_time,
            'format' => $request->format,
            'location' => $request->date_time,
        ]);
    
        return response()->json($appointment);
    }

    public function trainer_index(Request $request)
    {
        $user_id = Auth::id();
        $appointments = Seminar::where('trainer_id', $user_id)->where('accepted', 1)->orderBy('created_at', 'desc')->get();
        return response()->json($appointments, 200);
    }
    

    public function user_index(Request $request)
    {
        $user_id = Auth::id();
        $appointments = Seminar::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();
        return response()->json($appointments, 200);
    }

    public function show($id)
    {
        $appointment = Seminar::find($id);
        if (!$appointment) {
            return response()->json(['message' => 'Seminar not found'], 404);
        }
        return response()->json($appointment, 200);
    }

    public function seminar_accept($id)
    {
        $appointment = Seminar::find($id);
        if (!$appointment) {
            return response()->json(['message' => 'Appointment not found'], 404);
        }
        $appointment->accepted = true;
        $appointment->save();
        return response()->json($appointment, 200);
    }
}
