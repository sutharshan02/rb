
<?php get_header(); ?>            

             <div class="row row_clr banner_full">
                <h2>Career Tips</h2>
                <p>Resume writing tips, career advice and more... </p>
            </div><!--end banner_full-->

                        <?php 
                            
                            $i=0; $arrayArch = array(); 

                            if (have_posts()) : while (have_posts()) : the_post();

                                $arrayArch[$i]['link'] = get_permalink();

                                $arrayArch[$i]['thumb'] = wp_get_attachment_url(get_post_thumbnail_id());
                                $arrayArch[$i]['title'] = get_the_title();
                                $arrayArch[$i]['date'] = get_the_date();
                                $arrayArch[$i]['author'] = get_the_author();
                           
                                $i++;

                            endwhile; endif;

                        ?>
                
             <div class="row row_clr blog_full">
	
                <div class="container">

                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 blog_left">
                    
                    <!--p><?php print count($arrayArch); ?></p-->
                        
                        <?php
                        	$j = 0;
							$k = 1; 
							$n = count($arrayArch);
							$m = round($n/2);
						?>
                        
                        <?php for ( $x=0; $x<$m; $x++ ) { ?>
                        
                                <div class="row row_clr blog_row">
                                    
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 blog_single_1">
                                        
                                        <div class="row row_clr">
                                         	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 blog_single_inner">
                                            	<a href="<?php print $arrayArch[$j]['link'];  ?>">
                                                	<img src="<?php print $arrayArch[$j]['thumb']; ?>" />
                                             	</a>
                                             <h2><a href="<?php print $arrayArch[$j]['link']; ?>"><?php print $arrayArch[$j]['title'];  ?></a></h2>    
                                             <p><?php print $arrayArch[$j]['date']; ?> by <span><?php print $arrayArch[$j]['author']; ?></span></p>
                                            </div>       

                                        </div>
                                        
                                    </div>
                                    
                           			<?php if( ! ($n&1) ) { ?>
                            
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 blog_single_1">
                                        
                                        <div class="row row_clr">
                                             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 blog_single_inner">
                                             	<a href="<?php print $arrayArch[$k]['link'];  ?>">
                                                 <img src="<?php print $arrayArch[$k]['thumb']; ?>" />
                                                 </a>
                                                 <h2><a href="<?php print $arrayArch[$k]['link'];  ?>"><?php print $arrayArch[$k]['title'];  ?></a></h2>    
                                                 <p><?php print $arrayArch[$k]['date'];  ?> by <span><?php print $arrayArch[$k]['author'];  ?></span></p>
                                                </div>       

                                        </div>
                                    
                                    </div>
                                    
                            		<?php } ?>
                                    
                                </div>
                        
                                <?php $j = $j + 2; $k = $k + 2; ?>
                        
                        <?php } ?>
                        
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