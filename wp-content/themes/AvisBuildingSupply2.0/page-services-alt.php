<?php

/* Template Name: Services Panel Page */

get_header(); ?>
<div class="body-bg">
	<div class="container">
    	<div class="row">
        	<div class="col-xs-12">
            	<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>
            </div>
        </div>
    	<div class="row">
            <div class="col-xs-12">
            	<div class="content-block">
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
                                
                                <!-- End Page Content -->
                                <?php endwhile; else: ?>
                    
                                    Sorry, there may have been a problem.
                    
                                    <?php get_search_form(); ?>
                    
                                <?php endif; ?>
                                <?php wp_reset_query(); ?>
                             </section>
                
                                <?php $page_query = new WP_Query('post_type=page&post_parent='.$post->ID.'&order=ASC'); ?>
                                <?php while ($page_query->have_posts()) : $page_query->the_post(); ?>
                                <div class="row services-tabs">
                                    <div class="col-xs-12">
                                        <div class="panel panel-warning">
                                              <div class="panel-heading">
                                                  <h3 class="panel-title"><?php the_title(); ?></h3>
                                              </div>
                                              <div class="panel-body">
                                                  <?php the_content(); ?>
                                              </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endwhile; ?>
                                <?php wp_reset_query(); ?>
                    
                 </div>			
            </div>
  		</div>
  	</div>
</div>
<?php get_footer(); ?>