<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;
use App\User;
use App\Role;

class PatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patientRoleId = Role::where('name', 'patient')->first()->id;
        $users  = User::get()->where('role_id', $patientRoleId);
        foreach ($users as $user) {
            $user->is_stopped = $user->patient->is_stopped;
            $user->room_photo = $user->patient->room_photo;
        }
        return view('admin.patient.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.patient.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateStore($request);
        $data = $request->all();
        $data['role_id'] = Role::where('name', 'patient')->first()->id;
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = (new User)->userAvatar($request);
        }

        $user = User::create($data);
        Patient::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'is_stopped' => $request->is_stopped,
            'room_photo' => $imageName
        ]);

        return redirect()->back()->with('message', 'Patient added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $user->is_stopped = $user->patient->is_stopped;
        $user->room_photo = $user->patient->room_photo;
        return view('admin.patient.delete', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $user['is_stopped'] = $user->patient->is_stopped;
        return view('admin.patient.edit', compact('user'));
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
        $this->validateUpdate($request, $id);
        $data = $request->all();
        $user = User::find($id);
        $patient = $user->patient;
        $patient->is_stopped = $request->is_stopped;

        if ($request->hasFile('image')) {
            $imageName = (new User)->userAvatar($request);
            unlink(public_path('images/' . $user->image));
            $patient->room_photo = $imageName;
        }


        $user->update($data);
        $patient->save();

        return redirect()->route('patient.index')->with('message', 'Patient ' . $user->name . ' information updated successfully');
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
        $user = User::find($id);
        $user->delete();
        $patient = $user->patient;
        if ($patient->room_photo != null) {
            unlink(public_path('images/' . $patient->room_photo));
        }
        $patient->delete();
        return redirect()->route('patient.index')->with('message', 'Patient ' . $user->name . ' deleted successfully');
    }

    public function validateStore($request)
    {
        return  $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email,',
            'gender' => 'required',
            'is_stopped' => 'required',
        ]);
    }
    public function validateUpdate($request, $id)
    {
        return  $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email,',
            'gender' => 'required',
            'is_stopped' => 'required',
        ]);
    }
}
