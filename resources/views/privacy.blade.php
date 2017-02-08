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
            <!--Hint box-->


            <div class="row">
                <div class="col-md-12">
                    <div class="centerMainHeader">Privacy Policy</div><br />
                    <p>
                        Your privacy on the Internet is a fundamental element of the way we do business at theresumebuilder.com. Theresumebuilder.com is designed to assist users to create a professional resume quickly and at a minimal cost. Because we will be working together using the Web as your information communication vehicle and as a tool to create a resume, we feel you should fully understand the terms and conditions surrounding the capture and use of that information. This privacy statement discloses what information we gather and how we use it within this web site.
                    </p>
                    <br />
                    <h4 class="black">What Information We Collect</h4>
                    <p>All information we collect is solely for the creation of your resume. Your contact information, content and personal details are not used in any form for any other reason than to create your resume on our service. You will not be contacted by any party through any form of communication without your prior consent.</p>

                    <br />
                    <h4 class="black">How We Collect Information</h4>
                    <p>Theresumebuilder.com is an interactive software application, and as a result there are various ways in which we can obtain information about you through the following processes:</p>

                    
                    
                    
                    
                    <br />
                    <h4 class="fo-w-normal">1. Registration</h4>
                    <p>Users are requested to register for various theresumebuilder.com applications, Information that is required to be completed in order to run the application is only for login in purposes. theresumebuilder.com requests registration information to customize functionality. We use your e-mail address for our communication with you, such as help reset a forgotten password.</p>

                    <br />
                    <h4 class="fo-w-normal">2. Aggregate Information</h4>
                    <p>Theresumebuilder.com will from time to time collect information about our registered users. Theresumebuilder.com may also distribute surveys or solicit other forms of feedback from our registered users concerning our materials and services. All of this information is used to aggregate demographic information about our users to assist us in decisions concerning new application development and content or selecting the most effective partners and affiliates. All responses to surveys or feedback solicitations are voluntarily submitted to theresumebuilder.com. As aggregate information, it is represented as statistical collections and thus, is not personally identifiable.</p>

                    <br />
                    <h4 class="fo-w-normal">3. Cookies</h4>
                    <p>A cookie is a small data file that web sites write to your hard drive when you visit them. A cookie file most often contains information such as a user ID that the site uses to customize information presentation or track the pages you visit. Theresumebuilder.com. will use cookies to track how you are using our site and applications. We use this information to optimize our site in navigation and performance. You are always free to decline our cookies if your browser permits, but some parts of our site may not work properly in that case.. As well, while browsing Web sites from theresumebuilder.com content providers or sponsors, you may have cookies written to your computer by these sites. theresumebuilder.com does not control these cookies.</p>

                    <br />
                    <h4 class="fo-w-normal">4.IP Addresses</h4>
                    <p>theresumebuilder.com collects IP address information for the purposes of system administration, to report aggregate information to our sponsors and partners, and to audit the use of our services and materials. Because we collect and store statistics about your online activities on an aggregated (collective) basis, this information is not personally identifiable. We do not link IP addresses to personal identification unless necessary to enforce compliance with our Terms of Use or to protect our service, site, or users.</p>

                    
                    <br />
                    <h4 class="black">How We Use and Disclose Your Information</h4>
                    <p>Theresumebuilder.com uses any User Information voluntarily given by our users to enhance their finished resume on our site. We collect information only required to complete your resume. Theresumebuilder.com will not make any information that we collect from users available to the general public in any form without the prior written consent of the effected user unless (a) the information is already publicly available, (b) such disclosure is required by law, court order, or is requested by other government or law enforcement authority, or (c) the information is posted by the user to an on-line bulletin board, chat room, news group or other public forum.</p>
<br />
                    <p>Theresumebuilder.com utilizes industry-standard security procedures to protect all personally identifiable information within its control from loss, misuse or unauthorized alteration. Such security protocols include fire walls, encryption, password protection and physical on-site security. DESPITE THESE SECURITY MEASURES, WE CANNOT GUARANTEE THAT ALL OF YOUR PRIVATE COMMUNICATIONS OR PERSONAL INFORMATION WILL NEVER BE DISCLOSED OR UNLAWFULLY ACCESSED BY UNAUTHORIZED THIRD PARTIES.</p>
                    
                    <br />
                    <h4 class="black">Opt-out Policy</h4>
                    <p>Theresumebuilder.com provides users with choices regarding how personally identifiable information that we collect may be distributed. To this end, except as expressly set forth above, users may opt-out regarding (a) how the information we collect may be used when such use is unrelated to the purpose for which it was collected, and (b) how the information we collect may be distributed to third parties when such distribution is unrelated to the purpose for which the information was collected. A user may close their account with theresumebuilder.com at any time and all information will be purged from our system and data bases. </p>


<br />
                    <h4 class="black">Correcting/Updating of Information</h4>
                    <p>Theresumebuilder.com offers users the ability to correct or change the information collected during the resume creation process. A trial account will automatically purge all information in 14 days from creation if the account is not upgraded to a paid account. </p>

                    <br />
                    <h4 class="black">Limits on Our Abilities</h4>
                    <p>Although your privacy is very important to us, due to the existing legal and regulatory environment, we cannot fully ensure that your private communications and other personally identifiable information will not be disclosed to third parties. For example, we may be forced to disclose information to the government or third parties under certain circumstances, or third parties may unlawfully intercept or access transmissions or private communications. Additionally, we can (and you authorize us to) disclose any information about you to private entities, law enforcement or other government officials as we, in our sole discretion, believe necessary or appropriate to investigate or resolve possible problems or inquiries. </p>


                    <br />
                    <h4 class="black">User Complaints</h4>
                    <p>User complaints regarding theresumebuilder.com privacy practices should be sent to admin@theresumebuilder.com . We will respond to all such inquiries within 2 business days of receipt. Copyright theresumebuilder.com, 2014. </p>

                    



                    
                    
                    
                    
                    
                    
                    
                    
                    
                    




                </div>
            </div>

        </div>








</div>


@include('includes/rb_footer')        
@endsection

@section('script')

@endsection