<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Validator;
use Mail;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    
    /**
    * @author RR
    * @param email
    * @param password
    * @return user 
    * @url:<url>/home
    * @access public
    * @since 27-07-2016
    */
    public function index (Request $request)
    {
        $response = ['status_code' => '0'];
        $rules = [
            'email'     => 'required|email',
            'password'  => 'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) 
        {
            $response['message']= 'Username or password wrong';
            $response['status_code'] = '1';
        }
        else
        {
            $user = User::where('email','=',$request->email)
                    ->where('password','=',$request->password)
                    ->first();
            if($user)//check user exist
            { 
                if($user->role == 0 || $user->role == 2){
                if($user->is_verified == 1 && $user->status==1)
                {
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
                    $response['message']= 'User is not verified. Please check your email and activate the account';
                    $response['status_code'] = '1';
                }
            }else if($user->role == 1){
                $request->session()->set('user', $user);
                $response['user'] = $user;
                return redirect('/admin/dashboard');
            }
            }
            else
            {
                $response['message']= 'Incorrect login credentials';
                $response['status_code'] = '1';
            }
        }
        
       $request->session()->set('flash_msg',$response);
       return redirect('/user/create');
    }
    
    /**
    * @author RR
    * @param username
    * @param email
    * @return
    * @url:<url>/password/reset
    * @access public
    * @since 27-07-2016
    */
    public function reset (Request $request)
    {
        $response = ['status_code' => '0'];
        $rules = [
            'email'     => 'required|email'
            
        ];
        
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
        {
            $response['message']= 'Operation Failed';
            $response['status_code'] = '1';
            
        }
        else
        {
            $user = User::where('email','=',$request->email)
                        ->first();
            if($user)
            {
                if($user->status==1) //check user status
                {
                    $key = bin2hex(openssl_random_pseudo_bytes(12));
                    $user->reset_token = $key;
                    $user->save();
                    
                    //link should be sent as password/reset/{user_id}/{reset_token}
                    //send mail
                    $data['call'] = 'Hi ' . $user->username;
                   

                    $data['content'] = [
                        'We received a request to reset your Resume Builder password for your account.',
                        'To reset your password you will need to visit the link below. This will take you to a page where you can enter a new password. You will then be able to login to Resume Builder site.',
                        'Your account uses the login name: '.$user->username,
                        'You can reset your <a href="' . url('password/reset/' . $user->user_id . '/' . $key) . '" target="new">password</a>',
                        'If you are unable to click on the link above, copy and paste it into your browser address bar.',
                        'If you didn’t request this password reset, please ignore this email.'
                    ];

                    $data['signature'] = [
                        'Regards,',
                        'The Resume Builder Team'
                    ];

                    $data['button'] = url('password/reset/' . $user->user_id . '/' . $key);

                    // Mail::send('welcome_email_template', ['data'=>$data], function($message) use ($user)
                    // Mail::send('user_verify_email_template', ['data'=>$data], function($message) use ($user)
                    Mail::send('forgot_password_email_template', ['data'=>$data], function($message) use ($user)
                    // Mail::send('email_template', ['data'=>$data], function($message) use ($user)
                    {

                        $message->to($user->email, 'Resume Builder')->subject('Please verify your email - Resume Builder');
                    });  
                    
                   
                    $response['message']= 'Password reset email sent.';
                    $response['id'] = $user->user_id;
                    
                }
                else
                {
                    $response['message']= 'User disabled';
                    $response['status_code'] = '1';
                }
            }
            else
            {
                $response['message']= 'User not found';
                $response['status_code'] = '1';
            }
            $request->session()->flash('forget_msg', $response['message']);
            return view('forget_password');
        }
        
    }
    
    /**
    * @author RR
    * @param user_id
    * @param reset token
    * @return user_id
    * @url:<url>/password/reset/{user_id}/{reset_token}
    * @access public
    * @since 27-07-2016
    */
    public function resetVerify (Request $request)
    {
        $response = ['status_code' => '0'];
        if((isset($request->user_id)) && (isset($request->reset_token)))
        {
            $user = User::where('user_id','=',$request->user_id)
                        ->where('reset_token','=',$request->reset_token)
                        ->first();
            if($user)
            {
                return view('reset_password')->with('id', $user->user_id);
            }
            else
            {
                $response['message']= 'User not found';
                $response['status_code'] = '1';
            }
        }
        else
        {
            $response['message']= 'Invalid arguments';
            $response['status_code'] = '1';
        }
        
        return $response;
    }
    
    /**
    * @author RR
    * @param password_new
    * @param password_confirm
    * @param user_id
    * @return user_id
    * @url:<url>/password/new
    * @access public
    * @since 27-07-2016
    */
    public function resetPassword (Request $request)
    {
        $response = ['status_code' => '0'];
        $rules = [
            'password_new'      => 'required',
            'password_confirm'  => 'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) 
        {
            $response['message']= 'All fields required';
            $response['status_code'] = '1';
        }
        else
        {
            if($request->password_new ==$request->password_confirm)
            {
                $user = User::find($request->user_id);
                $user->password     = $request->password_new;
                $user->reset_token  = null;
                $user->save();
                $response['message']= 'Password changed';
                $response['id']= $user->user_id;
                
                return view('register_login')->with('res',$response);
            }
            else
            {
                $response['message']= 'Confirm password does not match';
                $response['status_code'] = '1';
            }
        }    
        $request->session()->flash("reset_msg", $response['message']);
        return redirect()->back();
        
    }
}
