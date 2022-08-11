<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contracts = Contract::all();
        if ($contracts) {
            return response()->json([
                'status' => true,
                'message' => "list contract",
                'data'   => $contracts
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "list contract",
                'data'   => $contracts
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
            'name' => 'required|string|unique:contracts,name',
        ]);

        $store = Contract::create($input);
        if ($store) {
            return response()->json([
                'status' => true,
                'message' => "created suceessfully",
                'data'   => $store
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "created suceessfully",
                'data'   => $store
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
