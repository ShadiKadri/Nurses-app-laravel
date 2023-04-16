<?php

namespace App\Http\Controllers\Api;

use App\CaringType;
use App\Http\Controllers\Controller;
use App\Http\Resources\resources\CaringTypeCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CaringTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new CaringTypeCollection(CaringType::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'result' => false,
                'message' => ('Validation Error.'),
            ], 401);
        }

        $caringType = CaringType::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return new CaringTypeCollection([$caringType]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $caringType = CaringType::find($id);
        return new CaringTypeCollection([$caringType]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'result' => false,
                'message' => ('Validation Error.'),
            ], 401);
        }
        $data = $request->all();

        $caringType = CaringType::find($id);

        $caringType->update($data);

        return new CaringTypeCollection([$caringType]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $caringType = CaringType::find($id);
        $caringType->delete();
        return response()->json([
            'result' => true,
            'message' => 'Updated Successfully'

        ]);
    }
}
