<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey='user_id';
    protected $fillable=['email','username','password','token','status','is_verified','reset_token','is_reset','last_login','role'];
    protected $hidden = ['password'];
    
    public static function role($id)
    {
        switch($id)
        {
            case '0':case '2':return 'user';break;
            case '1':return 'admin';break;
        }
    }
}