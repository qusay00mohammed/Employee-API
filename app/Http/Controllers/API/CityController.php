<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::all();
        if ($cities) {
            return response()->json([
                'status'    => true,
                'message'   => "list cities",
                'data'      => $cities,
            ], 200); // 200 successfully
        } else {
            return response()->json([
                'status'    => false,
                'message'   => "list cities",
                'data'      => $cities,
                // 'data'      => $cities->getMessageBag()->first(),
            ], 400); // error
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $request->validate([
            'name' => 'required|string|unique:cities,name',
            'country_id' => 'required|integer',
        ]);

        $city = City::create($input);
        if ($city) {
            return response()->json([
                'status'    => true,
                'message'   => "created successfully",
                'data'      => $city,
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => "not created successfully",
                'data'      => $city,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // Select cities dependancy on country_id
    public function show($id)
    {
        $cities = City::where(["country_id" => $id])->get();
        if ($cities) {
            return response()->json([
                "status" => true,
                "message" => "cities dependancy country id",
                "data" => $cities,
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "cities dependancy country id",
                "data" => $cities,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
