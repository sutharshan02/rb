<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Home;

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
use Mail;
use Session;

class HomeController extends Controller
{

   /**
    * @author BM
    * @param 
    * @return 
    * @url:<url>/
    * @access public
    * @since 27-07-2016
    */
    public function viewHome(Request $request)
    {
        // return view('welcome');
        return view('home');
    }

    /**
    * @author BM
    * @param 
    * @return 
    * @url:<url>/about
    * @access public
    * @since 14-12-2016
    */
    public function viewAbout() {
        return view('about');
    }

    /**
    * @author BM
    * @param 
    * @return 
    * @url:<url>/contact
    * @access public
    * @since 14-12-2016
    */
    public function viewContact(Request $request) {

        return view('contact');
    }


     /**
    * @author BM
    * @param 
    * @return 
    * @url:<url>/contact/send
    * @access public
    * @since 20-12-2016
    */
    public function contactSend(Request $request) {

        $data = [];
        $data['message']= $request->message;
        $data['name'] = $request->name;
        $data['email'] = $request->email;

        $sendEmail = "admin@theresumebuilder.com";
        // $sendEmail = "chalika@eight25media.com";
        Mail::send('contact_email_template', ['data'=>$data], function($message) use ($sendEmail)
        {

            $message->to($sendEmail, 'Resume Builder')->subject('Message from Contact us');
        });
        $request->session()->flash('sent', 'Your message has been sent!');

        return view('/contact');

    }

         /**
    * @author BM
    * @param 
    * @return 
    * @url:<url>/contact/send
    * @access public
    * @since 20-12-2016
    */
    public function contactSendHome(Request $request) {

        $data = [];
        $data['message']= $request->message;
        $data['name'] = $request->name;
        $data['email'] = $request->email;

        $sendEmail = "admin@theresumebuilder.com";
        // $sendEmail = "chalika@eight25media.com";
        Mail::send('contact_email_template', ['data'=>$data], function($message) use ($sendEmail)
        {

            $message->to($sendEmail, 'Resume Builder')->subject('Message from Contact us');
        });
        $request->session()->flash('sent', 'Your message has been sent!');

        
        return view('home');
        // return redirect('/')->with('sent', 'message');

    }




       /**
    * @author BM
    * @param 
    * @return 
    * @url:<url>/privacy
    * @access public
    * @since 14-12-2016
    */
    public function viewPrivacy() {
        return view('privacy');
    }


    /**
    * @author BM
    * @param 
    * @return 
    * @url:<url>/terms
    * @access public
    * @since 14-12-2016
    */
    public function viewTerms() {
        return view('terms');
    }

    /**
    * @author BM
    * @param 
    * @return 
    * @url:<url>/add-services
    * @access public
    * @since 14-12-2016
    */
    public function viewAddServices() {
        return view('add_services');
    }


}