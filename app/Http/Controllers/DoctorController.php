<?php

namespace App\Http\Controllers;

use App\Models\Doctors;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctors::get();
        Log::debug($doctors);

        return json_encode($doctors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('doctors.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::debug('teeeeeeeeste');
        Log::debug($request);
        $doctor = new Doctors;

        $doctor->doctor_name = $request->doctor_name;
        $doctor->doctor_specialty = $request->doctor_specialty;

        $doctor->save();

        return json_encode($doctor);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return json_encode(Doctors::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return json_encode(Doctors::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Log::debug('teeeeeeeeste');
        Log::debug($request);
        $doctor = Doctors::find($request->doctor_id);

        $doctor->doctor_name = $request->doctor_name;
        $doctor->doctor_specialty = $request->doctor_specialty;

        $doctor->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Log::debug('teeeeeeeeste');
        Log::debug($request);
        $doctor = Doctors::find($request->doctor_id);

        $doctor->delete();
    }
}
