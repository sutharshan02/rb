@extends('app')
@section('title','The Resume Builder')
@section('style')
<link href="{{url('/') . '/'}}assets/css/bootstrap/bootstrap-formhelpers-min.css" rel="stylesheet" type="text/css">
<link href="{{url('/') . '/'}}assets/css/bootstrap/bootstrapValidator-min.css" rel="stylesheet" type="text/css">
<link href="{{url('/') . '/'}}assets/css/bootstrap/bootstrap-side-notes.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" />
<!--JS-->
<script src="{{url('/') . '/'}}assets/js/bootstrap-formhelpers-min.js"></script>

<style type="text/css">
.col-centered {
    display:inline-block;
    float:none;
    text-align:left;
    margin-right:-4px;p
}
.row-centered {
	margin-left: 9px;
	margin-right: 9px;
}
</style>
@endsection
@section('content')

<form action="{{url('step/checkout')}}" method="POST" id="payment-form" class="form-horizontal">
   
    <input type="hidden" name="pack_id" value="{{$package_id}}" />
    <div class="row row-centered">
        <div class="col-md-12">
            <div class="page-header">
              <h2 class="gdfg">Secure Payment Form</h2>
            </div>            
            <noscript>
                <div class="bs-callout bs-callout-danger">
                  <h4>JavaScript is not enabled!</h4>
                  <p>This payment form requires your browser to have JavaScript enabled. Please activate JavaScript and reload this page. Check <a href="http://enable-javascript.com" target="_blank">enable-javascript.com</a> for more informations.</p>
                </div>
            </noscript>
            <div class="alert alert-danger" id="a_x200" style="display: none;"> <strong>Error!</strong> <span class="payment-errors"></span> </div>
            <span class="payment-success">

            </span>
            <fieldset class="col-md-4 col-md-offset-2">

                <!-- Form Name -->
                <legend>Billing Details</legend>

                <!-- Street -->
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="textinput">Street</label>
                    <div class="col-sm-6">
                        <input type="text" name="street" placeholder="Street" class="address form-control" data-stripe="address_line1">
                    </div>
                </div>

                <!-- City -->
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="textinput">City</label>
                    <div class="col-sm-6">
                        <input type="text" data-stripe="address_city" name="city" placeholder="City" class="city form-control">
                    </div>
                </div>

                <!-- State -->
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="textinput">State</label>
                    <div class="col-sm-6">
                        <input type="text" data-stripe="address_state" name="state" maxlength="65" placeholder="State" class="state form-control">
                    </div>
                </div>

                <!-- Postcal Code -->
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="textinput">Postal Code</label>
                    <div class="col-sm-6">
                        <input type="text" name="address_zip" maxlength="9" placeholder="Postal Code" class="zip form-control" data-stripe="address_zip">
                    </div>
                </div>

                <!-- Country -->
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="textinput">Country</label>
                    <div class="col-sm-6"> 
                        <!--input type="text" name="country" placeholder="Country" class="country form-control"-->
                        <div class="country bfh-selectbox bfh-countries" name="country" placeholder="Select Country" data-flags="true" data-filter="true" data-stripe="address_country"> </div>
                    </div>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="textinput">Email</label>
                    <div class="col-sm-6">
                        <input type="text" data-stripe="email" name="email" maxlength="65" placeholder="Email" class="email form-control">
                    </div>
                </div>
            </fieldset>

            <fieldset class="col-md-4">
                <legend>Card Details</legend>

<!--                 Card Holder Name 
                <div class="form-group">
                    <label class="col-sm-4 control-label"  for="textinput">Card Holder's Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="cardholdername" maxlength="70" placeholder="Card Holder Name" class="card-holder-name form-control">
                    </div>
                </div>-->

                <!-- Card Number -->
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="textinput">Card Number</label>
                    <div class="col-sm-6">
                        <input type="text" id="cardnumber" data-stripe="number" maxlength="19" placeholder="Card Number" class="card-number form-control">
                    </div>
                </div>

                <!-- Expiry-->
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="textinput">Card Expiry Date</label>
                    <div class="col-sm-6">
                        <div class="form-inline">
                            <select name="select2" data-stripe="exp-month" class="card-expiry-month stripe-sensitive required form-control" data-stripe="exp_month">
                                <option value="01" selected="selected">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                            <span> / </span>
                            <select name="select2" data-stripe="exp-year" class="card-expiry-year stripe-sensitive required form-control" data-stripe="exp_year">
                            </select>
                            <script type="text/javascript">
                                var select = $(".card-expiry-year"),
                                year = new Date().getFullYear();

                                for (var i = 0; i < 12; i++) {
                                    select.append($("<option value='"+(i + year)+"' "+(i === 0 ? "selected" : "")+">"+(i + year)+"</option>"))
                                }
                            </script> 
                        </div>
                    </div>
                </div>

                <!-- CVV -->
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="textinput">CVV/CVV2</label>
                    <div class="col-sm-3">
                        <input type="text" id="cvv" placeholder="CVV" maxlength="4" class="card-cvc form-control" data-stripe="cvc">
                    </div>
                </div>
                
                <!-- Submit -->
                
            </fieldset>
            <div class="col-md-12">
                <div class="control-group">
                    <div class="controls">                        
                      <center>
                          <a href="{{url('plans')}}" class="btn btn-success" style="width: 80px;margin: 14px;">Back</a>
                        <button class="btn btn-success" type="submit">Pay Now</button>                        
                      </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('script')

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
    Stripe.setPublishableKey('pk_test_6pRNASCoBOKtIshFeQd4XMUh');
</script>
<script>
    $(function() {
    var $form = $('#payment-form');
    $form.submit(function(event) {
      // Disable the submit button to prevent repeated clicks:
      $form.find('.submit').prop('disabled', true);

      // Request a token from Stripe:
      Stripe.card.createToken($form, stripeResponseHandler);

      // Prevent the form from being submitted:
      return false;

        function stripeResponseHandler(status, response) {
        // Grab the form:
        var $form = $('#payment-form');

        if (response.error) { // Problem!

          // Show the errors on the form:
          $form.find('.payment-errors').text(response.error.message);
          $form.find('.submit').prop('disabled', false); // Re-enable submission

        } else { // Token was created!

          // Get the token ID:
          var token = response.id;

          // Insert the token ID into the form so it gets submitted to the server:
          $form.append($('<input type="hidden" name="stripeToken">').val(token));

          // Submit the form:
          $form.get(0).submit();
        }
      };

    });
  });
</script>
<script src="{{url('/') . '/'}}assets/js/bootstrapValidator.js"></script>
<script>
    $(document).ready(function($) {
       $('#payment-form').bootstrapValidator({
           message: 'This value is not valid',
        fields: {
            street: {
                validators: {
                    notEmpty: {
                        message: 'The street is required and cannot be empty'
                    },
					stringLength: {
                        min: 6,
                        max: 96,
                        message: 'The street must be more than 6 and less than 96 characters long'
                    }
                }
            },
            city: {
                validators: {
                    notEmpty: {
                        message: 'The city is required and cannot be empty'
                    }
                }
            },
            
            state: {
                validators: {
                    notEmpty: {
                        message: 'The state is required and cannot be empty'
                    }
                }
            },
            address_zip: {
                validators: {
                    notEmpty: {
                        message: 'The zip is required and cannot be empty'
                    },
					stringLength: {
                        min: 3,
                        max: 9,
                        message: 'The zip must be more than 3 and less than 9 characters long'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required and can\'t be empty'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    },
					stringLength: {
                        min: 6,
                        max: 65,
                        message: 'The email must be more than 6 and less than 65 characters long'
                    }
                }
            },
            cardholdername: {
                validators: {
                    notEmpty: {
                        message: 'The card holder name is required and can\'t be empty'
                    },
					stringLength: {
                        min: 6,
                        max: 70,
                        message: 'The card holder name must be more than 6 and less than 70 characters long'
                    }
                }
            },
            cardnumber: {
		selector: '#cardnumber',
                validators: {
                    notEmpty: {
                        message: 'The credit card number is required and can\'t be empty'
                    },
					creditCard: {
						message: 'The credit card number is invalid'
					},
                }
            },
            expMonth: {
                selector: '[data-stripe="exp-month"]',
                validators: {
                    notEmpty: {
                        message: 'The expiration month is required'
                    },
                    digits: {
                        message: 'The expiration month can contain digits only'
                    },
                    callback: {
                        message: 'Month Expired',
                        callback: function(value, validator) {
                            value = parseInt(value, 10);
                            var year         = validator.getFieldElements('expYear').val(),
                                currentMonth = new Date().getMonth() + 1,
                                currentYear  = new Date().getFullYear();
                            if (value < 0 || value > 12) {
                                return false;
                            }
                            if (year == '') {
                                return true;
                            }
                            year = parseInt(year, 10);
                            if (year > currentYear || (year == currentYear && value > currentMonth)) {
                                validator.updateStatus('expYear', 'VALID');
                                return true;
                            } else {
                                return false;
                            }
                        }
                    }
                }
            },
            expYear: {
                selector: '[data-stripe="exp-year"]',
                validators: {
                    notEmpty: {
                        message: 'The expiration year is required'
                    },
                    digits: {
                        message: 'The expiration year can contain digits only'
                    },
                    callback: {
                        message: 'Year Expired',
                        callback: function(value, validator) {
                            value = parseInt(value, 10);
                            var month        = validator.getFieldElements('expMonth').val(),
                                currentMonth = new Date().getMonth() + 1,
                                currentYear  = new Date().getFullYear();
                            if (value < currentYear || value > currentYear + 100) {
                                return false;
                            }
                            if (month == '') {
                                return false;
                            }
                            month = parseInt(month, 10);
                            if (value > currentYear || (value == currentYear && month > currentMonth)) {
                                validator.updateStatus('expMonth', 'VALID');
                                return true;
                            } else {
                                return false;
                            }
                        }
                    }
                }
            },
            cvv: {
                selector: '[data-stripe="cvc"]',
                validators: {
                    notEmpty: {
                        message: 'The cvv/cvv2 is required and can\'t be empty'
                    },
					stringLength: {
                        min: 3,
                        max: 3,
                        message: 'The cvv/cvv2 must be a 3 digit number'
                    }
                }
            }
            
            
            
        }
       }); 

    });
</script>
@endsection