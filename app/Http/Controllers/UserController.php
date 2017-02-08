<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PersonalInfo;
use App\Models\Education;
use App\Models\Skill;
use App\Models\JobPosition;
use App\Models\AcquiredSkill;
use App\Models\WorkHistory;
use Validator;
use Carbon\Carbon;
use Config;
use Session;
use View;
use Mail;
use PDF;

class UserController extends Controller
{


    // for testing
    public function dumpx($name, $item) {
       echo "<p>";
       echo $name . " =>";
       var_dump($item);
       echo "</p><br/>";
   }

    public function viewForm (Request $request)
    {
        $response['status_code']='4';
        $data = [];
        if($request->session()->has('flash_msg'))
        {
            $response = $request->session()->pull('flash_msg');
            $request->session()->remove('flash_msg');
        }
        if($request->session()->has('verified')) 
        {
            $status = $request->session()->pull('verified');
            // echo $status['status'];die();
            if($status['status'] == 1) 
            {

            $data['verified']  = true;
            }
            else//if($status == 2) 
            
            {
                
            $data['verified']  = false;
            }
            $request->session()->remove('verified');
        }
        // $data['type'] = 'y';
        return view('register_login')->with('res',$response)->with('data', $data);
        // return view('register_login-old')->with('res',$response);
    }
    
    /**
    * @author RR
    * @param form data
    * @return user_id
    * @url:<url>/register
    * @access public
    * @since 26-07-2016
    */
    public function register (Request $request)
    {
        $response = ['status_code' => '0'];
        $rules = [
                'username'          => 'required',
                'email'             => 'required|email',
                'password'          => 'required',
                'confirm_password'  => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
        {
            $response['message']= 'All fields required';
            $response['status_code'] = '1';
        }
        else
        {
            if($request->password != $request->confirm_password)
            {
                $response['message']= 'Confirm password mismatched';
                $response['status_code'] = '1';
            }
            else
            {
                $exit_user = User::where('email','=',$request->email)
                             // ->Orwhere('username','=',$request->username)
                             ->first();
                if(!$exit_user)
                {
                    $key = bin2hex(openssl_random_pseudo_bytes(12));
                    $user = new User();
                    $user->email = $request->email;
                    $user->username = $request->username;
                    $user->password = $request->password;                    
                    $user->is_verified = 1;
                    $user->last_login = Carbon::now();
                    $user->verify_token = $key;
                    $user->save();
                    
                    
                    $data['header'] = 'Thank you for registering with The Resume Builder.';
                    $data['call'] = 'Dear ' . $user->username;
                    $data['content'] = [
                        'Thank you for registering with <a href="http://www.theresumebuilder.com" target="new">The Resume Builder!</a>',
                        'Click <a href="' . url('/register/verification/' . $user->user_id . '/' . $user->verify_token) . '" target="new">here</a> to activate your account',
                        'If you have any questions, you can <a href ="http://www.theresumebuilder.com/contact">contact us</a>. We are here to help!'
                    ];
                    $data['button'] = url('/register/verification/' . $user->user_id . '/' . $user->verify_token);
                    $data['button_name'] = "VERIFY YOUR ACCOUNT";
                    $data['signature'] = [
                        'Regards,',
                        'The Resume Builder Team'
                    ];

                    Mail::send('user_verify_email_template', ['data'=>$data], function($message) use ($user)
                    {

                        $message->to($user->email, 'Resume Builder')->subject('Please verify your email - Resume Builder');
                    });
                    
                    Mail::send('welcome_email_template', ['data'=>$data], function($message) use ($user)
                    {

                        $message->to($user->email, 'Resume Builder')->subject('Welcome to Resume Builder');
                    });


                    $response['message']= 'Registration completed. Please check you inbox and verifiy your account';
                    $response['id'] = $user->user_id;
                    $request->session()->set('user', $user);
                    $response['user'] = $user;
                    
                    $sub_obj = [];
                    
                    $sub_obj['subscribed'] = 0;
                    $sub_obj['plan'] = 0;
                    $sub_obj['failed']=0;
                    $subscription = \App\Models\Subscription::where('user_id',$user->user_id)->where('status',1)->orderBy('id','desc')->first();
                    
                    if($subscription){
                        if($subscription->status=='1')
                        {
                            $sub_obj['failed']=0;
                            if($subscription->active_until>time())
                            {
                                $sub_obj['subscribed'] = 1;
                                $sub_obj['plan']=$subscription->plan;
                                $sub_obj['next_bill_date'] = date('m/d/Y', $subscription->active_until);
                                if($subscription->plan=='1')
                                {
                                    $sub_obj['plan_txt']='Yearly Plan';
                                    $sub_obj['next_bill_amount']='$99.00';
                                }
                                else
                                {
                                    $sub_obj['plan_txt']='Monthly Plan';
                                    $sub_obj['next_bill_amount']='$14.95';
                                }
                            }
                            else
                                $sub_obj['failed'] = 1;
                        }
                        else
                            $sub_obj['failed']=1;
                    }
                    $request->session()->set('sub_object', $sub_obj);
                    return redirect('/dashboard');
                }
                else
                {
                    $response['message']= 'Email already exists in the database. Please login to proceed';
                    $response['status_code'] = '1';
                }
            }            
        }
        $request->session()->set('flash_msg',$response);
        return redirect('/user/create');
    }
    
    /**
    * @author RR
    * @param user_id
    * @param verication_code
    * @return user_id
    * @url:<url>register/verification/<user_id>/<verication_code>
    * @access public
    * @since 15-08-2016
    */
    public function accountVerified (Request $request)
    {
        $response = ['status_code' => '0'];
        if ((isset($request->user_id)) && (isset($request->verification_code)))  //checking both user id and verification code are exist in request data
        {
            
            $user = User::find($request->user_id);

            if (($user != null) && ($user->is_verified == 1)) //check for verification already done
            { 
                $response['message']= 'Verification already done';
                $response['status_code'] = '1';
                  // Session::flash('verified', 'ddd');
                  // $request->session()->flash('accountActivated', 'Task was successful!');
                // $request->session()->flash('status', 'Task was successful!');
                // $request->session()->flash('status', 'value');
             
                $data['status'] = 2; // already verified
                // $request->session()->forget('status');
                $request->session()->set('verified', $data);
                return redirect('/user/create');
                // return redirect('/user/create');
            }
            else if ($user == null)
            {
                $response['message']= 'User does not exsist';
                $response['status_code'] = '1';
            }
            else
            {               
                if($user->password==null)
                {
                    return view('register_password',$user);
                }
                else
                {
                    $user->verify_token = '';
                    $user->status = 1;
                    $user->is_verified = 1;
                    $user->save();
                    // Session::flash('verified', true); // did not work
                
                $data['status'] = 1; // verified
                 $request->session()->set('verified', $data);
                return redirect('/user/create');
                    // return view('register_login');
                }               
            }
        }
        else
        {
            $response['message']= 'Verification failed';
            $response['status_code'] = '1';

        }
        return $response;
    }
    
     /**
    * @author RR
    * @param user
    * @return
    * @url:<url>/register/password
    * @access public
    * @since 24-08-2016
    */
    public function accountSetPassword (Request $request)
    {
        $response = ['status_code' => '0'];
        $rules = [
                'username'          => 'required',
                'password'          => 'required',
                'confirm_password'  => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
        {
            $response['message']= 'All fields required';
            $response['status_code'] = '1';
        }
        else
        {
            if($request->password != $request->confirm_password)
            {
                $response['message']= 'Confirm password mismatched';
                $response['status_code'] = '1';
            }
            else
            {
                $user = User::find($request->id);
                $user->username = $request->username;
                $user->password = $request->password;
                $user->verify_token = '';
                $user->status = 1;
                $user->is_verified = 1;
                $user->save();
                return redirect('/user/create');
                
            }
        }
        return $response;
    }
    
    /**
    * @author RR
    * @param new_password
    * @param new_password_confirm
    * @return user 
    * @url:<url>/password/change
    * @access public
    * @since 27-07-2016
    */
    public function changePassword  (Request $request)
    {
        $response = ['status_code' => '0'];
        if(($request->session()->get('user'))!=null)
        {
            if($request->new_password==$request->new_password_confirm) //matching confirm and new passwords
            {
                $old_pw = $request->old_password;
                $user = $request->session()->get('user');
                $user = User::find($user->user_id);

                //check user's availabilty, password matching
                if(($user!=null) && ($user->password==$old_pw))
                {
                    $user->password = $request->new_password;
                    $user->save();
                    $response['id']= $user->user_id;
                    
                }
                else
                {
                    $response['message']= 'Not registered user';
                    $response['status_code'] = '1';
                }           
            }
            else
            {
                $response['message']= 'Confirm password does not match';
                $response['status_code'] = '1';
            }
        }
        else
        {
            $response['message']= 'User not found';
            $response['status_code'] = '1';
            
        }
        
        return $response;
    }
    
    public function generatePDF(Request $request)
    {
       
        
        

        $template_id = $request->template_id;

        $data['personal'] = PersonalInfo::where('resume_id', '=', $request->resume_id)
                          ->select('first_name', 'last_name', 'email_address', 'profile_description', 'phone_no', 'address', 'city', 'state', 'zip_code', 'skills', 'resume_name')->first();

        $resume_name = $data['personal']['resume_name'];
        $resume_name = preg_replace('/\s+/', '_', $resume_name);
        // $data['work'] = WorkHistory::where('resume_id', '=', $request->resume_id)
        $work = WorkHistory::where('resume_id', '=', $request->resume_id)
                      ->select('company_name', 'position', 'description', 'responsibilities', 'start_date', 'end_date', 'is_present')->orderBy('is_present','desc')->orderBy('end_date','desc')->get();


        $workData = [];
        $i = 0;
        foreach($work as $item) {

            $workData[$i]['company_name'] = $item['company_name'];
            $workData[$i]['position'] = $item['position'];
            $workData[$i]['description'] = $item['description'];
            $workData[$i]['responsibilities'] = $item['responsibilities'];
            $workData[$i]['is_present'] = $item['is_present'];

            // creating years from dates
            $workData[$i]['start_date'] = $item['start_date'];
            $workData[$i]['end_date'] = $item['end_date'];


            $workData[$i]['start_year'] = 
            ($item['start_date'] != null && $item['start_date'] != '0000-00-00' ) ? Carbon::parse($item['start_date'])->format('Y') : '';

            $workData[$i]['end_year'] = 
            ($item['end_date'] != null && $item['end_date'] != '0000-00-00' ) ? Carbon::parse($item['end_date'])->format('Y') : '';
            $i++;
        }
         $data['work'] = $workData;

        // $data['education'] = Education::where('resume_id', '=', $request->resume_id)
        $education = Education::where('resume_id', '=', $request->resume_id)
                      ->select('school_name', 'degree', 'gpa', 'grade', 'description', 'location', 'field_of_study', 'in_progress', 'graduation_date', 'start_date')->orderBy('in_progress','desc')->orderBy('graduation_date','desc')->get();

        $educationData = [];
        $i = 0;
        foreach($education as $item) {

            $educationData[$i]['school_name'] = $item['school_name'];
            $educationData[$i]['location'] = $item['location'];
            $educationData[$i]['degree'] = $item['degree'];
            $educationData[$i]['gpa'] = $item['gpa'];
            $educationData[$i]['grade'] = $item['grade'];
            $educationData[$i]['description'] = $item['description'];
            $educationData[$i]['field_of_study'] = $item['field_of_study'];
            $educationData[$i]['in_progress'] = $item['in_progress'];

            // creating years from dates
            $educationData[$i]['start_date'] = $item['start_date'];
            $educationData[$i]['graduation_date'] = $item['graduation_date'];


            $educationData[$i]['start_year'] = ($item['start_date'] != null) ? Carbon::parse($item['start_date'])->format('Y') : null;
            $educationData[$i]['graduation_year'] = ($item['graduation_date'] != null) ? Carbon::parse($item['graduation_date'])->format('Y') : null;

            $i++;

        }

            // var_dump($educationData);die();
        $data['education'] = $educationData;
      $data['skills']['skills'] =$data['personal']->skills;

        // preview in browser
        //   $download = $request->d;
        // if($download == null) {

        //     return view( 'resume_builder/download' . $template_id  )->with('data',$data);die();
        // }
        /**/

        $out = View::make('resume_builder/download' . $template_id  )->with('data',$data)->render();
        //'src'       => $out,
        //$ch = curl_init('http://pdfcrowd.com/api/pdf/convert/html/');
        // $file_path = storage_path()."/".$request->resume_id."_resume.pdf";
        if($resume_name == null) $resume_name = "resume"; 
        $file_path = storage_path()."/".$request->resume_id . "_" . $resume_name.".pdf";
        $fp = fopen($file_path, "wb");
        
       $post = [
            'username'  => Config::get('constants.PDFCROWD_USERNAME'),
            'key'       => Config::get('constants.PDFCROWD_KEY'),
            'src'       => $out,
            // 'margin_top'    => -1,
            // 'margin_right'  => -1,
            // 'margin_bottom' => -1,
            // 'margin_left'   => -1,
            'pdf_scaling_factor' => 1,
            'html_zoom' => 150
            // 'width' => '148mm',
            // 'height' => '210mm',
            //'footer_html'=> 'sdfghjkl;',
        ];

        $ch = curl_init('http://pdfcrowd.com/api/pdf/convert/html/');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_FILE,$fp);
        // execute!
        $response = curl_exec($ch);
        // close the connection, release resources used
        curl_close($ch);
        
        return response()->download($file_path);  
        
        // do anything you want with your response
    }
    
    /**
    * @author RR
    * @param user_id
    * @return created resume details
    * @url:<url>/resume/all
    * @access public
    * @since 28-07-2016
    */
    public function userCreatedResumes (Request $request)
    {
        $response = ['status_code' => '0'];
        
        $resume = PersonalInfo::where('user_id','=',$request->user_id)
                              ->select('resume_id','resume_name','is_draft','template_id')
                              ->get();
        if($resume)
        {
            $response['data']= $resume;
        }
        else
        {
            $response['message']= 'No resumes';
            $response['status_code'] = '1';
        }
        
        return $response;
    }
    
    public function testWord1 ()
    {
        $blade = 'wordview';
        $file = bin2hex(openssl_random_pseudo_bytes(4));
        $view = view($blade)->with('this','test_data');
        $contents = $view->render();
        file_put_contents($file.'.html', $contents);
        
        $source = public_path()."\\".$file.".html";
        var_dump($source);

        $phpWord = \PhpOffice\PhpWord\IOFactory::load($source, 'HTML');
        $section = $phpWord->addSection();
        
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('helloWorld2.docx');
    }



    /**
    * @author BM
    * @param 
    * @return 
    * @url:<url>/logout
    * @access public
    * @since 09-08-2016
    */
    public function logout(Request $request) 
    {
        Session::clear();
        Session::invalidate();
        // return Session::get('user');
        return redirect('/');
    }
    
    /**
    * @author RR
    * @param 
    * @return seeings page
    * @url:<url>/settings
    * @since 13-09-2016
    */
    public function settings (Request $request)
    {
        $user = $request->session()->get('user');
        $response['status_code']='4';
        if($request->session()->has('flash_msg'))
        {
            $response = $request->session()->pull('flash_msg');
            $request->session()->remove('flash_msg');
        }
        $plan = 0;
        $subscription = \App\Models\Subscription::where('user_id',$user->user_id)->where('status','1')->first();
        if($subscription)
            $plan = $subscription->plan;
        return view('settings',$user)->with('res', $response)->with('plan',$plan)->with('subscription',$request->session()->get('sub_object'));
    }
    
    
    /**
    * @author RR
    * @param setting page form data
    * @return 
    * @url:<url>/settings/update
    * @access public
    * @since 13-09-2016
    */
    public function settingUpdate (Request $request)
    {
        $response = ['status_code' => '0'];
        $rules = [
                'current_password'      => 'required',
                'new_password' => 'required',
                'confirm_password' => 'required'
        ];
        $is_error = false;
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
        {
            $response['message']= 'All fields are required';
            $response['status_code'] = '1';
            $is_error = true;
        }
        else
        {   
            if($request->new_password==$request->confirm_password)
            {
                $user = User::find($request->_user->user_id);
                if($user->password == $request->current_password)
                {
                    $user->password = $request->new_password;
                    $user->save();
                    $response['message']= 'settings changed successfully';
                    $request['status_code'] = '0';
                }
                else
                {
                    $response['message']= 'Current password do not match';
                    $response['status_code'] = '1';
                    $is_error = true;
                }
            }
            else
            {
                $response['message']= 'Password and Confirm password do not match';
                $response['status_code'] = '1';
                $is_error = true;
            }       
        }
        $request->session()->set('flash_msg',$response);
        return redirect('settings');
    }

    public function viewPassswordResetForm(Request $request) {
        
        // return view ('forget_password');
        return view ('forget_password');
        
    }
    /**
    * @author PL
    * @param 
    * @return seeings page
    * @url:<url>/admin/settings
    * @since 02-01-2017
    */
    public function changePass (Request $request)
    {
        $user = $request->session()->get('user');
        $response['status_code']='4';
        if($request->session()->has('flash_msg'))
        {
            $response = $request->session()->pull('flash_msg');
            $request->session()->remove('flash_msg');
        }
        
        return view('admin/change_password')->with('res', $response);
    }
    /**
    * @author RR
    * @param setting page form data
    * @return 
    * @url:<url>/settings/update
    * @access public
    * @since 13-09-2016
    */
    public function adminSettingUpdate (Request $request)
    {
        $response = ['status_code' => '0'];
        $rules = [
                'current_password'      => 'required',
                'new_password' => 'required',
                'confirm_password' => 'required'
        ];
        $is_error = false;
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
        {
            $response['message']= 'All fields are required';
            $response['status_code'] = '1';
            $is_error = true;
        }
        else
        {   
            if($request->new_password==$request->confirm_password)
            {
                $user = User::find($request->_user->user_id);
                if($user->password == $request->current_password)
                {
                    $user->password = $request->new_password;
                    $user->save();
                    $response['message']= 'settings changed successfully';
                    $request['status_code'] = '0';
                }
                else
                {
                    $response['message']= 'Current password do not match';
                    $response['status_code'] = '1';
                    $is_error = true;
                }
            }
            else
            {
                $response['message']= 'Password and Confirm password do not match';
                $response['status_code'] = '1';
                $is_error = true;
            }       
        }
        $request->session()->set('flash_msg',$response);
        return redirect('admin/settings');
    }
    
    public function viewSendEmail($id,$t_id, Request $request) {
        
        $data['cover_letter'] = 'Your content goes here';
        $data['resume_id'] = $id;
        $data['template_id'] = $t_id;
        
        return view('send_email',$data);  
        
    }
    
    public function postEmail(Request $request) {
        $response = ['status_code' => '0'];
        $rules = [
                'email'      => 'required|email',
                'cover_letter' => 'required',
        ];
        
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
        {
            $response['message']= 'All fields are required';
            $response['status_code'] = '1';
             Session::flash("error", $response['message']); 
             return redirect('send/email/'.$request->resume_id); 
        }
        else
        {
            $resume_id = $request->resume_id;
            $template_id = $request->template_id;
            $company_email = $request->email;
            $cover_letter = $request->cover_letter;
            
            $data['personal'] = PersonalInfo::where('resume_id', '=', $request->resume_id)
                                ->select('first_name', 'last_name', 'email_address', 'profile_description', 'phone_no', 'address', 'city', 'state', 'zip_code', 'skills', 'resume_name')->first();

              $resume_name = $data['personal']['resume_name'];
              $resume_name = preg_replace('/\s+/', '_', $resume_name);
              // $data['work'] = WorkHistory::where('resume_id', '=', $request->resume_id)
              $work = WorkHistory::where('resume_id', '=', $request->resume_id)
                            ->select('company_name', 'position', 'description', 'responsibilities', 'start_date', 'end_date', 'is_present')->get();


              $workData = [];
              $i = 0;
              foreach($work as $item) {

                  $workData[$i]['company_name'] = $item['company_name'];
                  $workData[$i]['position'] = $item['position'];
                  $workData[$i]['description'] = $item['description'];
                  $workData[$i]['responsibilities'] = $item['responsibilities'];
                  $workData[$i]['is_present'] = $item['is_present'];

                  // creating years from dates
                  $workData[$i]['start_date'] = $item['start_date'];
                  $workData[$i]['end_date'] = $item['end_date'];
                  $workData[$i]['start_year'] = Carbon::parse($item['start_date'])->format('Y');
                  $workData[$i]['end_year'] = Carbon::parse($item['end_date'])->format('Y');

                  $i++;
              }
               $data['work'] = $workData;

              // $data['education'] = Education::where('resume_id', '=', $request->resume_id)
              $education = Education::where('resume_id', '=', $request->resume_id)
                            ->select('school_name', 'degree', 'gpa', 'grade', 'description', 'location', 'field_of_study', 'in_progress', 'graduation_date', 'start_date')->get();

              $educationData = [];
              $i = 0;
              foreach($education as $item) {

                  $educationData[$i]['school_name'] = $item['school_name'];
                  $educationData[$i]['location'] = $item['location'];
                  $educationData[$i]['degree'] = $item['degree'];
                  $educationData[$i]['gpa'] = $item['gpa'];
                  $educationData[$i]['grade'] = $item['grade'];
                  $educationData[$i]['description'] = $item['description'];
                  $educationData[$i]['field_of_study'] = $item['field_of_study'];
                  $educationData[$i]['in_progress'] = $item['in_progress'];

                  // creating years from dates
                  $educationData[$i]['start_date'] = $item['start_date'];
                  $educationData[$i]['graduation_date'] = $item['graduation_date'];
                  $educationData[$i]['start_year'] = Carbon::parse($item['start_date'])->format('Y');
                  $educationData[$i]['graduation_year'] = Carbon::parse($item['graduation_date'])->format('Y');

                  $i++;
              }

              $data['education'] = $educationData;
            $data['skills']['skills'] =$data['personal']->skills;

              // preview in browser

              // return view( 'resume_builder/download' . $template_id  )->with('data',$data);die();
              /**/

              $out = View::make('resume_builder/download' . $template_id  )->with('data',$data)->render();
              //'src'       => $out,
              //$ch = curl_init('http://pdfcrowd.com/api/pdf/convert/html/');
              // $file_path = storage_path()."/".$request->resume_id."_resume.pdf";
            if($resume_name == null) $resume_name = "resume"; 
                    $file_path = storage_path()."/".$request->resume_id . "_" . $resume_name.".pdf";
                    $fp = fopen($file_path, "wb");
                    
                   $post = [
                        'username'  => Config::get('constants.PDFCROWD_USERNAME'),
                        'key'       => Config::get('constants.PDFCROWD_KEY'),
                        'src'       => $out,
                        // 'margin_top'    => -1,
                        // 'margin_right'  => -1,
                        // 'margin_bottom' => -1,
                        // 'margin_left'   => -1,
                        'pdf_scaling_factor' => 1,
                        'html_zoom' => 150
                        // 'width' => '148mm',
                        // 'height' => '210mm',
                        //'footer_html'=> 'sdfghjkl;',
                    ];

                    $ch = curl_init('http://pdfcrowd.com/api/pdf/convert/html/');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                    curl_setopt($ch, CURLOPT_FILE,$fp);
                    // execute!
                    $response = curl_exec($ch);
                    // close the connection, release resources used
                    curl_close($ch);            
                    
            //sending email
            
            $data['header'] = 'Sending resume with Resume builder.';
            $data['call'] = 'Dear Sir ';
            $data['content'] = $cover_letter;
            

            $data['signature'] = [
                'Regards,',
                'The Resume Builder Team'
            ];

            
            Mail::send('send_email_template', ['data'=>$data], function($message) use ($company_email,$file_path)
            {

            $message->to($company_email, 'Resume Builder')->subject('The Resume Builder');
            $message->attach($file_path);
            
            });

            $data['message'] = "Email send successfull..";
            Session::flash("success", $data['message']);
             return redirect('send/email/'.$resume_id.'/'.$template_id); 
        }
        
    }

}