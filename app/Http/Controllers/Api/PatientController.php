<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\resources\PatientCollection;
use App\Patient;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new PatientCollection(Patient::all());
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
            'email' => 'required|unique:users',
            'gender' => 'required',
            'is_stopped' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'result' => false,
                'message' => ('Validation Error.'),
            ], 401);
        }

        $data = $request->all();
        $data['role_id'] = Role::where('name', 'patient')->first()->id;
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = (new User())->userAvatar($request);
        }

        $user = User::create($data);
        $patient = Patient::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'is_stopped' => $request->is_stopped,
            'room_photo' => $imageName
        ]);

        return new PatientCollection([$patient]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = Patient::find($id);
        return new PatientCollection([$patient]);
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
            'email' => 'required',
            'gender' => 'required',
            'is_stopped' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'result' => false,
                'message' => ('Validation Error.'),
            ], 401);
        }

        $patient = Patient::find($id);

        $data = $request->all();
        $user = $patient->user;

        $patient->is_stopped = $request->is_stopped;

        if ($request->hasFile('image')) {
            $imageName = (new User)->userAvatar($request);
            unlink(public_path('images/' . $user->image));
            $patient->room_photo = $imageName;
        }


        $user->update($data);
        $patient->name = $request->name;
        $patient->is_stopped = $request->is_stopped;
        $patient->save();

        return new PatientCollection([$patient]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Prevent user delete himself
        if (auth()->user()->id == $id) {
            abort(401);
        };
        $patient = Patient::find($id);
        $user = $patient->user;
        $user->delete();
        if ($patient->room_photo != null) {
            unlink(public_path('images/' . $patient->room_photo));
        }
        $patient->delete();
        return response()->json([
            'result' => true,
            'message' => 'Updated Successfully'

        ]);
    }
}
