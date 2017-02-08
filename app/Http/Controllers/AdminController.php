<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PersonalInfo;
use App\Models\Education;
use App\Models\Skill;
use App\Models\WorkHistory;
use App\Models\Package;
use App\Models\User;
use Validator;
use Carbon\Carbon;
use Session;

class AdminController extends Controller
{
    /**
    * @author RR
    * @param user_id
    * @return user_id
    * @url:<url>/user/status
    * @access public
    * @since 27-07-2016
    */
    public function setUserStatus ($id,Request $request)
    {
        $response = ['status_code' => '0'];
        
        $user = User::find($id);
        if($user)
        {
            if($user->status==0)
            {
                $user->status = 1;
                $user->save();
            }
            else
            {
                $user->status = 0;
                $user->save();
            }
            $response['id'] = $user->user_id;
            $response['message']= 'Successfully updated the ststus';
             Session::flash('success_message', $response['message']);
        }
        else
        {
            $response['message']= 'User not found';
            $response['status_code'] = '1';
              Session::flash('error_message', $response['message']);
        }
        
        
        return redirect('admin/dashboard');  
    }
    
    /**
    * @author RR
    * @param searchkey
    * @return resultset
    * @url:<url>/user/search
    * @access public
    * @since 29-07-2016
    */
    public function searchUsers (Request $request)
    {
        $response = ['status_code' => '0'];
        
        $rules = [
            'searchkey' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
        {
                $response['status_code'] = '1';
                $response['message'] = 'No search key';
        }
        else
        {
            $user = User::where('email','LIKE','%'.$request->searchkey.'%')
                        ->Orwhere('username','LIKE','%'.$request->searchkey.'%')
                        ->select('user_id','email','username','status','is_verified','last_login')
                        ->paginate(10);
            if($user)
            {
                $response['data'] = $user;
            }
            else
            {
                $response['message']= 'No users found';
                $response['status_code'] = '1';
            }
        }
        
        return $response;
    }
    
    /**
    * @author RR
    * @param 
    * @return users
    * @url:<url>/user/all
    * @access public
    * @since 29-07-2016
    */
    public function users ()
    {
        $response = ['status_code' => '0'];
        
        $user = User::select('user_id','email','username','status','is_verified','last_login')
                    ->paginate(10);
        if($user)
        {
            $response['data'] = $user;
        }
        else
        {
            $response['message']= 'No users';
            $response['status_code'] = '1';
        }
        
        return $response;        
    }
    
    /**
    * @author RR
    * @param 
    * @return all packages
    * @url:<url>/package/all
    * @access public
    * @since 29-07-2016
    */
    public function packages ()
    {
        $response = ['status_code' => '0'];
       
        $package = Package::paginate(10);
        if($package)
        {
            $response['data'] = $package;
        }
        else
        {
             $response['message']= 'No packages';
             $response['status_code'] = '1';
        }
        return $response; 
    }
   
    /**
    * @author RR
    * @param 
    * @return package enable/disable
    * @url:<url>/package/all
    * @access public
    * @since 29-07-2016
    */
    public function packageStatus (Request $request)
    {
        $response = ['status_code' => '0'];

        $package = Package::find($request->package_id);
        if($package)
        {
            if($package->status==0)
             {
                 $user->status = 1;
                 $user->save();
             }
             else
             {
                 $user->status = 0;
                 $user->save();
             }
             $response['id'] = $package->user_id;
        }
        else
        {
             $response['message']= 'No package';
             $response['status_code'] = '1';
        }
        
        return $response; 
    }

    /**
    * @author BM
    * @param form data
    * @return resume_id
    * @url:<url>/package/add
    * @access public
    * @since 27-07-2016
    */
    public function addPackage(Request $request)
    {
        $response = ['status_code' => '0'];

        $rules = [
        'package_name' => 'required',
        'package_desc' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            $response['status_code'] = '1';
            $response['message'] = 'Operation Failed';
        }
        else
        {
            $package = new Package();
            $package->fill($request->all());
            $package->save();
            $response['message']= 'Operation Success';
        }
        

        return $response;
    }

    /**
    * @author BM
    * @param form data
    * @return resume_id
    * @url:<url>/package/edit
    * @access public
    * @since 27-07-2016
    */
    public function editPackage(Request $request)
    {
        $response = ['status_code' => '0'];

        $rules = [
        'package_name'  =>  'required',
        'package_desc'  =>  'required',
        'package_id'    =>  'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            $response['status_code'] = '1';
            $response['message'] = 'Operation Failed';
        }
        else 
        {
            $package = Package::where('package_id', '=', $request->package_id)->first();
            
            if($package)
            {
                $package->fill($request->all());
                $package->save();
                $response['message'] = 'Operation Success';
                $response['result'] = $package;
            }
            else
            {
                $response['message'] = 'no record found';
            }
        }

        return $response;
    }
    
    public function allUsers(Request $request) {
        $response = ['status_code' => '0'];
        $key = $request->input('key','');
        if($key==''){
            $user = User::select('user_id','email','username','status','is_verified','last_login')
                        ->where('is_verified',1)
                        ->whereIn('role',[0,2])
                        ->paginate(50);
        }
        else
        {
            $user = User::select('user_id','email','username','status','is_verified','last_login')
                        ->where('is_verified',1)
                        ->where(function($query) use ($key){
                            $query->where('email','like','%'.$key.'%')->orWhere('username','like','%'.$key.'%');
                        })
                        ->whereIn('role',[0,2])
                        ->paginate(50);
        }
        if($user)
        {
            $response['data'] = $user;
        }
        else
        {
            $response['message']= 'No users';
            $response['status_code'] = '1';
        }
        
        return view('admin/admin_dashboard',$response);   
    }
    
    public function allResumes($id, Request $request) {
         $response = ['status_code' => '0'];
        $resume = PersonalInfo::where('user_id',$id)->select('*')->paginate(10);
        
        if($resume)
        {
            $response['data'] = $resume;
        }
        else
        {
            $response['message']= 'User havent created any resumes';
            $response['status_code'] = '1';
        }
        
        return view('admin/resume_list',$response);   
    }
}