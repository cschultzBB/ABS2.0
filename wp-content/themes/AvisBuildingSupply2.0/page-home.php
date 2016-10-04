<?php 
    /*
    * Template Name: Main Home
    */ 
?>
<?php get_header(); ?>
<div class="main-content cs-fc cs-fw cs-jc">
    <div id="hp-welcome" class="cs-fc cs-jc full-width">
        <a class="half hp-btn home-owners" href="<?php echo home_url(); ?>/home-owners" >
            <img src='<?php bloginfo("stylesheet_directory"); ?>/img/home-owner.jpg' alt="Home Owner">
            <div class="overlay">
                <p>Home Owners</p>
            </div>
        </a>
        <a class="half hp-btn contractors" href="<?php echo home_url(); ?>/contractors">
            <img src='<?php bloginfo("stylesheet_directory"); ?>/img/contractor.jpg' alt="Contractors">
            <div class="overlay">
                <p>Contractors</p>
            </div>
        </a>
    </div>
    <div id="event-wrapper" class="cs-fcc cs-jc full-width">
        <div id="event-header" class="cs-fc cs-jc">
            <h1>Events</h1>
        </div>
        <div id="event-scroller" class="cs-fc cs-jc">
            <?php
                $i = 1;
                $time = date(Ymd);
                $time = (int)$time; 
            ?>
            <?php $page_query = new WP_Query('post_type=promos&order=ASC'); ?>
            <?php while ($page_query->have_posts()) : $page_query->the_post(); ?>
            <?php 
                $startdate = get_field('start_date');
                $enddate = get_field('end_date'); 
                $pdf = get_field('pdf');
            ?>
            <?php if(($time >= $startdate) && ($time <= $enddate)){ ?>
                <div class="event">
                    <?php the_post_thumbnail('medium', array('class' => 'event-bg'));?>
                    <a href="<?php the_permalink();?>">
                        <div class="event-overlay">
                                <p class="event-title"><?php the_title(); ?></p>
                                <p class="event-cap"><?php the_excerpt(); ?></p>
                        </div>
                    </a>
                </div>
            <?php }  else {?>
                <div class="">
                    <h1>There are Currently no events, Please come back soon...</h1>
                </div>
            <?php } ?>
            <?php endwhile; ?>
            <?php wp_reset_query(); ?> 
        </div>
    </div>
    <?php 
        $i = 1;
        $args = array('post_type'=>'flyer', 'posts_per_page'=> -1, 'order'=>'ASC' );
        $loop = new WP_Query($args);
        $time = date(Ymd);
        $time = (int)$time; 
    ?>
    <?php if($loop -> have_posts()) : while ($loop -> have_posts()) : $loop->the_post(); ?>
        <?php 
            $startdate = get_field('start_date');
            $enddate = get_field('end_date'); 
            $pdf = get_field('pdf');
        ?>
        <?php if(($time >= $startdate) && ($time <= $enddate)){ ?>
            <div id="flyer" class="cs-fc cs-jc">
                <a class="flyer-btn" href="<?php echo $pdf;?>" target="_blank" title="<?php the_title();?>">
                    <h1><?php the_title();?></h1>
                </a>
            </div>
        <?php $i++; ?>
        <?php } ?>
    <?php endwhile; ?>
    <?php endif; ?>
    <?php wp_reset_query(); ?>
</div>
<?php get_footer(); ?>