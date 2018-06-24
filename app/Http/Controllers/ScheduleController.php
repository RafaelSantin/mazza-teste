<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Schedules;
use App\Models\Patients;
use App\Models\Doctors;

class ScheduleController extends Controller
{

    public function openPage()
    {
        $patients = Patients::pluck('patient_name','patient_id');
        $doctors = Doctors::pluck('doctor_name','doctor_id');
        return view('doctor.scheduleList')->with('pacientes',$patients)->with('medicos',$doctors);
    }    

    public function index()
    {
        $schedules = Schedules::join('doctors',function($j){
                            $j->on('doctors.doctor_id','=','schedules.doctor_id');
                        })
                        ->join('patients',function($j){
                            $j->on('patients.patient_id','=','schedules.patient_id');
                        })
                        ->get();

        return json_encode($schedules);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('schedules.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $schedule = new Schedules;
        // $data = \DateTime::createFromFormat('d/m/Y H:i:s', $request->schedule_date_time);
        \Log::debug($request);
        // \Log::debug($data);
        $schedule->schedule_date_time = $request->schedule_date_time;
        $schedule->schedule_comment = $request->schedule_comment;
        $schedule->doctor_id = $request->doctor_id;
        $schedule->patient_id = $request->patient_id;

        $schedule->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schedule = Schedules::join('doctors',function($j){
                            $j->on('doctors.doctor_id','=','schedules.doctor_id');
                        })
                        ->join('patients',function($j){
                            $j->on('patients.patient_id','=','schedules.patient_id');
                        })
                        ->where('id',$id)
                        ->firstOrFail();

        return json_encode($schedule);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $schedule = Schedules::join('doctors',function($j){
                            $j->on('doctors.doctor_id','=','schedules.doctor_id');
                        })
                        ->join('patients',function($j){
                            $j->on('patients.patient_id','=','schedules.patient_id');
                        })
                        ->where('id',$id)
                        ->firstOrFail();

        return json_encode($schedule);
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
        $schedule = Schedules::find($request->schedule_id);

        $schedule->schedule_date_time = $request->schedule_date_time;
        $schedule->schedule_comment = $request->schedule_comment;
        $schedule->doctor_id = $request->doctor_id;
        $schedule->patient_id = $request->patient_id;
        
        $schedule->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $schedule = Schedules::find($request->schedule_id);

        $schedule->delete();
    }
}
