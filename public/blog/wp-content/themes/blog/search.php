
<?php get_header(); ?>            

            
             <div class="row row_clr banner_full">
                <h2>Career Tips</h2>
                <p>Resume writing tips, career advice and more... </p>
            </div><!--end banner_full-->
                
                <div class="row row_clr blog_full">
	
                <div class="container">
                    
                    <div class="page_title searchtitle search_new_title">Search Results for - "<?php echo $_GET['s'];?>"</div>

                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 blog_left">

                          

                           <div class="row row_clr">
            	
                             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 blog_detail">
                                 <?php if ( have_posts() ) : ?>
                                    
                                    <?php while ( have_posts() ) : the_post(); ?>
                                    <div class="row row_clr blog_search_single">
                                        
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 blog_search_left">
                                           <?php the_post_thumbnail(array('class'=>'img-responsive'));?>
                                        </div><!--end blog_search_left-->
                                        
                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 blog_search_right">
                                            <h1 class="b_topic"><?php the_title();?></h1>
                                            <div class="date"><?php the_date('Y-m-d');?></div>
                                                <p class="b_text"><?php the_excerpt(); ?></p>
                                                <a href="<?php the_permalink();?>"><h1><img src="<?php print IMAGES;?>/read_more.png" alt="" /></h1></a>
                                        </div><!--end blog_search_right-->
                                        
                                    </div><!--end blog_search_single-->  
                                    <?php endwhile; ?> 
                                      
                                      
                                      <?php else : ?>

                                <div class="post_noresults">No any Results for : <?php echo get_search_query() ?></div>

                                <?php endif; ?>
                             </div><!--blog_detail-->
                               
                          </div><!--end row row_clr-->  


                        

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



                    </div><!--end_blog_middle_wrapper_inner-->


                </div>
                

<?php get_footer(); ?>





