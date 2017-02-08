
<?php get_header(); ?>            

             <div class="row row_clr banner_full">
                <h2>Career Tips</h2>
                <p>Resume writing tips, career advice and more... </p>
            </div><!--end banner_full-->
                
              <div class="row row_clr blog_full">
	
                <div class="container">



                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 blog_left">
                            <div class="row row_clr">
            	
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 blog_detail">
                <?php if(have_posts()):while(have_posts()):the_post();?>	
                    <div class="row row_clr blog_detail_full">
                    
                    	<div class="row row_clr blog_detail_head">
                             <h3><?php the_title();?></h3>
                             <p><?php the_date('Y-m-d');?> by  <span><?php the_author(); ?></span></p>
                                    
                        </div>
                        <div class="row row_clr blog_detail_content">
                        	<?php 
                             $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );
                             ?>
                             <img src="<?php echo $image[0] ; ?>" class="img-responsive" />
                            <?php // the_post_thumbnail(array( 'class'	=> "img-responsive")); ?>
<!--                            <img src="images/blog_detail.png" alt="" class="img-responsive"/>-->
                        
                        	<p class="b_text"><?php the_content();?></p> 
                            
                        </div><!--end blog_detail_content-->
                        
                    	
                    </div><!--end blog_detail_full-->
                    
                   <?php endwhile; endif;?>  
                
                </div><!--end blog_detail-->	
            
            </div><!--end row row_clr-->

                        <?php //if(have_posts()):while(have_posts()):the_post();?>
<!--
                            <div class="top_article">


                                <span class="blog_left">//<?php the_post_thumbnail();?></span>

                                <span class="blog_right">
                                    <h1 class="b_topic">//<?php the_title();?></h1>


                                    <div class="date">//<?php the_date('Y-m-d');?></div>
                                    <p class="b_text">//<?php the_content();?></p>

                                    

                                </span>


                                <p class="b_comment">Posted by <a href="#">//<?php the_author(); ?></a>&nbsp;</p>
                                <p class="b_images">Lable :<a href="#">images</a></p>
                            </div>-->
                           <?php //endwhile; endif;?> 

                        </div><!--end_blog_middle_wrapper_inner_left-->



                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 blog_right">
        	
                        <div class="row row_clr">

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 blog_right_inner">
                                <form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                    <div class="row row_clr blog_search">
                                    <input type="text" placeholder="SEARCH" value="<?php echo get_search_query(); ?>" name="s" id="s"/>
                                    <input type="submit" value="" style="background-image:url(<?php echo THEMEROOT ?>/images/serach.png);"  id="searchsubmit" alt="" />
                                    </div><!--end blog_search-->
                                </form>
                                <div class="row row_clr populer_post_full">

                                    <div class="row row_clr populer_post_head">
                                            <h2>POPULAR POSTS</h2>
                                    </div><!--end populer_post_head-->
                                    <?php
                                    $recentPosts = new WP_Query();
                                    $recentPosts->query('showposts=4');
                                    
                                    ?>
                                    <?php while ($recentPosts->have_posts()) : $recentPosts->the_post(); ?>
                                    <div class="row row_clr populer_post_single">
                                        <a href="<?php the_permalink();?>">    
                                        <h3><?php the_title();?></h3>
                                        </a>
                                        <p><?php the_date('Y-m-d');?> by <span><?php the_author(); ?></span></p>
                                    </div><!--end populer_post_single-->
                                    <?php endwhile;?> 


                                </div><!--end populer_post_full-->

                                <div class="row row_clr blog_archive_full">

                                    <div class="row row_clr blog_archive_head">
                                            <h2>Blog Archive</h2>
                                    </div><!--end populer_post_head-->

                                    <div class="row row_clr blog_archive_content">
                                        <?php
                                         $recentPosts = new WP_Query();
                                         $recentPosts->query('showposts=2');
                                       ?>
                                            <ul>
                                                <?php wp_get_archives('type=monthly'); ?>
                                        </ul>
                                    </div><!--end blog_archive_content-->

                                </div><!--end blog_archive_full-->





                            </div><!--end blog_right_inner-->

                        </div><!--end row row_clr-->

                    </div><!--end blog_right-->
                </div>     
                    
                      
        </div>

<?php get_footer(); ?>

     




