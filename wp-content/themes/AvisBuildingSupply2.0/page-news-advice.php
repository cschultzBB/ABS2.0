<?php

/* Template Name: News & Advice Page */

get_header(); 

?>
<div class="body-bg">
    <div class="container">
      <div class="row">
          <div class="col-xs-12">
                  <?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <!-- Right Body Container -->
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> 
                    <div class="content-block">
                      <article id="post-<?php the_ID(); ?>" role="article" itemscope itemtype="http://schema.org/WebPage">
                          <header class="article-header">
                              <h1 class="page-title team-font" itemprop="headline">
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
                                  <ul class="post-content">
                                    <?php $the_query = new WP_Query( 'category_name=NewsAdvice&showposts=5' ); ?>
                                      <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
                                      <li class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
                                      <div class="upper-meta"><em><?php echo get_the_date(); ?></em></div>
                                      <p>
                                <?php if ( has_post_thumbnail() ) { ?>
                                      <?php the_post_thumbnail(array(200,200), array('class'=>'img-thumbnail pull-left margin-right')); ?>
                                <?php } ?><?php the_content(__('(more…)')); ?></p>
                                      <hr class="clear">
                                    <?php endwhile;?>
                                  </ul>
                            </section>
                        </article>
                    </div>      
                <?php endwhile; else: ?>    
                    Sorry, there may have been a problem.
                    <?php get_search_form(); ?>
                <?php endif; ?>
                <?php wp_reset_query(); ?>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
              <div class="content-block">
                  <aside>
                    <?php get_sidebar('sidebar')?>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>