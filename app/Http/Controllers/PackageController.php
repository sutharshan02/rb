<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use Validator;
use Carbon\Carbon;

class PackageController extends Controller 
{
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
		'package_name' 	=> 	'required',
		'package_desc' 	=> 	'required',
		'package_id'	=>	'required'
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

    /**
    * @author BM
    * @param form data
    * @return resume_id
    * @url:<url>/package/edit/status
    * @access public
    * @since 27-07-2016
    */
    public function editPackageStatus(Request $request) 
    {
    	$response = ['status_code' => '0'];

    	$rules =[
    		'status'	 => 'required',
    		'package_id' =>	'required'
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
    			$package['status'] = $request->status;
    			$package->save();
    			$response['message'] = 'Operation Success';
    		}
    		else 
    		{
    			$response['message'] = 'no record found';
    		}
    		
    	}

    	return $response;
    }

     /**
    * @author BM
    * @param package id
    * @return resume_id
    * @url:<url>/package/delete
    * @access public
    * @since 27-07-2016
    */
     public function deletePackage(Request $request)
     {
     	$response = ['status_code' => '0'];

     	$rules = [
     	'package_id' => 'required'
     	];

     	$validator = Validator::make($request->all(), $rules);

     	if($validator->fails()) 
     	{
     		$response['status_code'] = '1';
     		$response['message'] = 'Operation Failed';
     	}
     	else
     	{
     		Package::where('package_id', '=', $request->package_id)->delete();
     		$response['message'] = 'record deleted';
     	}

     	return $response;
     }


    /**
    * @author BM
    * @param package id
    * @return resume_id
    * @url:<url>/package/get
    * @access public
    * @since 27-07-2016
    */
    public function getPackage(Request $request)
    {
    	$response = ['status_code' => '0'];

    	$rules = [
    		'package_id' => 'required'
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
    			$response['result'] = $package;
    		}
    		else
    		{
    			$response['status_code'] = '1';
    			$response['message'] = 'no record found';
    		}
    	}

    	return $response;
    }


    /**
    * @author BM
    * @param 
    * @return resume_id
    * @url:<url>/package/getall
    * @access public
    * @since 27-07-2016
    */
    public function getAllPackages()
    {
    	$response = ['status_code' => '0'];

    	$packages = Package::all();
    	if($packages)
    	{
    		$response['result'] = $packages;
    	} 
    	else 
    	{
    		$response['status_code'] = 'Operation Failed';
    		$response['message'] = 'no records found';
    	}

    	return $response;
    }
 }

