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
use App\Models\User;
use App\Models\Skill;
use App\Models\JobPosition;
use App\Models\AcquiredSkill;
use App\Models\WorkHistory;
use Validator;
use Carbon\Carbon;
use App\Services\ResumeBuildService;
use Mail;

class ResumeBuildController extends Controller
{
    /**
    * @author RR
    * @param form data
    * @return resume_id
    * @url:<url>/step/personal
    * @access public
    * @since 26-07-2016
    */
    public function savePersonalInfo (Request $request)
    {
        // return $request->all();exit;
        $response = ['status_code' => '0']; 
        //$user_id = $request->user_id;
        
        $rules = [
                'first_name'    => 'required',
                'email_address' => 'required|email',
                'last_name'     => 'required'
                // 'phone_no'         => 'required',
                // 'address'       => 'required',
    
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
        {
            $response['message']= 'validation Failed';
            $response['status_code'] = '2';
        }
        else
        {
            $user = User::where('email','=',$request->email_address)->first();
            if(!$request->session()->has("user"))
            {
                if($user) {   
                    $response['message']= 'Email is already in the system. Please login to continue the service';
                    $response['status_code'] = '1';
                }
                else
                {
                    $key = bin2hex(openssl_random_pseudo_bytes(12));
                    $user = new User();
                    $user->email = $request->email_address;
                    $user->username = $request->first_name;
                    $user->is_verified = 0;
                    $user->last_login = Carbon::now();
                    $user->verify_token = $key;
                    $user->save();
                    $user_id = $user->user_id;
                    $request->session()->set('user', $user);
                    $data['header'] = 'Thank you for registering with The Resume Builder.';
                    $data['call'] = 'Dear ' . $user->username;
                    $data['content'] = [
                        'Thank you for registering with <a href="http://www.theresumebuilder.com" target="new">The Resume Builder!</a>',
                        'Click <a href="' . url('/register/verification/' . $user->user_id . '/' . $user->verify_token) . '" target="new">here</a> to activate your account',
                        'If you have any questions, you can <a href ="http://www.theresumebuilder.com/contact">contact us</a>. We are here to help!'
                    ];

                    $data['signature'] = [
                        'Regards,',
                        'The Resume Builder Team'
                    ];


                    Mail::send('email_template', ['data'=>$data], function($message) use ($user)
                    {

                        $message->to($user->email, 'Resume Builder')->subject('Please verify your email - Resume Builder');
                    });
                    
                    $resume                 = New PersonalInfo();
                    $resume->first_name     = $request->first_name;
                    $resume->last_name      = $request->last_name;
                    $resume->email_address  = $request->email_address;
                    $resume->phone_no       = $request->phone_no;
                    $resume->address        = $request->address;
                    $resume->city           = $request->city;
                    $resume->state          = $request->state;
                    $resume->zip_code       = $request->zip_code;
                    $resume->user_id        = $user_id;
                    $resume->template_id    = $request->template_id;
                    $resume->save();
                    $response['message']= 'Operation Success';
                    $response['id']    = $resume->resume_id;
                    $request->session()->set('resume_id', $resume->resume_id);
                    $response['resume_data'] = $this->getCvData($request);
                }
            }
            else
            {   
                $user= $request->session()->get('user');
                $resume                 = New PersonalInfo();
                $resume->first_name     = $request->first_name;
                $resume->last_name      = $request->last_name;
                $resume->email_address  = $request->email_address;
                $resume->phone_no       = $request->phone_no;
                $resume->address        = $request->address;
                $resume->city           = $request->city;
                $resume->state          = $request->state;
                $resume->zip_code       = $request->zip_code;
                $resume->user_id        = $user->user_id;
                $resume->template_id    = $request->template_id;
                $resume->save();
                $response['message']= 'Operation Success';
                $response['id']    = $resume->resume_id;
                $request->session()->set('resume_id', $resume->resume_id);
                $response['resume_data'] = $this->getCvData($request);
            }
            
            
          
            
        }
        return $response;
    }
    
    /**
    * @author RR
    * @param form data
    * @return resume_id
    * @url:<url>/step/profile
    * @access public
    * @since 26-07-2016
    */
    public function saveProfileDesc (Request $request)
    {
        $response = ['status_code' => '0'];

         $rules = [
                'profile_description' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
        {
            $response['status_code'] = '1';
            $response['message'] = 'validation failed';
        }
        else 
        {
            $resume_id = $request->session()->get('resume_id');
            $resume = PersonalInfo::find($resume_id);
            $resume->profile_description   = $request->profile_description;
            $resume->save();
            $response['message']= 'Operation Success';
            $response['id']            = $resume_id; 
            $response['resume_data'] = $this->getCvData($request);
        }
        
        return $response;
    }
    
    /**
    * @author RR
    * @param form data
    * @return resume_id
    * @url:<url>/step/work
    * @access public
    * @since 26-07-2016
    */
    public function saveWork (Request $request)
    {
        $response = ['status_code' => '0'];
        
        $rules = [
                'company_name'  => 'required',
                // 'position'      => 'required',
                // 'start_year'    => 'required',
                // 'start_month'   => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
        {
            $response['message']= 'Operation Failed';
            $response['status_code'] = '1';
        }
        else
        {
            $resume_id = $request->session()->get('resume_id');
            $start_date = Carbon::createFromDate($request->start_year, $request->start_month,1);
            $resume                 = New WorkHistory();
            $resume->resume_id      = $resume_id;
            $resume->company_name   = $request->company_name;
            $resume->position       = $request->position;
            $resume->location       = $request->location;
            $resume->start_date     = $start_date;

            if($request->end_year && $request->end_month)
            {
               $end_date = Carbon::createFromDate($request->end_year, $request->end_month,1); 
                $resume->end_date       = $end_date;
            }
            $resume->is_present     = $request->is_present;
            $resume->description    = $request->description;
            $resume->save();
            $response['message']= 'Operation Success';
            $response['id']    = $resume_id;
            $response['resume_data'] = $this->getCvData($request);
        }
        
        return $response;
    }
    
    /**
    * @author RR
    * @param form data
    * @return resume_id
    * @url:<url>/step/education
    * @access public
    * @since 26-07-2016
    */
    public function saveEducation (Request $request)
    {
        $response = ['status_code' => '0'];
        
        $rules = [
                'school_name'   => 'required'
                // 'field_of_study'         => 'required',
                // 'start_year'    => 'required',
                // 'start_month'   => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
        {
            $response['message']= 'Operation Failed';
            $response['status_code'] = '1';
        }
        else
        {
            $start_date = Carbon::createFromDate($request->start_year, $request->start_month,1);
            // $graduation_date = Carbon::createFromDate($request->graduate_year, $request->graduate_month,1);
            $resume_id = $request->session()->get('resume_id');
            $resume                     = New Education();
            $resume->resume_id          = $resume_id;
            $resume->school_name        = $request->school_name;
            $resume->location           = $request->location;
            $resume->degree             = $request->degree;
            $resume->field_of_study     = $request->field_of_study;
            $resume->grade              = $request->grade;
            $resume->in_progress        = $request->in_progress;
            $resume->start_date         = $start_date;

            if($request->graduation_year && $request->graduation_month)
            {
               $graduation_date = Carbon::createFromDate($request->graduation_year, $request->graduation_month,1); 
                $resume->graduation_date       = $graduation_date;
            }
            // $resume->graduation_date    = $graduation_date;


            $resume->in_progress        = $request->in_progress;
            $resume->save();
            $response['message']= 'Operation Success';
            $response['id']        = $resume_id;
        }
        
        return $response;
    }
    
    /**
    * @author RR
    * @param form data
    * @return resume_id
    * @url:<url>/step/skill
    * @access public
    * @since 26-07-2016
    */
    public function saveSkills (Request $request)
    {
        $response = ['status_code' => '0'];
        $resume_id = $request->session()->get('resume_id');
        $resume = new Skill();
        $resume->resume_id  = $resume_id;
        $resume->skills     = $request->skills;
        $resume->save();
        $response['message']= 'Operation Success';
        $response['id']= $resume_id;
        return $response;
    }
    
    /**
    * @author RR
    * @param form data
    * @return resume_id
    * @url:<url>step/resume/save
    * @access public
    * @since 26-07-2016
    */
    public function saveResumeName (Request $request)
    {
        $response = ['status_code' => '0'];
        $resume_id = $request->session()->get('resume_id');
            $resume = PersonalInfo::find($resume_id);
            $resume->resume_name = $request->resume_name;
            $resume->save();
            $response['message']= 'Operation Success';
            $response['id']= $resume_id;
        return $response;
        
    }

      /**
    * @author BM
    * @param resume id
    * @return user data
    * @url:<url>get/personal
    * @access public
    * @since 26-07-2016
    */
    public function getPersonalInfo (Request $request)
    {

        // var_dump($request->resume_id); exit;
        $response = ['status_code' => '0'];

        $rules = [
            'resume_id' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) 
        {
            $response['status_code'] = '2';
            $response['message'] = 'validation failed resume_id not given';

        }
        else 
        {

             $user = PersonalInfo::where('resume_id', '=', $request->resume_id)
                            ->select('first_name', 'last_name', 'email_address', 'phone_no','address', 'city', 'state', 'zip_code','profile_description', 'resume_name')
                            ->first();
            if(!$user) 
            {
                $response['status_code']= '1';
                $response['message']= 'user not found';
                $response['request'] = $request->all();
            }
            else 
            {
               $response['result']= $user; 
            }
        }

       
        
        return $response;
    }


    /**
    * @author BM
    * @param resume id
    * @return user data
    * @url:<url>get/profile
    * @access public
    * @since 26-07-2016
    */
    public function getProfileDesc (Request $request)
    {

        $response = ['status_code' => '0'];

        $user = PersonalInfo::where('resume_id', '=', $request->resume_id)
                            ->select('profile_description')
                            ->first();
        if(!$user) 
        {
            $response['status_code']= '1';
            $response['message']= 'user not found';
        }
        else 
        {
           $response['result']= $user; 
        }
        
        return $response;
    }


    /**
    * @author BM
    * @param resume id
    * @return user data
    * @url:<url>get/work
    * @access public
    * @since 26-07-2016
    */
    public function getWorkInfo (Request $request)
    {

        $response = ['status_code' => '0'];

        $user = WorkHistory::where('resume_id', '=', $request->resume_id)
                            ->select('company_name', 'position', 'location', 'start_date', 'end_date', 'is_present', 'description','work_id')
                            ->get();
        if(!$user) 
        {
            $response['status_code']= '1';
            $response['message']= 'record not found';
        }
        else 
        {
            foreach($user as $key => $u) {

               
                $start_year = substr($u->start_date, 0, 4);
                $start_month = substr($u->start_date, 5, 2);
                $end_year = substr($u->end_date, 0, 4);
                $end_month = substr($u->end_date, 5, 2);
                $user[$key]->start_year = $start_year;
                $user[$key]->start_month = $start_month;
                $user[$key]->end_year = $end_year;
                $user[$key]->end_month = $end_month;

            }
            
            $response['result']= $user; 
        }
        
        return $response;
    }


    /**
    * @author BM
    * @param resume id
    * @return user data
    * @url:<url>get/education
    * @access public
    * @since 26-07-2016
    */
    public function getEducation (Request $request)
    {

        $response = ['status_code' => '0'];

        $user = Education::where('resume_id', '=', $request->resume_id)
                            ->select('school_name', 'location', 'degree', 'field_of_study', 'grade', 'start_date', 'graduation_date', 'in_progress', 'education_id')
                            ->get();
        if(!$user) 
        {
            $response['status_code']= '1';
            $response['message']= 'record not found';
        }
        else 
        {
            
           
            foreach($user as $key => $u) {

               
                $start_year = substr($u->start_date, 0, 4);
                $start_month = substr($u->start_date, 5, 2);
                $graduation_year = substr($u->graduation_date, 0, 4);
                $graduation_month = substr($u->graduation_date, 5, 2);
                $user[$key]->start_year = $start_year;
                $user[$key]->start_month = $start_month;
                $user[$key]->graduation_year = $graduation_year;
                $user[$key]->graduation_month = $graduation_month;

            }
           $response['result']= $user; 
        }
        
        return $response;
    }



    /**
    * @author BM
    * @param resume id
    * @return user data
    * @url:<url>get/skills
    * @access public
    * @since 26-07-2016
    */
    public function getSkills (Request $request)
    {

        $response = ['status_code' => '0'];

        $user = Skill::where('resume_id', '=', $request->resume_id)
                            ->select('skills')
                            ->first();
        if(!$user) 
        {
            $response['status_code']= '1';
            $response['message']= 'record not found';
        }
        else 
        {
           $response['result']= $user; 
        }
        
        return $response;
    }
    
    /**
    * @author RR
    * @param form data
    * @return update data
    * @url:<url>/step/edit/skill
    * @access public
    * @since 26-07-2016
    */
    public function editSkill (Request $request)
    {
        $response = ['status_code' => '0'];
        
        $resume_build_service = new ResumeBuildService();
        $edit_user = $resume_build_service->editSkill($request->all());
        if(!$edit_user)
        {
            $response['status_code']= '1';
            $response['message']= 'record not updated';
        }
        else
        {
            $response['result'] = $edit_user;
        }
        return $response;
    }
    
    /**
    * @author BM
    * @param form data
    * @return update data
    * @url:<url>/step/edit/personal
    * @access public
    * @since 26-07-2016
    */
    public function editPersonalInfo(Request $request) 
    {

        $response = ['status_code' => '0'];

        $rules = [
                'first_name'    => 'required'
                // 'email_address' => 'required|email',
                // 'last_name'     => 'required',
                // 'phone_no'         => 'required',
                // 'address'       => 'required',
                // 'resume_id'   => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
        {
            $response['message']= 'Operation Failed validation failed';
            $response['status_code'] = '1';
        }
        else
        {

            $resume_build_service = new ResumeBuildService();
            $edit_user = $resume_build_service->editPersonalInfo($request->all());
            if(!$edit_user)
            {
                $response['status_code'] = '2';
                $response['message'] = 'record not updated';
            }
            else
            {
                $response['result'] = $edit_user;
            }
           

        }
        
         return $response;
        
    }


     /**
    * @author BM
    * @param form data
    * @return update data
    * @url:<url>/step/edit/profile
    * @access public
    * @since 26-07-2016
    */
     public function editProfile(Request $request) 
    {

        $response = ['status_code' => '0'];

        $resume_build_service = new ResumeBuildService();
        
        $edit_user = $resume_build_service->editProfile($request->all());
        
        if(!$edit_user)
        {
            $response['status_code'] = '1';
            $response['message'] = 'record not updated';
        }
        else
        {
            $response['result'] = $edit_user;
        }
           

        
         return $response;
        
    }

    /**
    * @author BM
    * @param form data
    * @return update data
    * @url:<url>/step/edit/work
    * @access public
    * @since 26-07-2016
    */
     public function editWork(Request $request) 
    {

        $response = ['status_code' => '0'];

       $rules = [
                'company_name'  => 'required',
                // 'position'      => 'required',
                // 'start_year'    => 'required',
                // 'start_month'   => 'required',
                'work_id'       => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            $response['status_code'] = '1';
            $response['message'] = 'Operation failed';
        }
        else 
        {
            $resume_build_service = new ResumeBuildService();
            $data = $request->all();

            $data['start_date'] = Carbon::createFromDate($request->start_year, $request->start_month,1);

            //setting end date
            $rules_for_end_date = [
                'end_year'    => 'required',
                'end_month'   => 'required'
             ];
            // $end_date_validator = Validator::make($request->all(), $rules_for_end_date);

             if($request->end_year && $request->end_month)
             {
                $data['end_date'] = Carbon::createFromDate($request->end_year, $request->end_month,1);
            }
            else
            {
                $data['end_date'] = "";

            }
            
            $edit_user = $resume_build_service->editWork($data);


            if(!$edit_user)
            {
                $response['status_code'] = '1';
                $response['message'] = 'record not updated';
            }
            else
            {
                $response['result'] = $edit_user;
            } 
        }
            
           

        
         return $response;
        
    }


    /**
    * @author BM
    * @param form data
    * @return update data
    * @url:<url>/step/edit/education
    * @access public
    * @since 26-07-2016
    */
     public function editEducation(Request $request) 
    {

        $response = ['status_code' => '0'];

        $rules = [
                'school_name'    => 'required'
                // 'field_of_study' => 'required',
                // 'start_year'     => 'required',
                // 'start_month'    => 'required',
                // 'education_id'      => 'required'     
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            $response['status_code'] = '1';
            $response['message'] = 'Operation Failed'; 
        }
        else
        {
            $data = $request->all();

            $data['start_date'] = Carbon::createFromDate($request->start_year, $request->start_month,1);

            //setting end date
            $rules_for_end_date = [
                'end_year'    => 'required',
                'end_month'   => 'required'
             ];
            $end_date_validator = Validator::make($request->all(), $rules_for_end_date);

            if(!$end_date_validator->fails())
            {
                $data['graduation_date'] = Carbon::createFromDate($request->end_year, $request->end_month,1);
            }


            $resume_build_service = new ResumeBuildService();

            $edit_user = $resume_build_service->editEducation($data);

            if(!$edit_user)
            {
                $response['status_code'] = '1';
                $response['message'] = 'record not updated';
            }
            else
            {
                $response['result'] = $edit_user;
            }
        }
            
           

        
         return $response;
        
    }

    /**
    * @author BM
    * @param resume_id
    * @return 
    * @url:<url>/step/delete/work
    * @access public
    * @since 27-07-2016
    */
    public function deleteWork (Request $request)
    {
        $response = ['status_code' => '0'];

        $rules = [
            'work_id' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            $response['status_code'] = '1';
            $response['message'] = 'Operation Failed';

        }
        else 
        {
            $work = WorkHistory::where('work_id','=',$request->work_id)->delete();
            $response['message']= 'record deleted';

        }
        

        return $response;
    }

     

     /**
    * @author BM
    * @param resume_id
    * @return 
    * @url:<url>/step/delete/eduction
    * @access public
    * @since 27-07-2016
    */
     public function deleteEducation(Request $request) 
     {
        $response = ['status_code' => '0'];

        $rules = [
            'education_id' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            $response['status_code'] = '1';
            $response['message'] = 'Operation Failed';
        }
        else 
        {
            $education = Education::where('education_id', '=', $request->education_id)->delete();
            $response['message'] = 'record deleted';
        }

        return $response;

     }

    /**
    * @author RR
    * @param resume_id
    * @return 
    * @url:<url>/step/delete/skill
    * @access public
    * @since 26-07-2016
    */
   public function deleteSkill (Request $request)
   {
       $response = ['status_code' => '0'];
       
       $skill = Skill::where('resume_id','=',$request->resume_id)->delete();
       $response['message']= 'record deleted';
       
       return $response;
   }
    
   
    /**
    * @author RR
    * @param resume_id
    * @return 
    * @url:<url>/delete/resume
    * @access public
    * @since 27-07-2016
    */
   public function deleteResume (Request $request)
   {
       $response = ['status_code' => '0'];
       
       Skill::where('resume_id','=',$request->resume_id)->delete();
       Education::where('resume_id','=',$request->resume_id)->delete();
       WorkHistory::where('resume_id','=',$request->resume_id)->delete();
       PersonalInfo::where('resume_id','=',$request->resume_id)->delete();
       
       $response['message']= 'record deleted';
       
       return $response;
   } 
   
    /**
    * @author RR
    * @param
    * @return array jobpositions
    * @url:<url>/jobs
    * @access public
    * @since 28-07-2016
    */
   public function jobPositions (Request $request)
   {
        $response = ['status_code' => '0'];
        $items = JobPosition::where('position','LIKE','%' . $request->position .'%')->get();
        $arr = array();
        $i = 0;
        foreach($items as $item)
        {
            $arr[$i] = $item->position;
            $i++;
        }
        $response['data'] = $arr;
        return $response;
   }
   
   /**
    * @author RR
    * @param
    * @return array skills
    * @url:<url>/userskill
    * @access public
    * @since 28-07-2016
    */
   public function userSkills (Request $request)
   {
        $response = ['status_code' => '0'];
        $items = AcquiredSkill::where('name','LIKE','%' . $request->skill .'%')->get();
        $arr = array();
        $i = 0;
        foreach($items as $item)
        {
            $arr[$i] = $item->name;
            $i++;
        }
        $response['data'] = $arr;
        return $response;
   }



     /**
    * @author BM
    * @param resume id
    * @return user data
    * @url:<url>get/allCvData
    * @access public
    * @since 26-07-2016
    */
    public function getCvData (Request $request)
    {
        // var_dump($request->resume_id); exit;
        $response = ['status_code' => '0'];

        $resume_id = $request->session()->get('resume_id');

        if(!$resume_id) 
        {
            $response['status_code'] = '2';
            $response['message'] = 'Resume is not available';

        }
        else 
        {

            // getting personal data
             $user = PersonalInfo::where('resume_id', '=', $request->resume_id)
                            ->select('first_name', 'last_name', 'email_address', 'phone_no','address', 'city', 'state', 'zip_code','profile_description', 'template_id', 'resume_name')
                            ->first();
            if(!$user) 
            {
                $response['status_code']= '1';
                $response['message']= 'user not found';
                $response['request'] = $request->all();
            }
            else 
            {
               $response['result']['personal']= $user; 
               $response['result']['personal']['loaded']= "1";

            }

            // get work
            $work = WorkHistory::where('resume_id', '=', $request->resume_id)
                                        ->select('company_name', 'position', 'location', 'start_date', 'end_date', 'is_present', 'description','work_id')
                                        ->get();
            if(!$work) 
            {
                $response['work']['status_code']= '1';
                // $response['message']= 'record not found';
            }
            else 
            {
                foreach($work as $key => $u) {

                   
                    $start_year = substr($u->start_date, 0, 4);
                    $start_month = substr($u->start_date, 5, 2);
                    $end_year = substr($u->end_date, 0, 4);
                    $end_month = substr($u->end_date, 5, 2);
                    $work[$key]->start_year = $start_year;
                    $work[$key]->start_month = $start_month;
                    $work[$key]->end_year = $end_year;
                    $work[$key]->end_month = $end_month;

                }
                
                $response['result']['work']= $work; 
                // $response['result']['work']['loaded']= "1";

            }


            // get educatoin
            $education = Education::where('resume_id', '=', $request->resume_id)
                            ->select('school_name', 'location', 'degree', 'field_of_study', 'grade', 'start_date', 'graduation_date', 'in_progress', 'education_id')
                            ->get();
            if(!$education) 
            {
                $response['education']['status_code']= '1';
                $response['message']= 'record not found';
            }
            else 
            {
                
               
                foreach($education as $key => $u) {

                   
                    $start_year = substr($u->start_date, 0, 4);
                    $start_month = substr($u->start_date, 5, 2);
                    $graduation_year = substr($u->graduation_date, 0, 4);
                    $graduation_month = substr($u->graduation_date, 5, 2);
                    $education[$key]->start_year = $start_year;
                    $education[$key]->start_month = $start_month;
                    $education[$key]->graduation_year = $graduation_year;
                    $education[$key]->graduation_month = $graduation_month;

                }
               $response['result']['education']= $education;
               // $response['result']['education']['loaded']= "1";
 
            }


            // get skills
            $skills = Skill::where('resume_id', '=', $request->resume_id)
                            ->select('skills')
                            ->first();
            if(!$skills) 
            {
                $response['skills']['status_code']= '1';
                $response['message']= 'record not found';
            }
            else 
            {
               $response['result']['skills']= $skills; 
            }

        }

       
        
        return $response;
    }
}


