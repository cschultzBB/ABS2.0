<?php

/* Template Name: Services (Main) */

get_header(); ?>
<div class="body-bg">
	<div class="container">
        <div class="main-body">
            <div class="row">
              	<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-md-push-3">
                    <div class="content-block">
                      <?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>
                      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                          <article id="post-<?php the_ID(); ?>" role="article" itemscope itemtype="http://schema.org/WebPage">
                        	<header class="article-header">
                            	<h1 class="page-title" itemprop="headline">
								  <?php
                                    if(get_field('custom_page_headline_(h1)')) {
                                          the_field('custom_page_headline_(h1)');
                                    } else {
                                          the_title();
                                    }
                                  ?>
                                </h1>
                            </header>
                            <section itemprop="articleBody">
                                  <?php
                                    if(get_field('page_sub-headline_(h2)')) {
                                      echo '<h2>';
                                          the_field('page_sub-headline_(h2)');
                                      echo '</h2>';
                                    }
                                  ?>
                                  <?php if ( has_post_thumbnail() ) { ?>
                                          <div class="pull-right margin-left visible-lg">
                                              <?php the_post_thumbnail(array(200,200),array('class' => 'img-circle img-bordered')); ?>
                                          </div><!-- /page-thumbnail -->
                                  <?php } ?>
                                  <!-- End Thumbnail Loop -->
									<?php the_content(); ?>

                                  <?php endwhile; else: ?>
                                      
                                    Sorry, there may have been a problem.
                                  
                                    <?php get_search_form(); ?>
                                  
                                  <?php endif; ?>
                                  <?php wp_reset_query(); ?>
                          </section>
                           
						  <?php
                                $i = 1;
                                $num_per_row = 1;
                          ?>
                          <?php $page_query = new WP_Query('post_type=page&post_parent='.$post->ID.'&order=ASC'); ?>
                          
                          <?php while ($page_query->have_posts()) : $page_query->the_post(); ?>
                          <section>
                              <div class="row services-row">
                                    <div class="col-xs-12 col-sm-12 col-md-<?php echo 12/$num_per_row; ?> col-lg-<?php echo 12/$num_per_row; ?>">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <div class="panel-title"><a href="<?php the_permalink();?>"><?php the_title(); ?><div class="pull-right"><span class="glyphicon glyphicon-chevron-right"></span></div></a></div>  
                                            </div>
                                            <div class="panel-body">
                                                <?php $inner_parent = $post->ID; ?>
                                                <?php $child_query = new WP_Query('post_type=page&post_parent='.$post->ID.'&order=ASC'); ?>
                                                <?php $count_child = $child_query->post_count; ?>
                                                <?php $child_per_column = ceil($count_child/2); ?>
                                                <?php $posts = 1; ?>
                                                <?php $columns = 1; ?>
                                                <div class="row">
                                                    <?php while ($child_query->have_posts()) : $child_query->the_post(); ?>
                                                        <?php if ($posts == 1) : ?>
                                                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                                                <ul>
                                                        <?php endif; ?>
                                                    
                                                            <li><a href="<?php echo get_the_permalink($inner_parent).'#'.$post->post_name;?>"><?php echo the_title(); ?></a></li>
                                                      
                                                        <?php if (($posts % $child_per_column == 0) || $columns == $count_child) : ?>
                                                                </ul>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php
                                                            if ($posts%$child_per_column == 0) {
                                                                $posts = 1;
                                                            } else {
                                                                $posts++;
                                                            }
                                                            $columns++
                                                        ?>
                                                    <?php endwhile; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                              </div>
                          </section>
                          <?php endwhile; ?>
                          
                          <?php wp_reset_query(); ?> 
                             </section>
                        </article> 
                   </div>          			
              	</div>
              	<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-md-pull-9">
                	<aside>
                  		<?php get_sidebar('sidebar')?>
                    </aside>
            	</div>
            </div>
        </div>
   	</div>
</div>
		
<?php get_footer(); ?>