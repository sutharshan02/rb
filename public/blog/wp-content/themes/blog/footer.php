  <div class="row row_clr footer_full">
	
    <div class="container">
    
    	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 footer_left left_clear">
        	<div class="row row_clr">
            	<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 footer_left_1">
                	<img src="<?php echo THEMEROOT ?>/images/footer_logo.png" alt="" class="img-responsive"/>
                </div>
                
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 footer_left_2">
                	<p>&copy; 2014 THE RESUME BUILDER.ALL RIGHTS RESERVED.<br/><a href="http://www.eight25media.com/" target="_blank">SOLUTION BY EIGHT25MEDIA.</a></p>
                </div>
            </div>
        </div><!--end footer_left--> 
        
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 footer_right right_clear">
        	<ul>
         	 <li><a href="/" id="">HOME</a> &middot; </li>
             <li><a href="/about" id="">ABOUT</a> &middot; </li>
             <li><a href="/blog" id="">RESUME TIPS</a> &middot; </li>
             <li><a href="/plans" id="">PLANS</a> &middot; </li>
             <li><a href="/contact" id="">CONTACT US</a> | </li>
             <li><a href="/sitemap" id="">SITEMAP</a> &middot; </li>
             <li><a href="/privacy_resume_builder" id="">PRIVACY</a> &middot; </li>
             <li><a href="/terms_resume_builder" id="">TERMS</a></li>
             
          </ul>
        </div><!--end footer_right--> 
    
    </div><!--end container-->  
    
</div><!--end footer_full-->             



<script src="<?php echo THEMEROOT ?>/js/jquery.js" type="text/javascript"></script>

<script src="<?php echo THEMEROOT ?>/js/bootstrap.min.js" type="text/javascript"></script>

<script src="<?php echo THEMEROOT ?>/js/html5shiv.js" type="text/javascript"></script>

<script type="text/javascript">
    
    jQuery(document).ready(function() {
    var docHeight = jQuery(window).height();
   // alert(docHeight);
    var footerHeight = jQuery('.footer_full').height();
    var footerTop = jQuery('.footer_full').position().top + footerHeight;
    if (footerTop < docHeight) {
    jQuery('.footer_full').css('margin-top', 0 + (docHeight - footerTop) + 'px');
    }
    });
   
</script>

</body>
</html>