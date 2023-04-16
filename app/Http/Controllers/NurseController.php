<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Nurse;
use App\Role;
class NurseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get the nurse info
        $nurseRoleId = Role::where('name','nurse')->first()->id;

        $users  = User::get()->where('role_id', $nurseRoleId);
        return view('admin.nurse.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.nurse.create');
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
        $data['password'] = bcrypt($request->password);
        $data['role_id'] = Role::where('name','nurse')->first()->id;
        $user = User::create($data);
        // dd($user);
        Nurse::create(
            [
                'user_id' => $user->id,
                'name' => $user->name,
                'gender' => $user->gender,
                'phone' => $user->phone_number,
                'is_resigned' => $request->is_resigned,
            ]
            );

        return redirect()->back()->with('message', 'Nurse added successfully');
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
        return view('admin.nurse.delete', compact('user'));
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
        $user['is_resigned'] = $user->nurse->is_resigned;
        return view('admin.nurse.edit', compact('user'));
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
        $nurse = $user->nurse;
        $userPassword = $user->password;
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        } else {
            $data['password'] = $userPassword;
        }
        $nurse->is_resigned = $request->is_resigned;
        $user->update($data);
        $nurse->save();

        return redirect()->route('nurse.index')->with('message', 'Nurse ' . $user->name . ' information updated successfully');
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
        $nurse = $user->nurse;
        $nurse->delete();
        return redirect()->route('nurse.index')->with('message', 'Nurse ' . $user->name . ' deleted successfully');
    }

    public function validateStore($request)
    {
        return  $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6|max:25',
            'gender' => 'required',
            'phone_number' => 'required|numeric',
            'is_resigned' => 'required',
        ]);
    }
    public function validateUpdate($request, $id)
    {
        return  $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'gender' => 'required',
            'phone_number' => 'required|numeric',
            'is_resigned' => 'required',
        ]);
    }
}
