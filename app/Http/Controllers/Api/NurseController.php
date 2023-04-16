<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\resources\NurseCollection;
use App\Nurse;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NurseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new NurseCollection(Nurse::all());
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
            'password' => 'required|min:6|max:25',
            'gender' => 'required',
            'phone_number' => 'required|numeric',
            'is_resigned' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'result' => false,
                'message' => ('Validation Error.'),
            ], 401);
        }

        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['role_id'] = Role::where('name', 'nurse')->first()->id;
        $user = User::create($data);

        $nurse =  Nurse::create(
            [
                'user_id' => $user->id,
                'name' => $user->name,
                'gender' => $user->gender,
                'phone' => $user->phone_number,
                'is_resigned' => $request->is_resigned,
            ]
        );

        return new NurseCollection([$nurse]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nurse = Nurse::find($id);
        return new NurseCollection([$nurse]);
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
            'phone_number' => 'required|numeric',
            'is_resigned' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'result' => false,
                'message' => ('Validation Error.'),
            ], 401);
        }
        $nurse = Nurse::find($id);

        $data = $request->all();
        $user = $nurse->user;
        $userPassword = $user->password;
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        } else {
            $data['password'] = $userPassword;
        }
        $user->update($data);
        $nurse->name = $request->name;
        $nurse->gender = $request->gender;
        $nurse->phone = $request->phone_number;
        $nurse->is_resigned = $request->is_resigned;
        $nurse->save();

        return new NurseCollection([$nurse]);
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
        $nurse = Nurse::find($id);
        $user = $nurse->user();
        $user->delete();
        $nurse->delete();

        return response()->json([
            'result' => true,
            'message' => 'Updated Successfully'

        ]);
    }
}
