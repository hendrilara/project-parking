<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Image;
use DB;
use Input;
use App\Capacity;
use App\User;
use App\Building;
use App\Location;
class LocationController extends Controller
{
    public function lokasi()
    {
        //$query = DB::table('location')->select('name', 'address', 'description', 'city')->get();
        $query = DB::select('SELECT name, city, address, description, acos( cos( radians( latitude ) ) *  cos( acos( radians(latitude) ) * cos( acos(longitude) - radians( longitude )) + sin( radians( latitude ) ) * sin( radians( longitude )))) AS distance FROM location HAVING distance <  25 ORDER BY distance LIMIT 0 , 20');
        
        return $query;

    }

    public function index(Request $request)
    {  
       
        $langitute = $request->input('langitude');
        $latitude  = $request->input('latitude');
        $distance  = $request->input('distance');

        $location = Location::all();
        $locationn = DB::select('SELECT id, name, city, ( 3959 *
                 acos( cos(radians(37)) * 
                 cos( radians(latitude) ) * 
                 cos( radians( longitude ) - 
                 radians(-122) ) + sin( radians(37) ) * 
                 sin( radians( latitude ) ) ) ) AS 
                 distance FROM location HAVING 
                 distance < 25 ORDER BY distance LIMIT 0 , 20');

        if (! $location) {
            
            return response()->json([
                'error' => [
                    'message' => 'Not Found',
                    'status_code'=> 404
                ]
                ], 404);
        }
        else
        {
            return response()->json([
                'succes' => [
                    //'message' => 'data location succes',
                    //'status_code' => 200,
                    'data' => $location,
                ]

                ], 200);
        }
    }


    public function showLocation($location)
    {
        $showlocation = Location::with('image')
                        ->with('capacity')->findOrFail($location);

        if (! $showlocation) {
                
            return response()->json([
                    'message' => 'data not found',
                    'status_code' => 404,
                ], 404);
        }
        else
        {
            return response()->json([
                    //'date' => time(),
                    //'message' => 'succes',
                    //'status_code' => 200,
                    'data'  => $showlocation,

                ],200);
        }
    }

   
   public function createLocation(Request $request)
   {
        

   }

   public function storeLocation($location)
   {
    //store
   }

   public function deleteLocation($location)
   {
       
   }

}