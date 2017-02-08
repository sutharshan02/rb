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
                    <div class="centerMainHeader">Terms of Use</div><br />
                    <p>
                        Welcome to the resume builder.com . By using our site, you are agreeing to comply with and be bound by the following terms of use. Please review the following terms carefully. If you do not agree to these terms, you should not use this site. The term or "us" or "we" or "our" refers to the resume builder.com, the owner of the Web site. The term "you" refers to the user or viewer of our Web Site.

                    </p>
                    <br />

                    <h4 class="black">Acceptance of Agreement.</h4>
                    <p>You agree to the terms and conditions outlined in this Terms of Use Agreement ("Agreement") with respect to our site (the "Site").</p>
                    <p>This Agreement constitutes the entire and only agreement between us and you, and supersedes all prior or contemporaneous agreements, representations, warranties and understandings with respect to the Site, the content, products or services provided by or through the Site, and the subject matter of this Agreement. This Agreement may be amended at any time by us from time to time without specific notice to you. The latest Agreement will be posted on the Site, and you should review this Agreement prior to using the Site. This is a legally binding Agreement, which means it involves lawyers, legal rights, obligations, and remedies.</p>

                    <br />
                    <h4 class="black">Description of Service</h4>
                    <p>The resume builder is an online service that provides job search related services including resume and letter creation; help with interviewing, salary negotiation, and job acceptance etiquette. Our Service is based online so you need to have a device that is connected to the Internet to use it.</p>

                    <br />
                    <h4 class="black">Eligibility, Registration, Interaction with Third Parties</h4>
                    <p>In order for you to sign up with us, you may be required to provide various information about yourself including but not limited to your name, email address, mailing address, zip code, credit card information, and telephone number. We will also ask you general questions about work history and background in order to provide our Service to you.</p>
                    <br />
                    <p>In addition to providing us with the above information, you must be at least eighteen years old to sign up for our service, or at least the age of contractual capacity that exists in your jurisdiction.</p>







                    <br />
                    <h4 class="black">Copyright</h4>
                    <p>The content, organization, graphics, design, compilation, magnetic translation, digital conversion and other matters related to the Site are protected under applicable copyrights, trademarks and other proprietary (including but not limited to intellectual property) rights. The copying, redistribution, use or publication by you of any such matters or any part of the Site, except as allowed by Section 4 below, is strictly prohibited. You do not acquire ownership rights to any content, document or other materials viewed through the Site. The posting of information or materials on the Site does not constitute a waiver of any right in such information and materials. Some of the content on the site is the copyrighted work of third parties. </p>


                    <br />
                    <h4 class="black">Limited License; Permitted Uses.</h4>
                    <p>You are granted a non-exclusive, non-transferable, revocable license (a) to access and use the Site strictly in accordance with this Agreement; (b) to use the Site solely for internal, personal, non-commercial purposes; and (c) to print out discrete information from the Site solely for internal, personal, non-commercial purposes and provided that you maintain all copyright and other policies contained therein.</p>
                    <br />
                    <p>No print out or electronic version of any part of the Site or its contents may be used by you in any litigation or arbitration matter whatsoever under any circumstances. Your license for access and use of the Site and any information, materials or documents (collectively defined as "Content and Materials") therein are subject to the following restrictions and prohibitions on use: You may not (a) copy, print (except for the express limited purpose permitted by Section 4 above), republish, display, distribute, transmit, sell, rent, lease, loan or otherwise make available in any form or by any means all or any portion of the Site or any Content and Materials retrieved therefrom; (b) use the Site or any materials obtained from the Site to develop, of as a component of, any information, storage and retrieval system, database, information base, or similar resource (in any media now existing or hereafter developed), that is offered for commercial distribution of any kind, including through sale, license, lease, rental, subscription, or any other commercial distribution mechanism.</p>

                    <br />
                    <h4 class="black">Billing and Cancellation</h4>
                    <p>Using our Service, you'll be able to write, edit, send, and store all your resumes and cover letters. You can also find new job listings, prepare for interviews, and get one-on-one support from certified experts.</p>

                    <p>Subscriptions : We offer a free membership where you can explore all areas of our Service, but cannot print, download or email resumes or letters.</p>

                    <p>Our Site’s paid memberships are available either monthly or annually and are automatically charged on a recurring basis. We do not provide monthly reminder emails before billing and you must cancel your account to avoid recurring billing. Please be advised we will automatically charge your credit or debit card at the start of the billing period and at the start of each renewal period, unless you terminate or cancel your membership before the relevant renewal period begins. All fees are non-refundable. You can cancel our Service by contacting Customer Service via email, form submission, message service, or telephone number published on our Site. Once an account is cancelled, your account enters an inactive state, similar to our free membership service, where you can continue to edit your documents, but cannot download, print, or email. We do not require your credit card up front for our free membership option, but we will need it if you decide to commit to a monthly or annual membership or a professional resume.</p>

                    <p>You may cancel at any time. If there is time remaining on a monthly subscription, you will have the ability to download, print, or email your documents for the remainder of the subscription. If you cancel your subscription then your information, including your profile and all documents, is saved indefinitely.</p>

                    <br />
                    <h4 class="black">Restrictions and Prohibitions on Use</h4>
                    <p>Your license for access and use of the Site and any information, materials or documents (collectively defined as "Content and Materials") therein are subject to the following restrictions and prohibitions on use: You may not (a) copy, print (except for the express limited purpose permitted by Section 4 above), republish, display, distribute, transmit, sell, rent, lease, loan or otherwise make available in any form or by any means all or any portion of the Site or any Content and Materials retrieved therefrom; (b) use the Site or any materials obtained from the Site to develop, of as a component of, any information, storage and retrieval system, database, information base, or similar resource (in any media now existing or hereafter developed), that is offered for commercial distribution of any kind, including through sale, license, lease, rental, subscription, or any other commercial distribution mechanism.</p>



                    <br />
                    <h4 class="black">Forms, Agreements & Documents</h4>
                    <p>We may make available through the Site or through other Web sites sample and actual forms, checklists, business documents and legal documents (collectively, "Documents"). All Documents are provided on a non-exclusive license basis only for your personal one-time use for non-commercial purposes, without any right to re-license, sublicense, distribute, assign or transfer such license. Documents are provided for a charge and without any representations or warranties, express or implied, as to their suitability, legal effect, completeness, correctness, accuracy, and/or appropriateness.</p>

                    <p>The Documents are provided "as is", "as available", and with "all faults", and we and any provider of the Documents disclaim.</p>


                    <br />
                    <h4 class="black">No Legal Advice or Attorney-Client Relationship</h4>
                    <p>
                        Information contained on or made available through the Site is not intended to and does not constitute legal advice, recommendations, mediation or counseling under any circumstance and no attorney-client relationship is formed. We do not warrant or guarantee the accurateness, completeness, adequacy or currency of the information.</p>

















                </div>
            </div>

        </div>









</div>


@include('includes/rb_footer')        
@endsection

@section('script')

@endsection