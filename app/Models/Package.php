<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'packages';
    protected $primaryKey='package_id';
    protected $fillable=['package_name','package_desc','price','is_subcription','subscription_period','status','can_download','can_track'];
}