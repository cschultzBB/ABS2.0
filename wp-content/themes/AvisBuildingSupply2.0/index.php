<?php get_header(); ?>
<div class="body-bg"><?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?><?php if ( have_posts() ) : while ( have_posts() ) : the_post();	 ?>
  <div class="content-block">
    <article id="post-<?php the_ID(); ?>" role="article" itemscope="itemscope" itemtype="http://schema.org/WebPage">
      <div class="article-header">
        <h1 class="page-title"></h1>
        <section class="article-body"><?php the_content();		 ?>
        </section>
      </div>
    </article>
  </div><?php endwhile; else:   ?>
  <p>Sorry, there may have been a problem.</p><?php get_search_form(); ?><?php endif; ?><?php wp_reset_query(); ?>
  <div class="content-block">
    <aside><?php get_sidebar('sidebar') ?>
    </aside>
  </div>
</div><?php get_footer(); ?>