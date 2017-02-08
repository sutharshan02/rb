<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'education';
    protected $primaryKey='education_id';
    protected $fillable=['resume_id','school_name','location','degree', 'description', 'field_of_study','grade','gpa','start_date','graduation_date','in_progress'];
}