<?php

namespace App\Http\Controllers\Api;

use App\Caring;
use App\Http\Controllers\Controller;
use App\Http\Resources\resources\CaringsCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CaringsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new CaringsCollection(Caring::all());
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
            'nurse_id' => 'required',
            'patient_id' => 'required',
            'caring_type_id' => 'required',
            'date' => 'required',
            'time' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'result' => false,
                'message' => ('Validation Error.'),
            ], 401);
        }

        $date = str_replace('-', '/', $request->date);

        $formatDate = date('Y-m-d H:i', strtotime($date . $request->time));

        $caring = Caring::create([
            'nurse_id' => $request->nurse,
            'patient_id' => $request->patient,
            'caring_type_id' => $request->caring,
            'time' => $formatDate,
            'description' => $request->description,
        ]);

        return new CaringsCollection([$caring]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $caring = Caring::find($id);

        return new CaringsCollection([$caring]);
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
            'nurse_id' => 'required',
            'patient_id' => 'required',
            'caring_type_id' => 'required',
            'date' => 'required',
            'time' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'result' => false,
                'message' => ('Validation Error.'),
            ], 401);
        }

        $data = $request->all();

        $date = str_replace('-', '/', $request->date);

        $formatDate = date('Y-m-d H:i', strtotime($date . $request->time));
        $caring = Caring::find($id);

        $data['time'] = $formatDate;

        $caring->update($data);

        return new CaringsCollection([$caring]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $caring = Caring::find($id);
        $caring->delete();
        return response()->json([
            'result' => true,
            'message' => 'Updated Successfully'

        ]);
    }
}
