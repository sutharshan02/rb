<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class SubscriptionController extends Controller
{
    public function viewPlans (Request $request)
    {
        $plan = -1;
        $user = $request->session()->get('user');
        if($user){
            $plan = 0;
            $subscription = \App\Models\Subscription::where('user_id',$user->user_id)->where('status','1')->first();
            if($subscription)
                $plan = $subscription->plan;
        }
        return view('plans')->with('plans',$plan);
    }
    
    public function payStep(Request $request)
    {
        $package = Package::find($request->package_id);
        if($package->subscription_period == 0)
        {
            return redirect()->back();
        }
        return view('pay',$package);
        // return view('pay',$package);
    }
    
    public function payment(Request $request)
    {   
        $response['status_code']='0';
        $user_id = $request->session()->get('user')->user_id;
        $account = \App\Models\Subscription::where('user_id',$user_id)->where('status',1)->orderBy('id','desc')->first();
        \Stripe\Stripe::setApiKey("sk_live_cYrAR2mpeB8C0JKqGR2TxlGi");
        $customer_id =null;
        if($account){
            Log::info("Subscription found for user id: ".$user_id);
            //$subscription = \App\Models\AccountInfo::where('user_id',$user_id)->first();
            $customer_id = $account->customer_id;
            if(isset($request->plan)&& $request->plan > 0)
            {
                $sub = \App\Models\Subscription::where('user_id',$user_id)->where('status',1)->orderBy('id','desc')->first();
                Log::info("Subscription for user id: ".$user_id. ", Sub:".$sub->stripe_sub_id);
                if($request->plan=='1')
                    $validUntil = strtotime('+1 year', time()); // need to resolve
                else if($request->plan =='3')
                    $validUntil = strtotime('+5 days', time()); //need to resolve
                if($sub){
                    try{
                        $stripe_sub = \Stripe\Subscription::retrieve($sub->stripe_sub_id);
                        $stripe_sub->plan = $request->plan;
                        $stripe_sub->save();
                        $sub->plan=$request->plan;
                        $sub->active_until = $validUntil;
                        $sub->save();
                    }
                    catch(\Exception $e){
                        Log::info("Error for subscription user id: ".$user_id. ", Sub:".$sub->stripe_sub_id.", Error:".$e->getMessage());
                        $sub->status = 0;
                        $sub->save();
                        Log::info("Create new subscription user id: ".$user_id);
                        if($request->plan=='3')
                        {
                            $amount = 495;
                            $charge = \Stripe\Charge::create(['customer' => $customer_id,
                                        'amount' => $amount,
                                        'currency' => 'usd']);
                            
                            if(!$charge->paid)
                            {
                                try{
                                Log::info("Charge plan monthly Error user id: ".$user_id. ", Charge:".json_decode($charge));
                                }
                                catch(\Exception $e){}
                                $response['status_code']='1';
                                $response['message'] = 'Unable to charge your card. Please contact administrator';
                            }
                            else
                            {
                                $stripe_sub = \Stripe\Subscription::create(['customer'=>$customer_id,'plan'=>$request->plan]);
                                $subscription = ['customer_id'=>$customer_id,
                                        'user_id'=>$user_id,
                                        'plan'=>$request->plan,
                                        'status'=>1,
                                        'active_until'=>$validUntil,
                                        'stripe_sub_id'=>$stripe_sub->id];
                                \App\Models\Subscription::create($subscription);
                                $response['message'] = 'Successfully subscribed to Monthly Plan';
                                try{
                                Log::info("Charge plan monthly user id: ".$user_id. ", Charge:".json_decode($stripe_sub));
                                }
                                catch(\Exception $e){}
                            }

                        }
                        else{
                                $stripe_sub = \Stripe\Subscription::create(['customer'=>$customer_id,'plan'=>$request->plan]);  
                                $subscription = ['customer_id'=>$customer_id,
                                                'user_id'=>$user_id,
                                                'plan'=>$request->plan,
                                                'status'=>1,
                                                'active_until'=>$validUntil,
                                                'stripe_sub_id'=>$stripe_sub->id];
                                \App\Models\Subscription::create($subscription);
                                try{
                                Log::info("Charge plan monthly user id: ".$user_id. ", Charge:".json_decode($stripe_sub));
                                }
                                catch(\Exception $e){}
                                $response['message'] = 'Successfully subscribed to yearly plan';
                        }
                        
                        
                        
                    }
                    $response['message'] = 'Successfully changed your subscription';
                }
                else
                {
                    
                    if($request->plan=='3')
                    {
                        $amount = 495;
                        $charge = \Stripe\Charge::create(['customer' => $customer_id,
                                    'amount' => $amount,
                                    'currency' => 'usd']);
                        if(!$charge->paid)
                        {
                            $response['status_code']='1';
                            $response['message'] = 'Unable to charge your card. Please contact administrator';
                        }
                        else
                        {
                            $stripe_sub = \Stripe\Subscription::create(['customer'=>$customer_id,'plan'=>$request->plan]);
                            $subscription = ['customer_id'=>$customer_id,
                                    'user_id'=>$user_id,
                                    'plan'=>$request->plan,
                                    'status'=>1,
                                    'active_until'=>$validUntil,
                                    'stripe_sub_id'=>$stripe_sub->id];
                            \App\Models\Subscription::create($subscription);
                            $response['message'] = 'Successfully subscribed to Monthly Plan';
                        }
                        
                    }
                    else{
                            $stripe_sub = \Stripe\Subscription::create(['customer'=>$customer_id,'plan'=>$request->plan]);  
                            $subscription = ['customer_id'=>$customer_id,
                                            'user_id'=>$user_id,
                                            'plan'=>$request->plan,
                                            'status'=>1,
                                            'active_until'=>$validUntil,
                                            'stripe_sub_id'=>$stripe_sub->id];
                            \App\Models\Subscription::create($subscription);
                            $response['message'] = 'Successfully subscribed to yearly plan';
                    }
                }
            }
            else
            {
                $response['status_code']='1';
                $response['message'] = 'Please select a valid plan';
            }
        }
        else
        {
            $token = $request->stripeToken;
            $plan = $request->plan;
            
            try{
                $customer = \Stripe\Customer::create(array(
                "source" => $token,          
                "email" => $request->email)
                );
                Log::info("Create customer user id: ".$user_id. ", Customer:".json_decode($customer));
            }
            catch(\Exception $e){
                $response['status_code']='1';
                $response['message'] = 'Invalid card details. Please verify your card number and cvv';
                return $response;
            }
            if(isset($customer->id))
            {
                $customer_id = $customer->id;
                $customer_created = $customer->created;
                $validUntil = strtotime('+1 year', time());

                if($plan>0){
                    if($request->plan=='3')
                    {
                        $validUntil = strtotime('+5 days', time());
                        //echo "PLan 3 new customer: ".$validUntil; exit;
                        $amount = 495;
                        $charge = \Stripe\Charge::create(['customer' => $customer_id,
                                    'amount' => $amount,
                                    'currency' => 'usd']);
                        if(!$charge->paid)
                        {
                            $response['status_code']='1';
                            $response['message'] = 'Unable to charge your card. Please contact administrator';
                            try{
                                Log::info("Charge plan monthly Error user id: ".$user_id. ", Charge:".json_decode($charge));
                            }
                            catch(\Exception $e){}
                        }
                        else
                        {
                            $stripe_sub = \Stripe\Subscription::create(['customer'=>$customer_id,'plan'=>$request->plan]);
                            $subscription = ['customer_id'=>$customer_id,
                                    'user_id'=>$user_id,
                                    'plan'=>$request->plan,
                                    'status'=>1,
                                    'active_until'=>$validUntil,
                                    'stripe_sub_id'=>$stripe_sub->id];
                            //print_r($subscription)
                            \App\Models\Subscription::create($subscription);
                            \App\Models\AccountInfo::create(['user_id'=>$user_id,'customer_id'=>$customer_id,'card_number'=>$customer->sources->data[0]->last4]);
                            $response['message'] = 'Successfully subscribed to monthly plan';
                            try{
                                Log::info("Charge plan monthly Error user id: ".$user_id. ", Charge:".json_decode($stripe_sub));
                            }
                            catch(\Exception $e){}
                        }
                    }
                    else{
                        $stripe_sub = \Stripe\Subscription::create(['customer'=>$customer_id,'plan'=>$request->plan]);
                        $subscription = ['customer_id'=>$customer_id,
                                    'user_id'=>$user_id,
                                    'plan'=>$request->plan,
                                    'status'=>1,
                                    'active_until'=>$validUntil,
                                    'stripe_sub_id'=>$stripe_sub->id];
                        \App\Models\Subscription::create($subscription);
                        \App\Models\AccountInfo::create(['user_id'=>$user_id,'customer_id'=>$customer_id,'card_number'=>$customer->sources->data[0]->last4]);
                        $response['message'] = 'Successfully subscribed to yearly plan';
                        try{
                                Log::info("Charge plan monthly Error user id: ".$user_id. ", Charge:".json_decode($stripe_sub));
                            }
                            catch(\Exception $e){}
                    }
                }
                else {
                    $response['status_code']='1';
                    $response['message'] = 'Please select a valid plan';
                }
            }
            else
            {
                $response['status_code']='1';
                $response['message'] = 'Unable to create customer account with given credintials, Please check your card details';
            }
            
            
        }
        
        $user = $request->session()->get('user');
        $subscription = \App\Models\Subscription::where('user_id',$user->user_id)->where('status',1)->orderBy('id','desc')->first();
                    $sub_obj = [];
                    
                    $sub_obj['subscribed'] = 0;
                    $sub_obj['plan'] = 0;
                    $sub_obj['failed']=0;
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
      return $response; 
    }


    public function viewCheckout(Request $request) {
        
        $planType = $request->input('planType','-1');
        if($planType=='-1')
            return redirect('/plans');
       $cost = '0.00';
        switch($planType)
        {
            case '0': $cost= "0.00";break;
            case '1': $cost= "99.00";break;
            case '3': $cost="4.95";break;
            default : $cost="0.00";
              
        }
        
        return view('checkout')->with('plan',$planType)->with('cost',$cost);
    }
    
    
    public function webhook(Request $request)
    {
        $input = @file_get_contents("php://input");
        $oEvent = json_decode($input);
        if(!$oEvent) return ['success'=>'false'];
        

    //To Update Next Subscription Renewal date
        if($oEvent->type == "customer.subscription.updated"){
            $webhook= new \App\Models\WebHook();
            $webhook->event_id = $oEvent->id;
            $webhook->event_type = $oEvent->type;
            $webhook->event_date=$oEvent->created;
            $webhook->cus_id = @$oEvent->data->object->customer;
            $webhook->sub_id =@$oEvent->data->object->id;
            $webhook->save();
            $oSubscription = $oEvent->data->object;
            $sSubscriptionId = $oSubscription->id;
            $subscription = \App\Models\Subscription::where('stripe_sub_id',$sSubscriptionId)->first();
            if($subscription)
            {
                if($oSubscription->canceled_at != null){
                    $subscription->status = 0;
                }
                $subscription->active_until = $oSubscription->current_period_end;
                $aActiveUntil = date("Y-m-d", $oSubscription->current_period_end);
                $subscription->save();
            }
		
        }

        if($oEvent->type == "customer.subscription.deleted"){
            $webhook= new \App\Models\WebHook();
            $webhook->event_id = $oEvent->id;
            $webhook->event_type = $oEvent->type;
            $webhook->event_date=$oEvent->created;
            $webhook->cus_id = @$oEvent->data->object->customer;
            $webhook->sub_id =@$oEvent->data->object->id;
            $webhook->save();
            $oSubscription = $oEvent->data->object;
            $sSubscriptionId = $oSubscription->id;
            $subscription = \App\Models\Subscription::where('stripe_sub_id',$sSubscriptionId)->first();
            if($subscription)
            {
                $subscription->status = 0;
                $subscription->save();
            }
        }
        return ['success'=>'true'];
    }
}