<!doctype html>
<html>
<head>
<meta charset="utf-8">

<!--<meta http-equiv="X-UA-Compatible" content="IE=edge"/>-->

<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<?php

$title = 'The Resume Builder';

if ( ! is_home() )
{
	if ( is_archive() )
	{
		$my_month = single_month_title(' ', false);
		$title = 'Archive -'.$my_month.' | The Resume Builder';
	}
	else
	{
		$title = get_the_title();
	}
}

?>
    
<title><?php print $title; ?></title>
    
    <?php
        $metaDesc = get_the_excerpt();
        if ( trim($metaDesc) == '' )
        {
            $metaDesc = "The Resume Builder allows you to create your resumes in just 15 mins. Paid & free resumes, samples, templates available. Build your resume with our online resume builder now.";
        }

        // keywords
        global $post;
        $t = wp_get_post_tags($post->ID);

        if ( count($t) > 0 )
        {
            $kwrds = '';
            foreach ( $t as $tg )
            {
                $kwrds .= $tg->name;
                $kwrds .=', ';
            }
        }
        else
        {
            $kwrds = 'The Resume Builder, create a resume, free resumes, free resume builder, online resume builder, resume templates';
        }

        $tags = get_tags();

        if ( count($tags) > 0 )
        {
            $metaKeywords = '';
            foreach ( $tags as $tag )
            {
                $metaKeywords .= $tag->name;
                $metaKeywords .= ', ';
            }
        }
        else
        {
            $metaKeywords = 'The Resume Builder, create a resume, free resumes, free resume builder, online resume builder, resume templates';
        }

    ?>
    
<meta name="description" content="<?php print $metaDesc; ?>" />

<meta name="keywords" content="<?php print $kwrds; ?>" />

<link href="<?php echo THEMEROOT ?>/css/bootstrap.css" rel="stylesheet" type="text/css">

<link href="<?php echo THEMEROOT ?>/css/master.css" rel="stylesheet" type="text/css">

<link rel="shortcut icon" href="<?php echo THEMEROOT ?>/images/fevicon.png"/>

<link rel="apple-touch-icon" href="<?php echo THEMEROOT ?>/images/fevicon.png"/>

<link rel="shortcut icon" type="<?php echo THEMEROOT ?>/image/ico" href="images/fevicon.png"/>

<link rel="icon" href="<?php echo THEMEROOT ?>/images/fevicon.png" type="image/ico"/>
<!-- Google Analytics -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-2023709-1', 'auto');
  ga('send', 'pageview');
</script>	
</head>

<body>
<?php echo bloginfo('template_url'); ?>
<div class="row row_clr top_wrapper">

	<div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="http://www.theresumebuilder.com/"><img src="<?php echo THEMEROOT ?>/images/logo.png" alt="" class="img-responsive"/></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right main_nav">
            <li><a href="http://www.theresumebuilder.com/" id="">HOME</a></li>
            <li><a href="http://www.theresumebuilder.com/about" id="">ABOUT</a></li>
            <li><a href="http://www.theresumebuilder.com/blog/" id="">CAREER TIPS</a></li>
            <li><a href="http://www.theresumebuilder.com/plans" id="">PLANS</a></li>
            <li><a href="http://www.theresumebuilder.com/contact" id="">CONTACT US</a></li>
             <li><a href="http://www.theresumebuilder.com/resume/create#/" id=""><img src="<?php echo THEMEROOT ?>/images/nav_btn_1.png" alt="" class="img-responsive"/></a></li>
             <li><a href="http://www.theresumebuilder.com/user/create" id=""><img src="<?php echo THEMEROOT ?>/images/nav_btn_2.png" alt="" class="img-responsive"/></a></li>
          </ul>
          
        </div><!--/.nav-collapse -->
      </div>
    </div>

</div><!--end top_wrapper-->