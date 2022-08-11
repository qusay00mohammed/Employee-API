<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Governorate;
use Illuminate\Http\Request;

class GovernorateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $governorate = Governorate::all();

        if ($governorate) {
            return response()->json([
                'status' => true,
                'message' => "list governorates",
                'data'   => $governorate,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "list governorates",
                'data'   => $governorate,
            ]);
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
            'name' => 'required|string|unique:governorates,name',
            'city_id' => 'required|integer',
        ]);
        $governorate = Governorate::create($input);
        if ($governorate) {
            return response()->json([
                'status' => true,
                'message' => 'created successfully',
                'data'   => $governorate,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'not created successfully',
                'data'   => $governorate,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // Select governorates dependancy on city_id
    public function show($id)
    {
        $governorates = Governorate::where(["city_id" => $id])->get();
        if ($governorates) {
            return response()->json([
                "status" => true,
                "message" => "governorates dependancy city id",
                "data" => $governorates,
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "governorates dependancy city id",
                "data" => $governorates,
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
