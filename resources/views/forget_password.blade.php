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


    @if (Session::has('forget_msg'))
        <div class="alert-success">
            {{Session::get('forget_msg')}}
        </div>
    @endif
   


        <div class="container">


            <div class="row">
                <!--New User create section-->
            <form id="forgetForm" role="form" method="post" class="form-horizontal" action="{{url('password/reset')}}" >

                <div class="col-md-4 col-md-offset-4">
                    <br /><br />
                    <div class="resetBox control-group">
                        <img src="{{url('/dist/img/resetP.png')}}" />
                        <h2 class="black  fo-w-normal">Reset Your Password</h2>
                        <br />
                        <div class="inlineForm controls">
                            <input type="email" id="email" name="email" placeholder="Your email address"
                              data-validation-required-message="Please enter the email address"/>
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