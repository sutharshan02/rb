<?php
ob_start();
session_start();

wp_head();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
<meta name="format-detection" content="telephone=no" />
<meta name="viewport" content="width=1200px, maximum-scale=1.0 " />

<link rel="stylesheet" media="all and (orientation:portrait)" href="css/style_mob_verticle.css">
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>


<title><?php wp_title( '|', true, 'right' );?></title>
<!--Style Sheets-->
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" />
<link rel="icon" href="<?php print IMAGES;?>/favicon.ico" type="image/x-icon" /><!-- fv icon -->

  		<script type="text/javascript">
         
  
            $(document).ready(function() {
   
				
				 //cache nav  
                var nav = $("#topNav");  
                //add indicators and hovers to submenu parents  
                nav.find("li").each(function() {  
                    if ($(this).find("ul").length > 0) {  
                        // $("<span>").text(">").appendTo($(this).children(":first"));  
                
                        //show subnav on hover  
                        $(this).mouseenter(function() {  
                            $(this).find("ul").stop(true, true).slideDown();  
                        });  
                        //hide submenus on exit  
                        $(this).mouseleave(function() {  
                            $(this).find("ul").stop(true, true).slideUp();  
                        });  
                    }  
                });
                 
            });
   
        </script>
  </head>

  <body>
	<div id="top_wrapper">

    <div id="top_wrapper_inner">

        <div id="top_wrapper_inner_left">
            <a href="http://www.theresumebuilder.com"><img src="<?php print IMAGES;?>/logo.png" alt=""  /></a>

        </div>

        <div id="top_wrapper_inner_right">
            <nav id="topNav"> 
            <ul>

                       <li><a href="http://www.theresumebuilder.com">HOME</a></li>                               
                       
                       <li><a href="http://www.theresumebuilder.com/about">ABOUT</a></li>                               
                       
                       <li><a href="http://www.theresumebuilder.com/blog">BLOG</a></li>                              
                       
                       <li><a href="http://www.theresumebuilder.com/jobs">JOBS</a></li>                               
                       
                       <li><a href="http://www.theresumebuilder.com/plans">PLANS</a></li>                              
                       
                       <li><a href="http://www.theresumebuilder.com/contact">CONTACT US</a></li>                               
                       
                </ul>
                </nav>  


            </div>

            <div id="top_wrapper_inner_right_image">
                <?php if ($_SESSION['user_id'] != 0) { ?>

                    <span id="login_as" style=" display: block; float: right;" >
                        <br/>
                        <span style="margin-top:4px;position: absolute;margin-left: -70px;">
                            Hi, <?php echo $_SESSION['username']; ?> </span> &nbsp;&nbsp;
                        <span>
                            <img src="<?php print IMAGES;?>/logout.png" style="cursor: pointer;" id="logout" value="LOGOUT">
                        </span>
                    </span>
                    <img src="<?php print IMAGES;?>/top_button.png" alt="" id="register" style="cursor: pointer;"/>
                <?php } else { ?>
                    <img src="<?php print IMAGES;?>/top_button.png" alt="" id="register" style="cursor: pointer;margin-top:47px;"/>
                <?php } ?>
        </div>


    </div>


</div><!--end_top_wrapper-->

  <div id="full_wrapper">

            <div id="top_wrapper">