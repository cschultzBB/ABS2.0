<?php

/* Template Name: Contact Page */

get_header(); ?>

<div class="maps-box">
		<a href="<?php if (function_exists('contact_detail')) { contact_detail('google_maps'); } ?>" target="_blank"  itemprop=”maps”><img src="<?php bloginfo('template_url'); ?>/i/map.png" alt="google-maps" class=""/></a>
</div>
<div class="body-bg">
    <div class="container" id="b-container">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5" id="contact-sidebar">
                        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
                            <div class="content-block">
                                <?php if ( has_post_thumbnail() ) { ?>
                                        <div class="page-thumbnail">
                                            <?php the_post_thumbnail(array(400,400)); ?>
                                        </div>   
                                <?php } ?>
                                <?php the_content(); ?>
                                <div itemscope itemtype="http://schema.org/Dentist">
                                <?php 
                                    $contact_fax = contact_detail('fax', '' , '', false);
                                    $contact_line1 = contact_detail('address_line_1', '' , '', false);
                                    $contact_line2 = contact_detail('address_line_2', '' , '', false);
                                    $contact_city = contact_detail('address_city', '' , '', false);
                                    $contact_state = contact_detail('address_state', '' , '', false);
                                    $contact_zipcode = contact_detail('address_zipcode', '' , '', false);
                                    $phone_new = contact_detail('phone_new', '' , '', false);
                                    $phone_current = contact_detail('phone_current', '' , '', false);
    
                                    $hours_sunday = contact_detail('sunday_hours', '' , '', false);
                                    $hours_monday = contact_detail('monday_hours', '' , '', false);
                                    $hours_tuesday = contact_detail('tuesday_hours', '' , '', false);
                                    $hours_wednesday = contact_detail('wednesday_hours', '' , '', false);
                                    $hours_thursday = contact_detail('thursday_hours', '' , '', false);
                                    $hours_friday = contact_detail('friday_hours', '' , '', false);
                                    $hours_saturday = contact_detail('saturday_hours', '' , '', false);
                                    
                                    $hours_sunday_schema = contact_detail('sunday_hours_schema', '' , '', false);
                                    $hours_monday_schema = contact_detail('monday_hours_schema', '' , '', false);
                                    $hours_tuesday_schema = contact_detail('tuesday_hours_schema', '' , '', false);
                                    $hours_wednesday_schema = contact_detail('wednesday_hours_schema', '' , '', false);
                                    $hours_thursday_schema = contact_detail('thursday_hours_schema', '' , '', false);
                                    $hours_friday_schema = contact_detail('friday_hours_schema', '' , '', false);
                                    $hours_saturday_schema = contact_detail('saturday_hours_schema', '' , '', false);
                                ?>
                                <address itemscope itemtype="http://schema.org/PostalAddress">
                                    <span itemprop="description" class="contact-name"><?php bloginfo('description'); ?></span><br/>
                                    <span itemprop="name" class="contact-subname"><?php bloginfo('name'); ?></span>
                                    <div itemprop="address" itemtype="http://schema.org/PostalAddress">
                                        <span itemprop="streetAddress"><?php echo $contact_line1; ?>
                                        <?php
                                            if (!empty($contact_line2)) {
                                                echo '<br/>'.$contact_line2;	
                                            }
                                        ?></span><br/>
                                        <span itemprop="addressLocality"><?php echo $contact_city; ?></span>,
                                        <span itemprop="addressRegion"><?php echo $contact_state; ?></span>
                                        <span itemprop="postalCode"><?php echo $contact_zipcode; ?></span>
                                    </div>
                                </address>
                                <address>
                                    <?php if (!empty($phone_new)) : ?>
                                        New Patients: <span itemprop="telephone"><strong><?php echo $phone_new; ?></strong></span><br/>
                                    <?php endif; ?>
                                    <?php if (!empty($phone_new)) : ?>
                                        Current Patients:
                                    <?php else: ?>
                                        Phone:
                                    <?php endif; ?>
                                        <span itemprop="telephone"><strong><?php echo $phone_current; ?></strong></span>
                                </address>
                                <?php if (!empty($contact_fax)) : ?>
                                    <address>
                                        <span itemprop="faxNumber">Fax: <strong><?php echo $contact_fax; ?></strong></span>
                                    </address>
                                <?php endif; ?>
                                <address>
                                    <span class="contact-hours">Store Hours</span><br/>
                                    <?php if (!empty($hours_sunday)) : ?>
                                        <meta itemprop="openingHours" content="Su <?php echo $hours_sunday_schema; ?>">Sun: <strong><?php echo $hours_sunday; ?></strong><br/>
                                    <?php endif; ?>
                                    <?php if (!empty($hours_monday)) : ?>
                                        <meta itemprop="openingHours" content="Mo <?php echo $hours_monday_schema; ?>">Mon: <strong><?php echo $hours_monday; ?></strong><br/>
                                    <?php endif; ?>
                                    <?php if (!empty($hours_tuesday)) : ?>
                                        <meta itemprop="openingHours" content="Tu <?php echo $hours_tuesday_schema; ?>">Tue: <strong><?php echo $hours_tuesday; ?></strong><br/>
                                    <?php endif; ?>
                                    <?php if (!empty($hours_wednesday)) : ?>
                                        <meta itemprop="openingHours" content="We <?php echo $hours_wednesday_schema; ?>">Wed: <strong><?php echo $hours_wednesday; ?></strong><br/>
                                    <?php endif; ?>
                                    <?php if (!empty($hours_thursday)) : ?>
                                        <meta itemprop="openingHours" content="Th <?php echo $hours_thursday_schema; ?>">Thu: <strong><?php echo $hours_thursday; ?></strong><br/>
                                    <?php endif; ?>
                                    <?php if (!empty($hours_friday)) : ?>
                                        <meta itemprop="openingHours" content="Fr <?php echo $hours_friday_schema; ?>">Fri: <strong><?php echo $hours_friday; ?></strong><br/>
                                    <?php endif; ?>
                                    <?php if (!empty($hours_saturday)) : ?>
                                        <meta itemprop="openingHours" content="Sa <?php echo $hours_saturday_schema; ?>">Sat: <strong><?php echo $hours_saturday; ?></strong><br/>
                                    <?php endif; ?>
                                </address>
                                </div>
                            </div>
                        <?php endwhile; endif; ?>
                        <?php wp_reset_query(); ?>
                </div>
                <div class="col-lg-7  col-md-7 col-sm-7 entry-content" id="c-container">
                    <div class="content-block">
                        <?php echo do_shortcode('[gravityform id="1" name="Contact Us" title="false" description="true"]'); ?><br/><br/>
                    </div>
                </div>
          </div>
    </div>
</div>
<?php get_footer(); ?>