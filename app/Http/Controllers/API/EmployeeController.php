<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $AllDataEmployees = Employee::with('contracts', 'jopTitles', 'country', 'city', 'governorate')->get();
        $employees = $AllDataEmployees->makeHidden(['country_id', 'city_id', 'governorate_id']);

        return response()->json([
            'status' => true,
            'message' => 'list employee',
            'data'   => $employees,
        ]);
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
            'name'            => 'required',
            'number'          => 'required',
            'date_hiring'     => 'required',
            'birthday'        => 'required',
            'gender'          => 'required',
            'status'          => 'required',
            'image'           => 'required',
            'country_id'      => 'required',
            'city_id'         => 'required',
            'governorate_id'  => 'required',
            'contract_id'     => 'required',
            'jopTitle_id'     => 'required',
        ]);

        // Start Upload Photo
        $image_64 = $request->image; //your base64 encoded data
        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
        $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
        // find substring fro replace here eg: data:image/png;base64,
        $image = str_replace($replace, '', $image_64);
        $image = str_replace(' ', '+', $image);
        $imageName = uniqid() . '.' . $extension;
        $image = base64_decode($image); //decode base64 string
        Storage::disk('public')->put("images/" . $imageName, $image); // store photo in public folder
        // End Upload Photo

        $storeEmp = Employee::create([
            'image' => $imageName,
            'name'  => $request->name,
            'number' => $request->number,
            'birthday' => $request->birthday,
            'date_hiring' => $request->date_hiring,
            'status' => $request->status,
            'gender' => $request->gender,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'governorate_id' => $request->governorate_id,
        ]);

        // many to many insert to database
        /// || Contract
        $storeEmp->contracts()->syncWithoutDetaching($request->contract_id);
        /// || Jop Title
        $storeEmp->jopTitles()->syncWithoutDetaching($request->jopTitle_id);

        if ($storeEmp) {
            return response()->json([
                'status' => true,
                'message' => "created successfully",
                'data' => $storeEmp,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "not created successfully",
                'data' => $storeEmp,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $input = $request->all();
        $emp = Employee::findOrFail($id);
        $request->validate([
            'name'            => 'required',
            'number'          => 'required',
            'date_hiring'     => 'required',
            'birthday'        => 'required',
            'gender'          => 'required',
            'status'          => 'required',
            'country_id'      => 'required',
            'city_id'         => 'required',
            'governorate_id'  => 'required',
            'contract_id'     => 'required',
            'jopTitle_id'     => 'required',
        ]);

        $updateEmp = $emp->update([
            'number' => $request->number,
            'name'  => $request->name,
            'birthday' => $request->birthday,
            'date_hiring' => $request->date_hiring,
            'status' => $request->status,
            'gender' => $request->gender,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'governorate_id' => $request->governorate_id,
        ]);

        // many to many insert to database
        /// || Contract
        $emp->contracts()->sync($request->contract_id);
        /// || Jop Title
        $emp->jopTitles()->sync($request->jopTitle_id);

        if ($emp) {
            return response()->json([
                'status' => true,
                'message' => "created successfully",
                'data' => $emp,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "not created successfully",
                'data' => $emp,
            ]);
        }
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
