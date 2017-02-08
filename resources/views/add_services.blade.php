@extends('app')
@section('title','The Resume Builder - Additional Services')
@section('style')

<link href="{{url('/') . '/'}}dist/css/style.css" rel="stylesheet" type="text/css">
<link href="{{url('/') . '/'}}dist/css/res.css" rel="stylesheet" type="text/css">
<style>

.full-width {
  width: 100%;
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


<div class="bluebackground">
  <div class="container">
    <div class="centerMainHeader">Additional Services</div>
    <div class="centerSubHeader">More on Resume Builder</div>


    <div class="row">
      <!--Resume Writing-->
      <div class="col-md-3 col-sm-6">
        <label for="service_1" class="full-width">
        <div class="manageBox">
          <img src="{{url('/dist/')}}/img/write.png" />

          <div class="boldHeader">Resume Writing</div>
          <div class="para2">Pre written phraseswritten by HR experts which you place within your resume</div>
          <div class="cash">
            <span>$ 35</span>
          </div>
        </div>
        </label>
      </div><!--End Resume Writing-->
      
      <!--Interview Coaching-->
      <div class="col-md-3 col-sm-6">
        <label for="service_2" class="full-width">
        <div class="manageBox">
          <img src="{{url('/dist/')}}/img/interview.png" />

          <div class="boldHeader">Interview Coaching</div>
          <div class="para2">Pre written phraseswritten by HR experts which you place within your resume</div>
          <div class="cash">
            <span>$ 35</span>
          </div>
        </div>
        </label>
      </div><!--End Interview Coaching-->
      
      <!--Resume Review-->
      <div class="col-md-3 col-sm-6">
        <label for="service_3" class="full-width">
        <div class="manageBox">
          <img src="{{url('/dist/')}}/img/review.png" />

          <div class="boldHeader">Resume Review</div>
          <div class="para2">Pre written phraseswritten by HR experts which you place within your resume</div>
          <div class="cash">
            <span>$ 35</span>
          </div>
        </div>
        </label>
      </div><!--End Resume Review-->
      
      <!--Career Coaching-->
      <div class="col-md-3 col-sm-6">
        <label for="service_4" class="full-width">
        <div class="manageBox">
          <img src="{{url('/dist/')}}/img/carear.png" />

          <div class="boldHeader">Career Coaching</div>
          <div class="para2">Pre written phraseswritten by HR experts which you place within your resume</div>
          <div class="cash">
            <span>$ 35</span>
          </div>
        </div>
        </label>
      </div><!--End Career Coaching-->
      
    </div>

  </div>
</div>


<form action="{{url('plans')}}" method="post">
<div class="service-inputs hidden">

<input type="checkbox" name="services" value="1" id="service_1"/>
<input type="checkbox" name="services" value="2" id="service_2"/>
<input type="checkbox" name="services" value="3" id="service_3"/>
<input type="checkbox" name="services" value="4" id="service_4"/>
</div>

<div class="container">
  <div class="right">
    <button class="grayebtn">BACK</button>
    <button class="blueBtn">CONTINUE</button>
  </div>

</div>

</form>









</div>
@include('includes/rb_footer')        
@endsection

@section('script')
<script>
$(function(){
  $('.manageBox').on('click', function(){
    $(this).toggleClass('active');
  });

});

</script>

@endsection