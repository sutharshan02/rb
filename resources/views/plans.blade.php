@extends('app')
@section('title','The Resume Builder')
@section('style')

<style>
.signup-plans-wrapper .signup-plan-row .signup-plan-box.active {
  border: 2px dashed #ff7200;
}
.signup-plans-wrapper .signup-plan-row .signup-plan-box.active:hover {
  border: 2px solid #ff7200;
}

.full-width {
  width: 100%;
}

button#continue-btn:disabled {
    background: #84bbff;
}

.selected_plan{
    osition: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    z-index: 0;
    background-color: #000000;
    opacity: 0.3;
    border-radius: 4px;
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
 
<form name="plansForm" id="plansForm" action="{{url('checkout/')}}" method="post">

    <section class="signup-plans-wrapper">
    <div class="container">
      <div class="row">
        <h1>Choose a Plan</h1>
        <p>Choose from our 5 Days, and Yearly plans for Downloading Created Resume</p>
      </div>
      <div class="row signup-plan-row">
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
          <label class="full-width" for="plan_0">
            <div class="row row_clr signup-plan-box @if($plans=='0')selected_plan @endif"  plan-id="0">
              <div class="top">
                <h3>Free Plan</h3>
              </div>
              <div class="mid">
                <div class="col-xs-12">
                  <h3>Free</h3>
                </div>
              </div>
              <div class="bottom">
                <img src="assets/images/signup-plans-5.png" alt="" class="img-responsive border-img">
                <h3><span>Start building</span>your <br>resume now!</h3>
                <img src="assets/images/signup-plans-5.png" alt="" class="img-responsive border-img">
              </div>
            </div>

          </label>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
          <label class="full-width" for="plan_1" >
            <div class="row row_clr signup-plan-box @if($plans=='3')selected_plan @endif"  plan-id="3">
              <div class="top">
                <h3>5 Day Access</h3>
              </div>
              <div class="mid">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                  <div class="row">
                    <h4><span>$</span>4.95</h4>
                  </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                  <h5>FOR<br>5 DAYS</h5>
                </div>
              </div>
              <div class="bottom">
                <h6>Renews at $14.95/month on the 6th day</h6>
                <img src="assets/images/signup-plans-5.png" alt="" class="img-responsive border-img">
                <ul>
                  <li>Resume<span> Tracking</span></li>
                  <li><span>Download </span>PDF</li>
                  <li><span>Printable </span>Resume</li>
                </ul>
                <img src="assets/images/signup-plans-5.png" alt="" class="img-responsive border-img">
              </div>
            </div>
          </label>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
          <label class="full-width" for="plan_2" >
            <div class="row row_clr signup-plan-box @if($plans=='1')selected_plan @endif"  plan-id="1">
              <div class="top">
                <h3>Yearly Plan</h3>
              </div>
              <div class="mid">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                  <div class="row">
                    <h4><span>$</span>99</h4>
                  </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                  <h5>PER<br>YEAR</h5>
                </div>
              </div>
              <div class="bottom">
                <h6>Equal to $8.25 Per month</h6>
                <img src="assets/images/signup-plans-5.png" alt="" class="img-responsive border-img">
                <ul>
                  <li>Resume<span> Tracking</span></li>
                  <li><span>Download </span>PDF</li>
                  <li><span>Printable </span>Resume</li>
                  <li><span>No </span>monthly billing</li>
                  <li><span>Cancel </span>anytime</li>
                </ul>
                <img src="assets/images/signup-plans-5.png" alt="" class="img-responsive border-img">
              </div>
            </div>
          </label>
        </div>
      </div>
    </div>
  </section>


  <!-- input section -->
  <section class="hidden">

    <input class='planRadio' id="plan_0" type="radio" name="planType" value="0">
    <input class='planRadio' id="plan_1" type="radio" name="planType" value="3">
    <input class='planRadio' id="plan_2" type="radio" name="planType" value="1">


  </section>


  <!-- signup-plans-wrapper -->
  <section class="bottom-section">
    <div class="container">
      <div class="row">
        <div class ="col-xs-12 col-sm-6 col-md-4 col-lg-4 pull-right">
          <div class ="row">
            <div class ="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                <a class="back-button" href="#" onclick="window.history.back();return false;">Back</a>   
            </div>
            <div class ="col-xs-12 col-sm-7 col-md-7 col-lg-7">
              <div class ="row">
                <button id="continue-btn" style="border: none" class="next-button full-width">Continue</button>  
   
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>



</form>






</div>


@include('includes/rb_footer')        
@endsection

@section('script')

<script>
//.signup-plans-wrapper .signup-plan-row .signup-plan-box.active
var selected_plan = '{{$plans}}';
$(function(){
  
    ifSelected();

    $('.planRadio').change(function(){
      ifSelected();
    })

});


function ifSelected(){
      if($('input:radio:checked').length > 0){
    // go on with script
    $('#continue-btn').removeAttr('disabled', 'disabled');
        $("#plansForm").submit();
     }else{
    $('#continue-btn').attr('disabled', 'disabled');
        // NOTHING IS CHECKED
   
     }
}

$(function(){

  $('.signup-plan-box').on('click', function(){
    if($(this).attr('plan-id')!=selected_plan){
        $('.signup-plan-row').find('.signup-plan-box').removeClass('active');
        $(this).addClass('active');
        
    }
  });
});
</script>

@endsection