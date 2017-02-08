<section class="home-page-footer">


          <div class="container home-footer-container">

            <h1>Contact Resume Builder</h1>

            <p>Have a question or a feedback? Please contact us using the form below</p>

            <form action="{{url('/contactHome')}}" method="post">
            <div class="row home-footer-row">
              <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row">
                  <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-group">
                     <div class="controls">
                    <label>Name</label>
                    <input type="text" name="name" placeholder="Name"
                    data-validation-required-message="Name is required"/>   
                    </div> 
                  </div>
                  <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-group ">
                    <div class="controls">
                    <label>Email Address</label>
                    <input type="text" name="email" placeholder="Email Address"
                    data-validation-email-message="Email address is invalid"
                    data-validation-required-message="Email address is required"/>    
                  </div>
                  </div>
                  <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-group">
                     <div class="controls">
                    <label>Message</label>
                    <input type="text" name="message" placeholder="Please type..."
                    data-validation-required-message="Please enter your message"/>    
                  </div>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                <div class="row">
                  <div class="col-xs-12 ">
                    <label>&nbsp</label>
                    <button type="submit" class="">Submit</button>  
                  </div>
                  
                </div>
              </div>
            </div>
            </form>
          </div>


            <footer class="inner-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="row">
                                <p>© 2016, The Resume Builder. All Rights Reserved</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 clearfix">
                            <div class="row">
                                <ul>
                                    <li>
                                        <h6>Follow us on</h6>
                                    </li>
                                    <li><a target="_blank" href="https://www.facebook.com/pages/The-Resume-Builder/381841202976"><img src="{{asset('assets/images/facebook.png')}} " alt="" class="img-responsive" onmouseover="socialHover(this, '{{asset('assets/images/facebook-hover.png')}}');" onmouseout="socialUnhover(this, '{{asset('assets/images/facebook.png')}}');"></a></li>
                                    <li><a target="_blank" href="https://twitter.com/TheResumeBuildr"><img src="{{asset('assets/images/twtter.png')}}" alt="" class="img-responsive" onmouseover="socialHover(this, '{{asset('assets/images/twitter-hover.png')}}');" onmouseout="socialUnhover(this, '{{asset('assets/images/twitter.png')}}');"></a></li>
                                    <li><a target="_blank" href="https://plus.google.com/107836200658672959026"><img src="{{asset('assets/images/google.png')}}" alt="" class="img-responsive" onmouseover="socialHover(this, '{{asset('assets/images/google-hover.png')}}');" onmouseout="socialUnhover(this, '{{asset('assets/images/google.png')}}');"></a></li>
                                    <li><a target="_blank" href="https://www.linkedin.com/company/theresumebuilder-com"><img src="{{asset('assets/images/in.png')}}" alt="" class="img-responsive" onmouseover="socialHover(this, '{{asset('assets/images/in-hover.png')}}');" onmouseout="socialUnhover(this, '{{asset('assets/images/in.png')}}');"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- container -->
            </footer>


</section>

<script>
	function socialHover(element, url) {
		$(element).attr('src', url);
	}
	function socialUnhover(element, url) {
		$(element).attr('src', url);
	}
</script>