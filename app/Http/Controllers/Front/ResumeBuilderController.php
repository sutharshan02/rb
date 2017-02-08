<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PersonalInfo;
use App\Models\Education;
use App\Models\Skill;
use App\Models\JobPosition;
use App\Models\AcquiredSkill;
use App\Models\WorkHistory;
use Validator;
use Carbon\Carbon;
use App\Services\ResumeBuildService;

class ResumeBuilderController extends Controller
{
      /**
    * @author BM
    * @param
    * @return resume builder view
    * @url:<url>/resume/home
    * @access public
    * @since 03-08-2016
    */
      public function resumeBuilderView (Request $request)
      {
        // echo '<pre>';
        // var_dump ($request->session()->has("user"));
        //   die();
        return view('resume_builder/rb');
      }



    /**
    * @author BM
    * @param
    * @return resume download template display
    * @url:<url>/resume/download
    * @access public
    * @since 15-08-2016
    */
    public function downloadResume (Request $request)
    {
     

      $data['personal'] = PersonalInfo::where('resume_id', '=', $request->resume_id)
                          ->select('first_name', 'last_name', 'email_address', 'profile_description','skills')->first();

      $data['work'] = WorkHistory::where('resume_id', '=', $request->resume_id)
                      ->select('company_name', 'position')->get();

      $data['education'] = Education::where('resume_id', '=', $request->resume_id)
                      ->select('school_name', 'degree', 'location')->get();
      $skill = new Skill();
      $skill->skills = $data['personal']->skills;
      $data['skills'] = $skill;

 

      return view('resume_builder/download')->with('data', $data);
    }




    /**
    * @author BM
    * @param
    * @return resume download template display
    * @url:<url>/dashboard
    * @access public
    * @since 25-10-2016
    */

    public function dashboard(Request $request) 
    {

      $response = ['status_code' => '0'];
        $resume = PersonalInfo::where('user_id','=',$request->_user->user_id)
        // $resume = PersonalInfo::where('user_id','=',1)
                              ->select('resume_id','resume_name','is_draft','template_id', 'created_at', 'updated_at')
                              ->paginate(20);
                              // ->get();
          // $resume['createdd'] = Carbon::parse('11/06/1990')->format('d/m/Y');
        $data = [];
        if(sizeof($resume))
        {
          $i = 0;
          foreach($resume as $item) 
          {
            $data[$i]['resume_id'] = $item['resume_id'];
            $data[$i]['resume_name'] = $item['resume_name'];
            $data[$i]['template_id'] = $item['template_id'];
            // $data[$i]['created_at'] = $item['created_at'];
            $data[$i]['created_at'] = Carbon::parse($item['created_at'])->format('d M Y');
            $data[$i]['updated_at'] = Carbon::parse($item['updated_at'])->format('d M Y');
            $i++;
          }
          // var_dump($data);die();
            $response['data']= $resume;
        }
        else
        {
            $response['message']= 'No resumes';
            $response['status_code'] = '1';
            return redirect('resume/new');
        }
        
        return view('resume_builder/dashboard')->with('data', $data)->with('link', $resume);    
        // return view('resume_builder/old-dashboard')->with('data', $resume);    
    }
  }


