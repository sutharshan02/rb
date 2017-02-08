@extends('app')
@section('title','The Resume Builder')
@section('style')

<style>
    .as-seen-col { 
      /*border: 1px dashed blue;*/
  }

  .as-seen {
    padding-top: 25px;
/*  border: 1px solid red;
  display: flex;
  justify-content: space-between;
  align-items: center;*/
}

.as-seen img {
  width: 150px;
  filter: grayscale(100%);
  -webkit-filter: grayscale(100%);
  opacity: .4;
}
.as-seen a img {
  transform: all 300ms ease-in-out;
}

.as-seen a:hover img {
  width: 150px;
  filter: grayscale(0%);
  -webkit-filter: grayscale(0%);
  opacity: 1;
}



.home-section-4 .right a {
    display: inline-block;
    vertical-align: top;
    margin-right: 12%;
}

.home-section-4 .right a:last-child {
    margin-right: 0;
}


section.hr, section.hr * {
    padding-top: 0px;
    padding-bottom: 0px;
}

section.hr hr {
    border-top: 2px solid #ccc;
    opacity: .6;
}

.rb-navgation .navbar-nav .build-your a:hover {
	color: #ffffff;
}

.signup-plan-box a:hover {
	color: #ffffff !important;
	box-shadow: 0px 0px 10px 3px #a1a1a1;
}

@media only screen 
  and (min-device-width: 414px) 
  and (max-device-width: 736px){
	.home-banner-row {
		text-align: center;
	}
}

@media only screen 
  and (min-device-width: 320px) 
  and (max-device-width: 480px){
	.home-banner-row {
		text-align: center;
	}
}

/*remove footer fix*/
    html, body {
            height: auto%;

        }

        .full_page_wrap {

           min-height: auto;
           padding-bottom: auto;
       }

       .inner-footer {
          margin-top: auto;
          height: auto;;
      }

      .home-section-2 {

          background-attachment: scroll;
      }
	  
</style>


@endsection



@section('content')
<?php if(Session::has('user')) { ?>
    @include('includes/rb_user_logged_header')
    <?php }else{?>   
    @include('includes/rb_header')
    <?php }?>


    <any ng-controller="homeCtrl">

    </any>


    @if (Session::has('sent'))
    <link href="{{url('/') . '/'}}dist/css/style.css" rel="stylesheet" type="text/css">
<link href="{{url('/') . '/'}}dist/css/res.css" rel="stylesheet" type="text/css">
<!--alert box-->
<div class="alert_confirm open"><!--remove 'open' class to display none.-->
  <span class="closeBtn "></span>
  <img src="{{url('/dist')}}/img/sucsess.png" />
  <h2 class="black">Thank you!</h2>
  <p>Your message has been sent</p>

</div><!--End alert box-->


@endif
    <section class="home-banner-section" style="background-image  : url({{url('/') . '/'}}assets/images/home-1.png);">

        <div class="container">

            <div class="row">

                <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                    <div class="row home-banner-row">
                        <h1>Get Hired Faster</h1>
                        <h2>Create a professional resume in minutes</h2>
                        <div class="row">
                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 left">
                                <p><b>Simple </b> &amp; easy to use</p>
                            </div>

                            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5 mid">
                                <p><b>1000s </b>of professionally written resumes</p>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 right">
                                <p><b>One click export </b>to Microsoft or PDF</p>
                            </div>
                        </div>

                        <a class="hover-shadow" href="{{url('/resume/create#')}}">Get Started on your resume for free</a> 
                    </div>
                </div>

            </div>

        </div>

    </section><!-- home-banner-section -->

    <section class="home-section-1">

        <div class="container">

            <div class="row home-section-1-row">
                <h2>Get hired 3X faster with a professionally designed resume<br/>with our simple and fast builder...</h2>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <img src="{{url('/') . '/'}}assets/images/home-2.1.png" alt="" class="img-responsive">
                    <h5>Simple and Easy</h5>
                    <p>Build your resume in 4 easy steps</p>
                </div>

                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 mid">
                    <img src="{{url('/') . '/'}}assets/images/home-2.2.png" alt="" class="img-responsive">
                    <h5>Fast</h5>
                    <p>The average resume takes <br/>just minutes to build</p>
                </div>

                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <img src="{{url('/') . '/'}}assets/images/home-2.3.png" alt="" class="img-responsive">
                    <h5>Get hired faster</h5>
                    <p>We have helped over 192,000 get hired faster since 2008</p>
                </div>

            </div>

        </div>

    </section><!-- home-section-1 -->

    <section class="home-section-2">

        <div class="container">

            <div class="row home-section-2-row">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                    <div class="row left">

                        <h3>About Resume Builder</h3>

                        <div class="row">
                            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 img-box">
                                <img src="{{url('/') . '/'}}assets/images/home-3.1.png" alt="" class="img-responsive">  
                            </div>

                            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 content-box">
                                <p>Since 2005 we have been building <br/>resumes for our customers</p>   
                            </div>
                        </div><!-- one row -->

                        <div class="row">
                            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 img-box">
                                <img src="{{url('/') . '/'}}assets/images/home-3.1.png" alt="" class="img-responsive">  
                            </div>

                            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 content-box">
                                <p>We have built over 1,200,000 <br/>resumes</p>   
                            </div>
                        </div><!-- one row -->

                        <div class="row">
                            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 img-box">
                                <img src="{{url('/') . '/'}}assets/images/home-3.1.png" alt="" class="img-responsive">  
                            </div>

                            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 content-box">
                                <p>Our Resumes are built by <br/>HR Experts</p>   
                            </div>
                        </div><!-- one row -->

                        <a href="">LEARN MORE ABOUT US</a>


                    </div>

                </div>

                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                    <div class="row right">

                        <h3>Resume Tips</h3>

                        <div class="row">
                            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 img-box">
                                <img src="{{url('/') . '/'}}assets/images/home-3.1.png" alt="" class="img-responsive">  
                            </div>

                            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 content-box">
                                <p>Pre written phrases written by HR experts <br/>which you place within your resume</p>   
                            </div>
                        </div><!-- one row -->

                        <div class="row">
                            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 img-box">
                                <img src="{{url('/') . '/'}}assets/images/home-3.1.png" alt="" class="img-responsive">  
                            </div>

                            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 content-box">
                                <p>1000s of phrases to choose from <br/>for your specific job</p>   
                            </div>
                        </div><!-- one row -->

                        <div class="row">
                            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 img-box">
                                <img src="{{url('/') . '/'}}assets/images/home-3.1.png" alt="" class="img-responsive">  
                            </div>

                            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 content-box">
                                <p>Makes building a resume easy, and <br/>fast with a professional touch</p>   
                            </div>
                        </div><!-- one row -->

                        <a href="">READ MORE TIPS</a>

                    </div>

                </div>



            </div>

        </div>

    </section><!-- home-section-2 -->

    <section class="home-section-3">

        <div class="container">

            <div class="row home-section-3-row">
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">

                    <div class="row left">
                        <h3>Resume Templates</h3>

                        <div class="row">
                            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 img-box">
                                <img src="{{url('/') . '/'}}assets/images/home-3.1.png" alt="" class="img-responsive">  
                            </div>

                            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 content-box">
                                <p>Choose a Professionally Designed Resume Template</p>   
                            </div>
                        </div><!-- one row --> 

                        <div class="row">
                            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 img-box">
                                <img src="{{url('/') . '/'}}assets/images/home-3.1.png" alt="" class="img-responsive">  
                            </div>

                            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 content-box">
                                <p>Traditional and Modern Templates available for any Industry</p>   
                            </div>
                        </div><!-- one row -->


                        <div class="row">
                            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 img-box">
                                <img src="{{url('/') . '/'}}assets/images/home-3.1.png" alt="" class="img-responsive">  
                            </div>

                            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 content-box">
                                <p>One-Click Resume Template <br/>Change</p>   
                            </div>
                        </div><!-- one row -->

                        <a href="">LEARN MORE</a>
                    </div>

                </div>

                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">

                    <div class="row mid">

                      <div class="row row_clr row_mid">
                          <h3>Resume Help</h3>

                          <div class="row ">
                            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 img-box">
                                <img src="{{url('/') . '/'}}assets/images/home-3.1.png" alt="" class="img-responsive">  
                            </div>

                            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 content-box">
                                <p>Resume Help</p>   
                            </div>
                        </div><!-- one row --> 

                        <div class="row">
                            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 img-box">
                                <img src="{{url('/') . '/'}}assets/images/home-3.1.png" alt="" class="img-responsive">  
                            </div>

                            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 content-box">
                                <p>Resume Articles and Advice</p>   
                            </div>
                        </div><!-- one row -->


                        <div class="row">
                            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 img-box">
                                <img src="{{url('/') . '/'}}assets/images/home-3.1.png" alt="" class="img-responsive">  
                            </div>

                            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 content-box">
                                <p>Easy Resume Builder Tool</p>   
                            </div>
                        </div><!-- one row -->

                        <div class="row">
                            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 img-box">
                                <img src="{{url('/') . '/'}}assets/images/home-3.1.png" alt="" class="img-responsive">  
                            </div>

                            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 content-box">
                                <p>24/7 Access to your resume writing account</p>   
                            </div>
                        </div><!-- one row -->

                        <a href="">LEARN MORE</a>
                    </div>

                </div>

            </div>

            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">

                <div class="row right row_mid">
                    <h3>Resume Writing</h3>

                    <div class="row right">
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 img-box">
                            <img src="{{url('/') . '/'}}assets/images/home-3.1.png" alt="" class="img-responsive">  
                        </div>

                        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 content-box">
                            <p>Resume Writing Tips and <br/>Sample Phrases</p>   
                        </div>
                    </div><!-- one row --> 

                    <div class="row">
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 img-box">
                            <img src="{{url('/') . '/'}}assets/images/home-3.1.png" alt="" class="img-responsive">  
                        </div>

                        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 content-box">
                            <p>Step by Step process for writing <br/>your resume</p>   
                        </div>
                    </div><!-- one row -->


                    <div class="row">
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 img-box">
                            <img src="{{url('/') . '/'}}assets/images/home-3.1.png" alt="" class="img-responsive">  
                        </div>

                        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 content-box">
                            <p>Online advice from professional resume writers</p>   
                        </div>
                    </div><!-- one row -->

                    <a href="">LEARN MORE</a>
                </div>

            </div>



        </div>

    </div>

</section><!-- home-section-3 -->

<section class="home-section-4">

    <div class="container">

        <div class="row">

            <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">

                <div class="row">

                    <h2>Associations</h2>

                </div>

            </div>

            <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">

                <div class="row right">

                    <img src="{{url('/') . '/'}}assets/images/home-4.2.png" alt="" class="img-responsive">

                    <img src="{{url('/') . '/'}}assets/images/home-4.4.png" alt="" class="img-responsive">

                    <img src="{{url('/') . '/'}}assets/images/home-4.3.png" alt="" class="img-responsive">

                    <img src="{{url('/') . '/'}}assets/images/home-4.1.png" alt="" class="img-responsive">

                </div>

            </div>


        </div>

    </div>

</section><!-- home-section-3 -->



<section class="home-section-4 hr">

    <div class="container">

        <div class="row">

            <hr/>


        </div>

    </div>

</section><!-- home-section-3 -->


<section class="home-section-4">

    <div class="container">

        <div class="row">

            <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">

                <div class="row">

                    <h2>As seen in</h2>

                </div>

            </div>

            <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10 as-seen-col">

                <div class="row right as-seen">

                 <a target="_blank" href="http://www.forbes.com/sites/larrymyler/2016/09/29/after-you-start-your-business-7-ways-to-make-it-grow"> <img src="{{url('/') . '/'}}assets/images/seen/1_active.jpg" alt="" class="img-responsive"></a>

                 <a target="_blank" href=" http://www.huffingtonpost.com/gabrielle-pfeiffer/how-social-media-can-be-u_b_11788728.html"> <img src="{{url('/') . '/'}}assets/images/seen/2_active.jpg" alt="" class="img-responsive"></a>

                 <a target="_blank" href="http://www.business.com/content-marketing/7-truths-about-content-marketing-you-dont-want-to-hear/"> <img src="{{url('/') . '/'}}assets/images/seen/3_active.jpg" alt="" class="img-responsive"></a>

                 <a target="_blank" href="https://www.engadget.com/2016/08/23/is-social-media-ruining-your-job-search/"> <img src="{{url('/') . '/'}}assets/images/seen/4_active.jpg" alt="" class="img-responsive"></a>

             </div>

         </div>


     </div>

 </div>

</section><!-- home-section-3 -->






<section class="signup-plans-wrapper home-page-signup-plans-wrapper">
    <div class="container">
        <div class="row">
            <h1>Choose a Plan</h1>
            <p>Choose from our 5 Days, and Yearly plans for Downloading Created Resume</p>
        </div>
        <div class="row signup-plan-row">
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 left">
                <div class="row row_clr signup-plan-box">
                    <div class ="top">
                        <h3>Free Plan</h3>
                    </div>
                    <div class ="mid">
                        <div class="col-xs-12">
                            <h3>Free</h3>
                        </div>
                    </div>
                    <div class ="bottom">
                        <img src="{{url('/') . '/'}}assets/images/signup-plans-5.png" alt="" class="img-responsive border-img">
                        <h3><span>Start building</span> your <br/>resume now!</h3>
                        <img src="{{url('/') . '/'}}assets/images/signup-plans-5.png" alt="" class="img-responsive border-img">

                        <a href="{{ url('checkout')}}" class="get-started-button">Get Started Now</a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 mid">
                <div class="row row_clr signup-plan-box">
                    <div class ="top">
                        <h3>5 Day Access</h3>
                    </div>
                    <div class ="mid">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="row">
                                <h4><span>$</span>4.95</h4>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <h5>FOR<br/>5 DAYS</h5>
                        </div>
                    </div>
                    <div class ="bottom">
                        <h6>Renews at $14.95/month on the 6th day</h6>
                        <img src="{{url('/') . '/'}}assets/images/signup-plans-5.png" alt="" class="img-responsive border-img">
                        <ul>
                            <li>Resume<span> Tracking</span></li>
                            <li><span>Download </span>PDF</li>
                            <li><span>Printable </span>Resume</li>
                        </ul>
                        <img src="{{url('/') . '/'}}assets/images/signup-plans-5.png" alt="" class="img-responsive border-img">
                        <a href="{{url('checkout')}}" class="get-started-button">Get Started Now</a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 right">
                <div class="row row_clr signup-plan-box">
                    <div class ="top">
                        <h3>Yearly Plan</h3>
                    </div>
                    <div class ="mid">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="row">
                                <h4><span>$</span>99</h4>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <h5>PER<br/>YEAR</h5>
                        </div>
                    </div>
                    <div class ="bottom">
                        <h6>Equal to $8.25 Per month</h6>
                        <img src="{{url('/') . '/'}}assets/images/signup-plans-5.png" alt="" class="img-responsive border-img">
                        <ul>
                            <li>Resume<span> Tracking</span></li>
                            <li><span>Download </span>PDF</li>
                            <li><span>Printable </span>Resume</li>
                            <li><span>No </span>monthly billing</li>
                            <li><span>Cancel </span>anytime</li>
                        </ul>
                        <img src="{{url('/') . '/'}}assets/images/signup-plans-5.png" alt="" class="img-responsive border-img">

                        <a href="{{url('checkout')}}" class="get-started-button">Get Started Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- signup-plans-wrapper -->





@include('includes/footer')
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
