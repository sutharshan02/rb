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


        <div class="container">
            <div class="centerMainHeader">About Resume Builder</div>
            <div class="centerSubHeader"><b>A Brief History of Us,</b> Who We Are and What We Do for You</div>
            
            
            <!--Start Paragraph-->
            <div class="para">
                <div class="paraHeader">About TRB</div>
                <p>The Resume Builder was founded out of a need for faster and more efficient online tools. We developed our process in response to the demand from our clients. Our resume templates were designed by leading HR professionals. You can access tips, information, and articles written to address the questions we all face when writing a resume. We have hints and job descriptions to make the process easier and faster. We listen to our clients and provide them first rate customer service and resume building tools to create interview landing resumes!</p>
            </div><!--End Start Paragraph-->
            
            <!--Start Paragraph-->
            <div class="para">
                <div class="paraHeader">History</div>
                <p>We started with an online resume builder in 2005. Our clients preferred a resume builder online instead of downloading software to their computer. It was a simple tool that allowed clients to print and not much more. Later we added the ability to download and email and save several versions. Most recently we created tools that practically write your resume for you. We strive to stand out from other online resume builders. Since 2005 we have created over a million online resumes for our clients.</p>
            </div><!--End Start Paragraph-->
            
            <!--Start Paragraph-->
            <div class="para">
                <div class="paraHeader">What We Do</div>
                <p>Our resume maker allows you to instantly create a professional, easy to edit resume in minutes using our self guided resume wizard. Choose from one of our resume templates, enter your information, and your resume is ready in seconds. No complicated software to download or learn. You can edit your resume even easier and keep it up to date and ready to send off to employers at a moments notice. You can create several resume versions for your job search and save them in your account online.</p>
            </div><!--End Start Paragraph-->
            
        </div>












</div>
@include('includes/rb_footer')        
@endsection

@section('script')

@endsection