<?php
    /*
     *
     * Template Name: Home Owners 
     *
    */

get_header(); ?>
<div class="main-content">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" role="article" itemscope itemtype="http://schema.org/WebPage" class="max-width">
        <header class="article-header">
            <h1 class="page-title" itemprop="headline">
              <?php the_title();?>
            </h1>
        </header>
        <section itemprop="articleBody">
            <?php the_content(); ?>
            <?php endwhile; endif; ?>
            <?php wp_reset_query(); ?>
        </section>
    </article> 
    <section id="subpage-tiles">
        <div class="tiles-row cs-fc cs-jc cs-fw" data-tiles="2">
            <?php
            $i = 1;
            ?>
            <?php $page_query = new WP_Query('post_type=page&post_parent='.$post->ID.'&post_per_page=-1&order=ASC&orderby=menu_order'); ?>
            <?php while ($page_query->have_posts()) : $page_query->the_post(); ?>
            <a href="<?php echo the_permalink();?>" class="page-tile" data-tile="<?php echo $i;?>">
                <?php the_post_thumbnail('full' ,array( 'class'=>'tile-img')); ?>
                <h1><?php the_title();?></h1>
            </a>
            <?php $i++; ?>
            <?php endwhile; ?>
        </div>
            <?php wp_reset_query(); ?> 
    </section>
</div>
		
<?php get_footer(); ?>