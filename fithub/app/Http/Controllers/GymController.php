<?php

namespace App\Http\Controllers;

use App\Models\Gym;
use Illuminate\Http\Request;

class GymController extends Controller
{
    //
    public function findNearestGyms(Request $request)
    {
        $ip = request()->ip();

        // Check for proxies or load balancers
        if (request()->server('HTTP_X_FORWARDED_FOR')) {
            $ip = explode(',', request()->server('HTTP_X_FORWARDED_FOR'))[0];
        }
    
        $url = "http://ip-api.com/json/$ip";

        $locationData = json_decode(file_get_contents($url), true);
        $latitude = $locationData['lat'] ?? null;
        $longitude = $locationData['lon'] ?? null;

        if ($latitude && $longitude) {
            return $this->searchNearestGyms($latitude, $longitude);
        } else {
            return response()->json([
                'message' => 'Location could not be determined from IP address.',
                'ip' => $ip
            ], 400);
        }
    }

    private function searchNearestGyms($latitude, $longitude)
    {
        $radius = 4;
        $gyms = Gym::selectRaw(
            "
        id, name, address, latitude, longitude,
        (6371 * acos(cos(radians(?)) * cos(radians(latitude)) 
        * cos(radians(longitude) - radians(?)) + sin(radians(?)) 
        * sin(radians(latitude)))) AS distance",
            [$latitude, $longitude, $latitude]
        )
            ->having("distance", "<", $radius)
            ->orderBy("distance")
            ->get();
        if ($gyms->isEmpty()) {
            return response()->json(['message' => 'No gyms found within the specified radius.'], 404);
        }
        return response()->json($gyms);
    }
}
