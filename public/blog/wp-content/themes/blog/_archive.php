
<?php get_header(); ?>            

             <div class="row row_clr banner_full">
                <h2>Career Tips</h2>
                <p>Resume writing tips, career advice and more... </p>
            </div><!--end banner_full-->
                
             <div class="row row_clr blog_full">
	
                <div class="container">

                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 blog_left">
                        
                        <?php $i=0; ?>
                        
                        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        
                            <?php $i++; ?>
                            <?php $modval = (int) $i % 2; ?>
                        
                                <div class="row row_clr blog_row">
                                    
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 blog_single_1">
                                        
                                        <div class="row row_clr">
                                         <a href="#">
                                          </a><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 blog_single_inner"><a href="#">   
                                             </a><a href="<? the_permalink();  ?>">
                                            <?php the_post_thumbnail(); ?>
                                             </a>
                                             <h2><a href="<? the_permalink();  ?>"><?php the_title(); ?></a></h2>    
                                             <p><?php the_date(); ?> by <span><?php the_author();?></span></p>
                                            </div>       

                                        </div>
                                        
                                    </div>
                                    
                                    <!--div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 blog_single_1">
                                        
                                        <div class="row row_clr">
                                             <a href="#">
                                              </a><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 blog_single_inner"><a href="#">   
                                                 </a><a href="<? the_permalink();  ?>">
                                                 <?php the_post_thumbnail(); ?>
                                                 </a>
                                                 <h2><a href="<? the_permalink();  ?>"><?php the_title(); ?></a></h2>    
                                                 <p><?php the_date(); ?> by <span><?php the_author();?></span></p>
                                                </div>       

                                        </div>
                                    
                                    </div-->
                                    
                                </div>
                        
                        <?php endwhile; endif; ?>
                        
                    </div>
                    
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