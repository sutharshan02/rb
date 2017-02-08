
<?php get_header(); ?>            

             <div class="row row_clr banner_full">
                <h2>Career Tips</h2>
                <p>Resume writing tips, career advice and more... </p>
            </div><!--end banner_full-->
                
             <div class="row row_clr blog_full">
	
                <div class="container">

                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 blog_left">
                                    <?php
                         $_count = 0;
                         $projects = query_posts( $args);
                        
                         $project_count = count(query_posts( $args));
                          
                         $last = $project_count - 1;
                         
                         foreach($projects as $project){
                            $user_id = get_user_by('id', $project->post_author ); 
                            $img =wp_get_attachment_image_src( get_post_thumbnail_id( $project->ID ), 'single-post-thumbnail' );
                             
                             if($_count==0){
                                  $html .= "<div class=\"row row_clr blog_row\">";
                                } else if ($_count != 0 && $_count % 2 == 0) {
                                    $html .= '</div><div class="row row_clr blog_row">';
                                }    

                                $html .='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 blog_single_1">
                                              <div class="row row_clr">
                                                 <a href="#">
                                                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 blog_single_inner">   
                                                     <a href="'.get_permalink($project->ID).'">
                                                     <img src="'.$img[0].'" alt="" class="img-responsive" />
                                                     </a>
                                                     <h2><a href="'.get_permalink($project->ID).'">'.$project->post_title.'</a></h2>    
                                                     <p>'.$project->post_date.' by <span>'.$user_id->display_name.'</span></p>
                                                    </div>       
                                                </a>
                                              </div>       
                                        </div>';

                                if ($last == $_count) {
                                 $html .= '</div>';
                                }
                                $_count++;  
                                 
                         }
                         echo $html;
                         
                         
                         ?>
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




