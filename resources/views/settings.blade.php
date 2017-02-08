@extends('app')
@section('title','The Resume Builder - Change Password')
@section('style')
<link href="{{url('/') . '/'}}dist/css/style.css" rel="stylesheet" type="text/css">
<link href="{{url('/') . '/'}}dist/css/res.css" rel="stylesheet" type="text/css">

<style>
li.plan-info {
  padding-left: 5px;
}
  ul.plan-info-holder , ul.plan-info-holder li{
    list-style-type: disc !important;
    padding-left: 15px;
  }
li.plan-info-danger {
  color: red;
}

li.plan-info-warning {
  color: orange;
}



</style>
@endsection
@section('content')
<div class="full_page_wrap">

<?php if(Session::has('user')) { ?>
  @include('includes/rb_user_logged_header')
  <?php }else{?>   
  @include('includes/rb_header')
  <?php }?>

  <?php if(isset(Session::get('user')->user_id)): ?>
  <script>
  app.run(function($sessionStorage){

   $sessionStorage.user_id = <?php echo Session::get('user')->user_id ?>;
 });
  </script>
<?php endif; ?>




@if($res['status_code']=='1')
<div class="alert alert-danger">
  <?php echo($res['message']) ?>
</div>
@elseif($res['status_code']=='0')
<div class="alert alert-success">
  <?php echo($res['message']) ?>
</div>
@endif



<div class="container">
  <div class="col-sm-8 col-sm-offset-2">
    <div class="MainHeader">Profile Settings</div>
    <div class="row">
      <!--Profile Settings-->


        <div class="col-md-6">
      <form role="form" action="{{url('settings/update')}}" method="POST" id="frm_01">
        <input type="hidden" value="{{$user_id}}" name="id" /> 
          <div class="SubHeader">
            Create New Password
          </div>

          <div class="inlineForm formProfile">
            <div class="control-group">
              <div class="controls">
                <label>Current Password *</label>
                <input id="current_password" name="current_password" type="password" placeholder="**********"  
                data-validation-required-message="Please enter the existing password"/>

              </div>
            </div>
            <div class="control-group">
              <div class="controls">
                <label>New Password * *</label>
                <input id="new_password" name="new_password" type="password" placeholder="**********" 
                data-validation-required-message="Please enter the new password"/>
              </div>
            </div>
            <div class="control-group">
              <div class="controls">
                <label>Confirm New Password *</label>
                <input id="confirm_password" name="confirm_password" type="password" placeholder="**********"
                data-validation-required-message="You have to re-enter the new password to confirm"
                data-validation-match-match="new_password" 
                data-validation-match-message="Passwords does not match"/>
              </div>
            <div class="help-block"></div>
            </div>

            <button type="submit" class="blueSubmit" >CREATE</button>
            <div class="clearfix"></div>
          </div>
      </form>
        </div>
      <!--End Profile Settings-->

      <!--Your Subscription-->
      <div class="col-md-6">
        <div class="substcriptionBox">
          <div class="MainHeaderNoBold">Your Subscription</div>
          <div class="plane1"><b>Plan : </b>
              @if($plan=='0')
              Free Plan
              @elseif($plan=='1')
              Yearly Plan
              @elseif($plan=='3')
              Monthly Plan
              @endif
          </div>
          <div>
            <ul class="plan-info-holder">
                @if($subscription['failed']=='1')
              <li class="plan-info plan-info-danger">
                Your Plan Has been Canceled due non payment. 
                          Now you are in Free Plan Please upgrade your plan for a
                          Monthly or Annual Plan.

              </li>
              @endif
              
              @if($subscription['subscribed']=='1')
                <li class="plan-info">
                Next Bill Date : {{$subscription['next_bill_date']}}

              </li>
              <li class="plan-info">
                Next Bill Amount : {{$subscription['next_bill_amount']}}

              </li>
              @endif

            </ul>
          
          </div>
           @if($plan!='1') <a href="{{url('plans')}}" class="upgeadBtn">UPGRADE</a>@endif
          <div class="msgAdmin">* If you want to cancel, Please Contact Administrator</div>
        </div>
      </div><!--End Your Subscription-->
    </div>
  </div>

         <div class="clearfix"></div>
            <hr />

<!-- start credit card settings -->

<!-- card display holder -->
<!--
<div id="card-display" style="display: none;"></div>

 <form id="credit-card-form" action="#" method="get" id="checkout-form" class="row">
              <div class="col-sm-8 col-sm-offset-2">
                <div class="row">


                    <div class="">
                        <div class="cardboxHeader">
                            Credit Card Information
                            <div class="">
                                
                                
                                <div class="InVisa">
                                    <input id="radio1" type="radio" name="radio" value="1"><label for="radio1"></label>
                                </div>
                                <div class="InMaster">
                                 <input id="radio2" type="radio" name="radio" value="1" ><label for="radio1"></label>
                                </div>
                                <input type="radio" name="card" />
                                <input type="radio" name="card" />
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <div class="col-xs-12">
                          <div class="row">
                            <div class="col-sm-6 control-group">
                                <div class="inlineForm controls">
                                    <label>Card Number</label>
                                    <input id='number' type="text" placeholder="0000-0000-0000-0000" 
                                            data-validation-required-message="credit card number is required"
                                            data-validation-regex-regex="[0-9].{17}[0-9]" 
                                             data-validation-regex-message="Credit Card number must have 16 degits" 
                                            />
                                </div>
                            </div>
                            <div class="col-sm-6 control-group">
                                <div class="inlineForm controls">
                                    <label>Name of card</label>
                                      <input id="email" type="name" placeholder="Name of card"  
                                             data-validation-required-message="name is required"
                                            />                            </div>
                            </div>

                          </div>
                        </div>

                        <div class="col-xs-12">
                          <div class="row">
                            <div class="col-sm-6 control-group">
                                <div class="inlineForm controls">
                                    <label>MM/YY</label>
                                     <input id="expiry" type="text" placeholder="Expire date"  
                                            data-validation-required-message="Expiry date is required"
                                            />
                                </div>
                            </div>
                            <div class="col-sm-6 control-group">
                                <div class="inlineForm controls">
                                    <label>CVV</label>
                                    <input id="cvc" type="text" placeholder="CVV" 
                                            data-validation-required-message="CVV number is required" />                            </div>
                            </div>

                          </div>
                        </div>
                        
                    </div>
                    <div class="col-sm-12">
                        <button type="submit" class="blueSubmit" style="float:left;">CREATE</button>
                    </div>
                </div>
            </div>
</form>
-->
<!-- end credit card settings -->

</div>




</div>  <!-- end full page wrap -->

@include('includes/rb_footer')   
@endsection

@section('script')


<script type="text/javascript" src="{{url('/')}}/dist/js/jqBootstrapValidation.js"></script>
<!-- <script type="text/javascript" src="{{url('/')}}/dist/js/jquery.card.js"></script> -->
<script>



$(function(){

// frm_01
 // $("form#credit-card-form").find('input').jqBootstrapValidation();
 // $("form#frm_01").find('input').jqBootstrapValidation();
 $('input').jqBootstrapValidation();

});
 // $("#credit-card-form input").jqBootstrapValidation();


/**
***   UNCOMMENT BELOW WHEN USING CREDIT CARD SECTION
***
***
*****************************************************/ 

/*
    var card = new Card({
        form: 'form#credit-card-form',
        container: 'div#card-display',
        formSelectors: {
            numberInput: 'input#number',
            expiryInput: 'input#expiry',
            cvcInput: 'input#cvc',
            nameInput: 'input#email'
        },
        width: 200,
        formatting: true,
        placeholders: {
            number: '**** **** **** ****',
            expiry: 'MM/YY',
            cvc: '***'
        },
        debug: true

    })
});
/**/

</script>


@endsection
