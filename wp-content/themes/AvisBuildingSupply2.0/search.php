<?php get_header(); ?>
<div class="body-bg">
	<div class="container">
    	<div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <?php get_sidebar()?>			
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                <div id="content-block">	
                    <h1 class="s-results">Search Result for <?php /* Search Count */ $allsearch = &new WP_Query("s=$s&showposts=-1"); $key = wp_specialchars($s, 1); $count = $allsearch->post_count; _e(''); _e('<span class="search-terms">'); echo $key; _e('</span>'); _e(' &mdash; '); echo $count . ' '; _e('articles'); wp_reset_query(); ?></h1>
                
                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
                    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                
                        <div class="content-block">
                
                            <?php $title = get_the_title(); $keys= explode(" ",$s); $title = preg_replace('/('.implode('|', $keys) .')/iu', '<strong class="search-excerpt">\0</strong>', $title); ?>
                            <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><strong><?php echo $title; ?></strong></a>
                            <br />
                
                            <div class="entry-content">
                                <?php the_excerpt(); ?>
                            </div>
                
                        </div><!-- /content-block -->
                    </div><!-- #post-## -->
                
                    <?php endwhile; else: ?>
                        <div class="content-block">
                            <h2>Sorry, that page doesn't seem to exist.</h2>
                            <?php get_search_form(); ?>
                        </div>
                
                    <?php endif; ?>
                    <?php wp_reset_query(); ?>
                
                    <span class="clear"></span>
                </div>      
            </div>
		</div>
	</div>
</div>
		
<?php get_footer(); ?>