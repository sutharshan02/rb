<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkHistory extends Model
{
    protected $table = 'work_history';
    protected $primaryKey='work_id';
    protected $fillable=['resume_id','company_name','position','location','start_date','end_date','is_present','description','responsibilities'];
}