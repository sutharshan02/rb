
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

                       <?php if ( have_posts() ) : ?>
 <div class="page_title searchtitle">Search Results for - "<?php echo $_GET['s'];?>"</div>
                <?php while ( have_posts() ) : the_post(); ?>
                     
                                        <div class="top_article" >


                                            <span class="blog_left"><?php the_post_thumbnail();?></span>

                                            <span class="blog_right">
                                                <h1 class="b_topic"><?php the_title();?></h1>
                                                
                                                      
                                                 <div class="date"><?php the_date('Y-m-d');?></div>


                                                <p class="b_text"><?php the_excerpt(); ?></p>

                                                <a href="<?php the_permalink();?>"><h1><img src="<?php print IMAGES;?>/read_more.png" alt="" /></h1></a> 
                                            </span>

                                           

                                            <p class="b_comment">Posted by <a href="#"><?php the_author(); ?></a>&nbsp;</p>
                                          <!--  <p class="b_images">Lable :<a href="#">images</a></p>-->
                                        </div>

                                      <?php endwhile; ?> 
                                      
                                      
                                      <?php else : ?>

            		<div class="post_noresults">No any Results for : <?php echo get_search_query() ?></div>

            <?php endif; ?>
                                </div>


                        <!--<a id="older_post" href="#">View Older Posts</a>-->
                        
                        <?php /*?><div id="all_posts">

                                    <?php if(have_posts()):while(have_posts()):the_post();?>
                     
                                        <div class="top_article" >


                                            <span class="blog_left"><?php the_post_thumbnail();?></span>

                                            <span class="blog_right">
                                                <h1 class="b_topic"><?php the_title();?></h1>
                                                
                                                      
                                                 <div class="date"><?php the_date('Y-m-d');?></div>


                                                <p class="b_text"><?php the_excerpt(); ?></p>

                                                <a href="<?php the_permalink();?>"><h1><img src="<?php print IMAGES;?>/read_more.png" alt="" /></h1></a> 
                                            </span>

                                           

                                            <p class="b_comment">Posted by <a href="#"><?php the_author(); ?></a>&nbsp;</p>
                                          <!--  <p class="b_images">Lable :<a href="#">images</a></p>-->
                                        </div>

                                      <?php endwhile; endif;?> 
                                </div><?php */?>
                        

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
            
            window.location.href="create_user.php"; 
        });
                                               
        $("#logout").click(function () {
            
            window.location.href="logout.php"; 
        });
															
															
        $("#older_post").click(function () {
            
            $('#onload_posts').css("display", "none");
            $('#all_posts').css("display", "block");
            $('#older_post').css("display", "none");
															  
        });
        
    });
</script>






