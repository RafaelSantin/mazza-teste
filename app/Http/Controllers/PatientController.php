<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Patients;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patients::get();

        return json_encode($patients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patients.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $patient = new Patients;

        $patient->patient_name = $request->patient_name;
        $patient->patient_full_adress = $request->patient_full_adress;
        $patient->patient_email = $request->patient_email;
        $patient->patient_cpf = $request->patient_cpf;

        $patient->save();

        return 'inseriu';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return json_encode(Patients::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return json_encode(Patients::findOrFail($id));
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
        $patient = Patients::find($request->patient_id);

        $patient->patient_name = $request->patient_name;
        $patient->patient_full_adress = $request->patient_full_adress;
        $patient->patient_email = $request->patient_email;
        $patient->patient_cpf = $request->patient_cpf;
        
        $patient->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $patient = Patients::find($request->patient_id);

        $patient->delete();
    }
}
