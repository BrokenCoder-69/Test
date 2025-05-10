<?php

namespace App\Http\Controllers;

use App\Models\Seminar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainerController extends Controller
{
    public function index()
    {
        $users = User::where('role','trainer')->where('status','approved')->orderBy('created_at', 'desc')->get();
        return response()->json($users, 200);

    }
    public function pending_trainer()
    {
        $users = User::where('role','trainer')->where('status','pending')->orderBy('created_at', 'desc')->get();
        return response()->json($users, 200);

    }
    public function trainer_approve($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Trainer not found'], 404);
        }
        $user->status = 'approved';
        $user->save();
        return response()->json($user, 200);
    }
    
    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Trainer not found'], 404);
        }
        return response()->json($user, 200);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Trainer not found'], 404);
        }
        $user->update($request->all());
        return response()->json($user, 200);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Trainer not found'], 404);
        }

        $user->delete();
        return response()->json(['message' => 'Trainer deleted successfully'], 200);
    }

    public function seminar_is_pending(Request $request)
    {
        $user_id = Auth::id();
        $appointments = Seminar::where('trainer_id', $user_id)->where('accepted', 0)->orderBy('created_at', 'desc')->get();
        return response()->json($appointments, 200);
    }
   
}
