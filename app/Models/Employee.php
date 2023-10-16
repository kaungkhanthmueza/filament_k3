<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public $guarded = [];
    // protected $fillable = [
    //     'emp_ename',
    //     'emp_mname',
    //     'emp_fname',
    //     'emp_datebirth',
    //     'emp_race',
    //     'emp_religion',
    //     'emp_nationality',
    //     'emp_vacancy',
    //     'emp_passportno',
    //     'emp_driverlicense',
    //     'emp_nrc_code',
    //     'emp_l',
    //     'emp_name_en',
    //     'emp_name_mm',
    //     'emp_naing',
    //     'emp_number',
    //     'emp_gender',
    //     'emp_blood',
    //     'emp_martial',
    //     'emp_hphone',
    //     'emp_Mphone',
    //     'emp_space',
    //     'emp_folder',
    //     'emp_checke',
    //     'emp_education',
    //     'emp_frome',
    //     'emp_toe',
    //     'emp_school',
    //     'emp_checkw',
    //     'emp_job',
    //     'emp_companyn',
    //     'emp_fromec',
    //     'emp_toc',
    //     'emp_contactc',
    //     'emp_addressc',
    //     'emp_folder2',
    //     'emp_checkr',
    //     'emp_refname',
    //     'emp_refjob',
    //     'emp_refemail',
    //     'emp_refphone',
    //     'emp_checkfm',
    //     'emp_familymname',
    //     'emp_familymrs',
    //     'emp_familydateofbirth',
    //     'emp_familyoc',
    //     'emp_familycontact',
    //     'emp_familyaddress',
    //     'emp_checkt',
    //     'emp_temp',
    //     'emp_country',
    //     'emp_state',
    //     'emp_township',
    //     'emp_street',

    // ];

    public function blood() {
        return $this->belongsTo(Blood::class);
    }
    public function gender() {
        return $this->belongsTo(Gender::class);
    }


    public function vacancy() {
        return $this->belongsTo(Vacancy::class);
    }
    public function nrc(){
        return $this->belongsTo(nrc::class);
    }
    public function education() {
        return $this->hasMany(emp_education::class);
    }
    public function job(){
        return $this->hasMany(emp_job::class);
    }
    public function address() {
        return $this->hasMany(emp_addressl::class);
    }


}
