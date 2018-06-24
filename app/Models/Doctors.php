<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctors extends Model
{
    protected $table = 'doctors';
    protected $primaryKey = 'doctor_id';

    public $timestamp = false;

    protected $fillable = [
        'doctor_name', 'doctor_specialty',
    ];
}
