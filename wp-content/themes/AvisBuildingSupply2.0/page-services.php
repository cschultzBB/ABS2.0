<?php

/* Template Name: Services Page */

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
                                    <?php the_post_thumbnail(array(200,200),array('class' => 'img-responsive img-thumbnail pull-right margin-left')); ?>
                              <?php } ?>
                              
                              <?php the_content(); ?>
                              
                              <?php endwhile; else: ?>
                  
                                  Sorry, there may have been a problem.
                  
                                  <?php get_search_form(); ?>
                    
                              <?php endif; ?>
                              <?php wp_reset_query(); ?>
                          </section>
                          <section>
                            <div class="row services-tabs">
                              <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                  
                                  <ul class="nav nav-pills nav-stacked">
                                  <?php $page_query = new WP_Query('post_type=page&post_parent='.$post->ID.'&order=ASC'); ?>
                                  <?php $j = 0; ?>
                                  <?php while ($page_query->have_posts()) : $page_query->the_post(); ?>
                                      <li <?php if ($j == 0) { echo 'class="active"'; } ?>><a href="#<?php echo $post->post_name; ?>" data-toggle="pill"><?php the_title(); ?> <span class="glyphicon glyphicon-chevron-right pull-right"></span></a></li>
                                  <?php $j++; endwhile; ?>
                                  </ul>
                                  <?php wp_reset_query(); ?>
                              </div>
                              <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                  <?php $k = 0; ?>
                                  <div class="tab-content well well-small services-well">
                                  <?php $page_query = new WP_Query('post_type=page&post_parent='.$post->ID.'&order=ASC'); ?>
                                  <?php while ($page_query->have_posts()) : $page_query->the_post(); ?>
                                    <div class="tab-pane <?php if ($k == 0) { echo 'active'; } ?>" id="<?php echo $post->post_name; ?>">
                                      <h3><?php the_title(); ?></h3>
                                      <?php the_content(); ?>
                                    </div>
                                  <?php $k++; endwhile; ?>
                                  </div>
                                  <?php wp_reset_query(); ?>
                              </div>
                            </div>
                         </section>
                    </article>
                </div>			
            </div>
  		</div>
  	</div>
</div>
<?php get_footer(); ?>