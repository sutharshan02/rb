<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebHook extends Model
{
    protected $table = 'webhook_log';
    protected $primaryKey='id';
    protected $fillable=['event_id','event_type','event_date','cus_id','sub_id','date'];
}