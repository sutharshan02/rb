<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalInfo extends Model {

    protected $table = 'resume_data';
    protected $primaryKey='resume_id';
    protected $fillable=['first_name','last_name','email_address','phone_no','address','city','state','zip_code','profile_desccription','user_id','is_draft','resume_name','template_id'];
    //protected $hidden = [''];
}