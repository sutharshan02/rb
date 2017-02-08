@extends('app')
@section('title','The Resume Builder')
@section('style')

<link href="{{url('/') . '/'}}dist/css/style.css" rel="stylesheet" type="text/css">
<link href="{{url('/') . '/'}}dist/css/res.css" rel="stylesheet" type="text/css">

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



    @if(isset($data['verified']))
      @if($data['verified'] == true)
    <!--alert box-->
      <div class="alert_confirm open"><!--remove 'open' class to display none.-->
       <span class="closeBtn "></span>
       <img src="{{url('/dist/')}}/img/sucsess.png" />
       <h2 class="black">Congratulations!</h2>
       <p>Your account has been verified</p>

     </div><!--End alert box-->

    @elseif($data['verified'] == false)

    <!--alert box-->
      <div class="alert_confirm open"><!--remove 'open' class to display none.-->
       <span class="closeBtn "></span>
       <img src="{{url('/dist/')}}/img/sucsess.png" />
       <h2 class="black"></h2>
       <p>Already Verified!</p>

     </div><!--End alert box-->



    @endif
@endif


 <div class="row">
  <!--New User create section-->
  <form role="form" action="{{url('register')}}" method="POST" id="frm_01">

    <div class="col-md-7">

      <div class="MainHeader topMa">New User</div>
      <div class="SubHeader">
        Register now and create your resume
      </div>

      <div class="row ">
        <div class="col-xs-12 ">
          <div class="row">

           <div class="col-sm-6 control-group">
            <div class="inlineForm controls">
              <label>Email *</label>
              <input type="email" placeholder="Enter email here"   id="email" name="email"
               data-validation-required-message="Please enter the email address"/>
            </div>
          </div>

          <div class="col-sm-6 control-group">
            <div class="inlineForm controls">
              <label>Username *</label>
              <input type="text" placeholder="Enter username here"  id="username" name="username"  

               data-validation-required-message="Please enter the user name"/>
            </div>
          </div>

        </div>

        <div class="row control-group">

          <div class="col-sm-6 control-group">
            <div class="inlineForm controls">
              <label>Password *</label>
              <input type="password" placeholder="**********" id="password" name="password"
               data-validation-required-message="Please enter the password"/>
            </div>
          </div>


          <div class="col-sm-6 control-group">
            <div class="inlineForm controls">
              <label>Confirm Password *</label>
              <input type="password" placeholder="**********" 
              id="confirm_password" 
              name="confirm_password"  
            data-validation-match-match="password" 
             data-validation-required-message="Please enter the confirm password"
              />

            </div>
          </div>
          <div class="help-block"></div>

        </div>
      </div>

    </div>

      <button type="submit" class="blueSubmit" >REGISTER</button>
      <div class="clearfix"></div>

    </div>
  </form>
  <!--End New User create section-->

  <!--Registered user login-->
  <form role="form" action="{{url('resume/home')}}" method="POST" id="frm_02">

    <div class="col-md-4 col-md-offset-1 control-group">
      <div class="regiterdBox">
        <img src="{{url('/') . '/'}}dist/img/lock.png" />
        <div class="centerMainHeader">Already Registered</div>
        <div class="centerSubHeader">Sign up here to update your resume</div>
        <br /><br />
        <div class="inlineForm controls">
          <label>Email *</label>


          <input type="email" id="email" name="email"
          data-validation-required-message="Please enter the email address"
          placeholder="Enter email here"  />

          <label>Password *</label>
          <input type="password" id="password" name="password" placeholder="**********" 
          data-validation-required-message="Please enter the password"
          />
        </div>

        <button type="submit" class="blueSubmit centerBtn " >LOGIN</button>
        <a href="{{url('password/reset/view')}}" class="forgotPW">Forgot Password?</a>
        <div class="clearfix"></div>
      </div>
    </div>
  </form>
  <!--End Registered user login-->
</div>


</div>
</div>
@include('includes/rb_footer') 

@endsection

@section('script')
<script type="text/javascript" src="{{url('/')}}/dist/js/jqBootstrapValidation.js"></script>

<script>
$(document).ready(function () {
  $(".closeBtn").click(function () {
    $(this).parent(".alert_confirm").removeClass("open");
  });
});
</script>

<script>
  $(function () {

   $("input").jqBootstrapValidation();

    } );
</script>

@endsection
