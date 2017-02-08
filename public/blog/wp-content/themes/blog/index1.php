
<?php get_header(); ?>            

             <div id="banner" style="background:url(<?php print IMAGES;?>/abt_banner.png) no-repeat; background-size:100%;">

                    <div id="banner_text">
                        <h1>The Resume Builder Blog</h1>
                    </div>	

                </div><!--end_banner-->
                
                <div id="blog_middle_wrapper">

                    <div id="blog_middle_wrapper_inner">



                        <div id="blog_middle_wrapper_inner_left">

                          

                                <div id="onload_posts">

                       <?php if(have_posts()):while(have_posts()):the_post();?>
                     <a href="<?php the_permalink();?>">
                                        <div class="top_article" >


                                            <span class="blog_left"><?php the_post_thumbnail();?></span>

                                            <span class="blog_right">
                                                <h1 class="b_topic"><?php the_title();?></h1>
                                                
                                                      
                                                 <div class="date"><?php the_date('Y-m-d');?></div>


                                                <p class="b_text"><?php the_excerpt(); ?></p>

                                            
                                            </span>

                                           

                                            <p class="b_comment">Posted by <?php the_author(); ?>&nbsp;</p>
                                          <!--  <p class="b_images">Lable :<a href="#">images</a></p>-->
                                        </div>
                                     </a>
                                      <?php endwhile; endif;?> 
                                </div>


                      
                        

                        </div><!--end_blog_middle_wrapper_inner_left-->



                        <div id="blog_middle_wrapper_inner_right">

                            <div id="b_search">

                               <form role="search" action="<?php echo site_url('/'); ?>" method="get" id="searchform">
	      <div class="form-group">
	        <input id="s" type="text" class="form-control" placeholder="Search..." name="s">
                <input type="submit"  id="searchsubmit" class="top_search_btn" value="" />
	      </div>
	    </form>



                                <div class="blog_right_text">

                                    <h1>Popular Posts</h1>
                                    
<?php
                     $recentPosts = new WP_Query();
                     $recentPosts->query('showposts=2');
                   ?>

                    <?php while ($recentPosts->have_posts()) : $recentPosts->the_post(); ?>
                                        
                                       <a href="<?php the_permalink();?>"><?php the_title();?></a>
                                       <?php $excerpt = get_the_excerpt(); ?>
                                        <p><?php echo string_limit_words($excerpt,25); ?></p>
										 
										

  <?php endwhile; ?>

                                </div>

                                <h1 id="blog">Blog Archive</h1>
                                <ul>
			                       <?php wp_get_archives('type=monthly'); ?>
                                   
		                         </ul>



                            </div>



                        </div><!--end_blog_middle_wrapper_inner_right-->



                    </div><!--end_blog_middle_wrapper_inner-->


                </div>
                

<?php get_footer(); ?>

            </div><!--end_full_wrapper-->

    </body>
</html>
<script language="javascript">
    $(document).ready(function(){ 
                    
                                       
        $("#register").click(function () {
            
            window.location.href="http://www.theresumebuilder.com/create_user.php"; 
        });
                                               
        $("#logout").click(function () {
            
            window.location.href="http://www.theresumebuilder.com/logout.php"; 
        });
															
															
        $("#older_post").click(function () {
            
            $('#onload_posts').css("display", "none");
            $('#all_posts').css("display", "block");
            $('#older_post').css("display", "none");
															  
        });
        
    });
</script>




