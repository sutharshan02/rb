@extends('app')
@section('title','The Resume Builder')
@section('style')

  <link href="{{url('/') . '/'}}dist/css/style.css" rel="stylesheet" type="text/css">
  <link href="{{url('/') . '/'}}dist/css/res.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
  <style>

  /*// card validation*/
p.error-text {
    color: red;
    margin-bottom: 15px;
    font-size: 11px;
}

/* remove comment to hide the new card section */
/*
.new-card {display: none;}
/**/


/* comment below to view the existing card section */
.existing-card {display: none;}
/**/

input[type='text'] {
    background: #fff;
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
  <div class="loading-spinner" id="loading" style="display:none;">
  <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
  <span class="sr-only">Loading...</span>
</div>

  <div id="err_msg" class="alert alert-danger"  style="display:none;">
  
</div>

  <div id="success_msg" class="alert alert-success" style="display:none;">
  
</div>

        <div class="container">


            <div class="row">
                <!--New User create section-->
                <div class="col-md-7">

                    <div class="row" id="card-display" style="display: none;">

                    </div>
                    <form action="{{url("/payment")}}" method="post" id="checkout-form" class="row">

                    <div class="MainHeader topMa">Checkout</div>
                    <div class="SubHeader">
                        Payment Method
                    </div>

                    <div class="row">

                        <div class="col-sm-12 control-group">
                            <div class="cardBox">
                                <div class="cardboxHeader">
                                    Credit Card
                                    <div class="Fright">
                                        <span class="visa"></span>
                                        <span class="master"></span>
                                    </div>
                                </div>
                                <br />

                                <div class="col-sm-12">
                                    <div class="inlineForm controls">
                                        <label>Card Number re</label>
                                        <input id='number' type="text" class="hidden" placeholder=""/>
                                        <input id='numberPreview' type="text" placeholder="0000-0000-0000-0000" />


                                        <!-- below input is only there to get card.js works -->
                                        <input class="hidden" id='numberDisplay' type="text" placeholder="0000-0000-0000-0000" 
                                        data-validation-required-message="credit card number is required"
                                        />

                                    </div>
                                </div>
                                <div class="col-xs-12">

                                    <div class="row">
                                    <div class="col-sm-6 ">
                                    <div class="inlineForm controls">
                                        <label>Email *</label>
                                        <input id="email" name="email" type="text" placeholder="Email address"  
                                         data-validation-required-message="Email is required"
                                         data-validation-email-message="Email address is invalid"
                                        />

                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="inlineForm controls">
                                        <label>MM/YY</label>
                                        <input id="expiry" type="text" placeholder="Expire date"  
                                        data-validation-required-message="Expiry date is required"
                                        />

                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="inlineForm controls">
                                        <label>CVV</label>
                                        <input id="cvc" type="text" placeholder="CVV" 
                                        data-validation-required-message="CVV number is required" />

                                    </div>
                                </div>

                                    </div>
                                </div>
                      

                            </div>
                            <div class="help-block"></div>
                        </div>


                    </div>
                    <br />
                    <input type="hidden" name="plan" value="{{$plan}}" /> 
                    <a href="{{url('/plans')}}" class="backBtn">Return to Subscription Plans</a>
                    <button type="submit" class="blueSubmit" >Proceed to payment</button>
                    <div class="clearfix"></div>
                    </form>
                </div><!--End New User create section-->


                <!-- exisiting user section -->
                  <div class="col-md-7 existing-card">
                    <div class="row" id="card-display" style="display: none;">

                    </div>
                    <form action="{{url("/payment")}}" method="post" id="checkout-form" class="row">

                    <div class="MainHeader topMa">Checkout</div>
                    <div class="SubHeader">
                        Payment Method
                    </div>

                    <div class="row">

                        <div class="col-sm-12 control-group">
                            <div class="cardBox">
                                <div class="cardboxHeader">
                                    Credit Card
                                    <div class="Fright">
                                        <span class="visa"></span>
                                        <span class="master"></span>
                                    </div>
                                </div>
                                <br />

                                <div class="col-sm-12" style="min-height: 150px;">
                                    <p>You have already added Credit Card information</p>
                                </div>
                      

                            </div>
                            <div class="help-block"></div>
                        </div>


                    </div>
                    <br />
                    <input type="hidden" name="plan" value="{{$plan}}" /> 
                    <a class="backBtn">Return to Subscription Plans</a>
                    <button type="submit" class="blueSubmit" >Proceed to payment</button>
                    <div class="clearfix"></div>
                    </form>
                </div><!--End New User create section-->


                <!-- ENd existing user section -->


                <!--Registered user login-->
                <div class="col-md-5 ">
                    <div class="dayacsessBox">
                        <div class="dayHead">
                            <div class="gifbox">
                                <img src="{{url('/dist/')}}/img/gift.png" />
                            </div>
                            @if($plan=='0')
                            <div class="daaydetail">
                                <div class="day_head">Free plan</div>
                                <small></small>
                            </div>
                            <div class="price">$00.00</div>
                            @elseif($plan=='1')
                            <div class="daaydetail">
                                <div class="day_head">Yearly plan</div>
                                <small>Renews at $99.00/year</small>
                            </div>
                            <div class="price">$99.00</div>
                            @elseif($plan=='3')
                            <div class="daaydetail">
                                <div class="day_head">5 Day Access</div>
                                <small>Renews at $14.95/month on the 6th day</small>
                            </div>
                            <div class="price">$14.95</div>
                            @endif
                        </div>

                        <!--<div class="colom_price">
                            Resume Writing <span class="price">$35</span>
                        </div>
                        <div class="colom_price">
                            Interview Coaching <span class="price">$40</span>
                        </div>
                        <div class="colom_price">
                            Resume Review <span class="price">$15</span>
                        </div>
                        <hr style="border-bottom: 1px solid #cccccc">
                        
                        -->
                        <div class="colom_price">
                            Total <span class="price Blue">$ {{$cost}}</span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div> <!--End Registered user login-->
            </div>


        </div>











</div>
@include('includes/rb_footer')        
@endsection

@section('script')


<script type="text/javascript" src="{{url('/')}}/dist/js/jquery.card.js"></script>
<script type="text/javascript" src="{{url('/')}}/dist/js/jqBootstrapValidation.js"></script>


<script>

$(function(){

    var card = new Card({
        form: 'form',
        container: 'div#card-display',
        formSelectors: {
            numberInput: 'input#numberDisplay',
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
     Stripe.setPublishableKey('pk_live_24jzkLFhAul8PG8uxLgK0F4B');
     
     var $form = $('#checkout-form');
        
        $form.submit(function(event) {
            if(!validateCreditCard()) {
                return false;
            }
   
           

            $("#loading").show();
            $("#err_msg").hide();
            $("#err_msg").html("");
            
            $("#success_msg").hide();
            $("#success_msg").html("");
          // Disable the submit button to prevent repeated clicks:
          $form.find('.submit').prop('disabled', true);
          var yearMonthArray = eDate.split(' ').join('').split('/');
          var month = yearMonthArray[0];
          var year = yearMonthArray[1];
          // Request a token from Stripe:
          Stripe.card.createToken({
            number: $('#number').val(),
            cvc: $('#cvc').val(),
            exp_month: month,
            exp_year: year
          }, stripeResponseHandler);
          //Stripe.card.createToken($form, stripeResponseHandler);

          // Prevent the form from being submitted:
          return false;
    });
    
     
});

function stripeResponseHandler(status, response) {
  // Grab the form:
  var $form = $('#checkout-form');
  
  if (response.error) { // Problem!
      $("#loading").hide();
    // Show the errors on the form:
    $form.find('.help-block').text(response.error.message);
    $form.find('.submit').prop('disabled', false); // Re-enable submission

  } else { // Token was created!

    // Get the token ID:
    var token = response.id;

    // Insert the token ID into the form so it gets submitted to the server:
    $form.append($('<input type="hidden" name="stripeToken">').val(token));

    // Submit the form:
    //$form.get(0).submit();
    
    $.ajax({
        url: "{{url('/payment')}}",
        type: 'POST',
        data: $form.serialize(),
        dataType:'json',
        success:function(response){
            console.log(response);
            $("#loading").hide();
            if(response.status_code=='1'||response.status_code==1)
            {
                $("#err_msg").show();
                $("#err_msg").html(response.message);
                
            }
            else
            {
               $("#success_msg").show();
               $("#success_msg").html(response.message+". You'll be redirected to dashboard"); 
               setTimeout(function(){window.location="{{url('/dashboard')}}";},1000);
            }
        }
        
    });
  }
};


// validation
  $(function () {

   // $("input").jqBootstrapValidation();

document.getElementById('numberPreview').addEventListener('input', function (e) {
  e.target.value = e.target.value.replace(/[^\dA-Z]/g, '').replace(/(.{4})/g, '$1 ').trim();
});

   // format input

   $("#numberPreview").keypress(function (e) {
        if (e.which < 48 || 57 < e.which)
            e.preventDefault();
    });

   $('#numberPreview').keyup(function(){

        var displayValue = $(this).val();
       $('#number').val(displayValue.split(' ').join(''));
   });






    } );

 function validateCreditCard() {
    // alert('validating');
    var formValid = true;


      var required = [
        [ "Card Number", "#numberPreview"],
        [ "Email Address", "#email"],
        [ "Expiry Date", "#expiry"],
        [ "CVC Number", "#cvc"],
      ]
      

      required.forEach(function(item, index) {

        // cache element
        var element = $(item[1]);
        $(element.next('p.error-text')).remove();
        
        if(element.val() == '') {
            element.after('<p class="error-text">' + item[0] + ' is required </p>');
            formValid = false;
        } 

        else {
            // validate email address
            if(item[1] ==  '#email') {
                var email = element.val();
                    var atpos = email.indexOf("@");
                    var dotpos = email.lastIndexOf(".");
                    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length) {
                         element.after('<p class="error-text"> Email address is not valid </p>');
                         formValid = false;

                    }
            }

            //validate expire date
            if(item[1] ==  '#expiry') {
                var dateValid = true;
                var eDate = element.val()
                // console.log(eDate);
                // console.log(eDate.length)

   
                // spliting year and month
                var yearMonthArray = eDate.split(' ').join('').split('/');

                // if no year
                if(yearMonthArray.length < 2) {
                    dateValid = false;
                    formValid = false;
                } 
                else //if year is there 
                {
                    var eMonth = yearMonthArray[0];
                    var eYear = yearMonthArray[1];
                    // validate month
                    if(eMonth>12) {
                        dateValid = false;
                        formValid = false;
                    }    

                    // validate year
                    if(eYear.length < 2 || eYear.length > 4 || eYear.length == 3 || parseInt(eYear) == 0) {
                        dateValid = false;
                        formValid = false;
                    }
                }

                if(!dateValid) {
                    element.after('<p class="error-text"> Expiry date is not valid </p>');
                    formValid = false;
                }
            }
        }



      });
    return formValid;
   }



</script>
@endsection