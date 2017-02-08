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

    @if (Session::has('reset_msg'))
        <div class="alert-danger">
            {{Session::get('reset_msg')}}
        </div>
    @endif

            <div class="container">


            <div class="row">
                <!--New User create section-->
            <form role="form" action="{{url('password/new')}}" method="POST" id="frm_01">
                <div class="col-md-4 col-md-offset-4">
                    <input type="hidden" value="{{$id}}" name="user_id"/>
                    <br /><br />
                    <div class="resetBox">
                        <img src="{{url('/dist/img/addP.png')}}" />
                        <h2 class="black fo-w-normal">Enter Your Password</h2>
                        <br />
                        <div class="control-group">
                          <div class="inlineForm controls">
                              <input id="password" name="password_new" type="password" placeholder="Your new password" 
                                  data-validation-required-message="Please enter the new password"/>
                          </div>
                        </div>

                        <div class="control-group">
                          <div class="inlineForm controls">
                              <input type="password" id="password" name="password_confirm" placeholder="Confirm your new password"  
                               data-validation-required-message="You have to re-enter the new password to confirm"
                               data-validation-match-match="password_new" 
                             data-validation-match-message="Passwords does not match"/>
                          </div>
                        </div>
                        <button type="submit" class="blueSubmit centerBtn " >SUBMIT</button>
                    </div>
                    <div class="clearfix"></div>

                </div>
            </form>
                <!--End New User create section-->
            </div>


        </div>







</div>
@include('includes/rb_footer')        
@endsection

@section('script')

<script type="text/javascript" src="{{url('/')}}/dist/js/jqBootstrapValidation.js"></script>
<script>
  $(function () {

   $("input").jqBootstrapValidation();

    } );
</script>

@endsection