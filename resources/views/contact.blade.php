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



@if (Session::has('sent'))
<!--alert box-->
<div class="alert_confirm open"><!--remove 'open' class to display none.-->
  <span class="closeBtn "></span>
  <img src="{{url('/dist')}}/img/sucsess.png" />
  <h2 class="black">Thank you!</h2>
  <p>Your message has been sent</p>

</div><!--End alert box-->

@endif

<div class="container">
  <div class="row">
    <div class="col-md-12">

      <div class="centerMainHeader">Contact Us</div>
      <div class="centerSubHeader">
        Have a question or feedback? Please contact us using the form below.
      </div>
      <br /><br />

      <!--Start contact form-->
      <form action="{{url('/contact')}}" method="post">
        <div class="row control-group">
          <div class="col-sm-6 ">
            <div class="inlineForm controls">
              <label>Name *</label>
              <input type="text" name="name" placeholder="Enter your name here" 
              data-validation-required-message="Name is required"/>
              <label>Message *</label>
              <textarea name="message" placeholder="Enter your message" data-validation-required-message="Please enter your message"/></textarea>
            </div>
          </div>
          <div class="col-sm-6 ">
            <div class="inlineForm controls">
              <label>Email *</label>
              <input type="email" name="email" placeholder="Enter your email address here"  
               data-validation-email-message="Email address is invalid"
              data-validation-required-message="Email address is required"/>

            </div>
          </div>
          <div class="col-xs-12">
          <div class="help-block"></div>
        </div>
        </div>
      
        <hr />
        <button type="submit" class="blueSubmit" >SUBMIT</button>
      </form>
      <!--End contact form-->


      <div class="clearfix"></div>

    </div>
  </div>
</div>

<!--Social media section-->
<div class="socialMainBox">
  <div class="socialHead">Follow the Resume Builder On</div>
  <div class="socialBox">
    <a href="" class="tw"></a>
    <a href="" class="fb"></a>
    <a href="" class="in"></a>
  </div>
</div><!--End Social media section-->









</div>
<!-- end full page wrap -->


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


$(function(){
   $('input, textarea').jqBootstrapValidation();
})
</script>



@endsection