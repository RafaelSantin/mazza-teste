<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedules extends Model
{
	protected $table = 'schedules';
    protected $primaryKey = 'schedule_id';
    
    protected $fillable = 
	[
	  'schedule_date_time',
	  'schedule_comment',
	  'doctor_id',
	  'patient_id',
	];
}
