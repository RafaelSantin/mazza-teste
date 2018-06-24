<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    protected $table = 'patients';
    protected $primaryKey = 'patient_id';

    protected $fillable = 
	[
		'patient_name',
		'patient_full_adress',
		'patient_email',
		'patient_cpf',
	];

}
