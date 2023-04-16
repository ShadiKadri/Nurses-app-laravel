<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\CaringType;
use App\Caring;


class CaringsController extends Controller
{

    public function index()
    {
        $carings = Caring::all();
        return view('admin.caring.index', compact('carings'));
    }

    public function create()
    {
        $patientRoleId = Role::where('name', 'patient')->first()->id;
        $nurseRoleId = Role::where('name', 'nurse')->first()->id;
        $nurses = User::where('role_id', $nurseRoleId)->get();
        $patients = User::where('role_id', $patientRoleId)->get();
        $caringTypes = CaringType::all();
        return view('admin.caring.create', compact('nurses', 'patients', 'caringTypes'));
    }

    public function store(Request $request)
    {
        $this->validateStore($request);

        $date = str_replace('-','/',$request->date);

        $formatDate = date('Y-m-d H:i', strtotime($date . $request->time));

        Caring::create([
            'nurse_id' => $request->nurse,
            'patient_id' => $request->patient,
            'caring_type_id' => $request->caring,
            'time' => $formatDate,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('message', 'Caring Assigned successfully');
    }


    public function show($id)
    {
        $caring = Caring::find($id);
        return view('admin.caring.delete', compact('caring'));
    }

    public function edit($id)
    {
        $caring = Caring::find($id);
        $patientRoleId = Role::where('name', 'patient')->first()->id;
        $nurseRoleId = Role::where('name', 'nurse')->first()->id;
        $nurses = User::where('role_id', $nurseRoleId)->get();
        $patients = User::where('role_id', $patientRoleId)->get();
        $caringTypes = CaringType::all();

        return view('admin.caring.edit', compact('caring', 'nurses', 'patients', 'caringTypes'));
    }

    public function update(Request $request, $id)
    {
        $this->validateUpdate($request, $id);
        $data = $request->all();

        $date = str_replace('-','/',$request->date);

        $formatDate = date('Y-m-d H:i', strtotime($date . $request->time));
        $caring = Caring::find($id);

        $data['time'] = $formatDate;

        $caring->update($data);

        return redirect()->route('caring.index')->with('message', 'Caring information updated successfully');
    }


    public function destroy($id)
    {
        $caring = Caring::find($id);
        $caring->delete();
        return redirect()->route('caring.index')->with('message', 'Caring deleted successfully');
    }

    public function validateStore($request)
    {
        return  $this->validate($request, [
            'nurse' => 'required',
            'patient' => 'required',
            'caring' => 'required',
            'date' => 'required',
            'time' => 'required',
            'description' => 'required',
        ]);
    }
    public function validateUpdate($request, $id)
    {
        return  $this->validate($request, [
            'nurse' => 'required',
            'patient' => 'required',
            'caring' => 'required',
            'date' => 'required',
            'time' => 'required',
            'description' => 'required',
        ]);
    }
}
