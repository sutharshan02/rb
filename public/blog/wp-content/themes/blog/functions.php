<?php

define('THEMEROOT', get_stylesheet_directory_uri());
define('IMAGES', THEMEROOT . '/images');

/**************MENUS*******************/

function kbm_scripts() {

 wp_enqueue_script( 'hoverIntent', get_template_directory_uri() . '/js/navigation/hoverIntent.js', array(), '1.0.0', true );
 wp_enqueue_script( 'superfish', get_template_directory_uri() . '/js/navigation/superfish.js', array(), '1.0.0', true );
 
}

add_action( 'wp_enqueue_scripts', 'kbm_scripts' );

add_theme_support( 'post-thumbnails' ); 

add_image_size( 'p1', 82, 79, true );

add_image_size( 'p2', 55, 55, true );

function zilla_infinite_scroll_render() {  
        get_template_part( 'content-post', 'standard' );  
}  

add_theme_support( 'infinite-scroll', array(  
    'container' => 'primary',  
    'render'    => 'zilla_infinite_scroll_render',  
));

function string_limit_words($string, $word_limit)
{
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}


?>