<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CaringType;

class CaringTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $caring_types = CaringType::get();
        return view('admin.caring_type.index', compact('caring_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.caring_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);
        $caringType = CaringType::create([
            'name' => $request->name,
            'description' => $request->description
        ]);
    
        return  redirect()->back()->with('message', 'Carying Type ' . $caringType->name . ' was created!');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $caring_type = CaringType::find($id);
        return view('admin.caring_type.edit', compact('caring_type'));
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
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);
        $caring_type = CaringType::find($id);
        $caring_type->name = $request->name;
        $caring_type->description = $request->description;
        $caring_type->save();
        return redirect()->route('caring-types.index')->with('message', 'Caring Type was updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $caring_type = CaringType::find($id);
        $caring_type->delete();
        return redirect()->back()->with('message', 'Caring Type ' . $caring_type->name . ' was deleted!');
    }
}
