<!DOCTYPE html>
<html lang="en-US" class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=5.0"/>
    <title><?php wp_title(''); ?></title>
    <!-- Fav Icon -->
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/>
    <link rel="icon" href="/favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/favicon.ico"/>
    <!-- Google Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Ubuntu:400,700|Josefin+Sans:400,700,600i" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/flexbox.css"/>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/themes/smoothness/jquery-ui.css">
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>
    <script src="<?php bloginfo('stylesheet_directory'); ?>/js/js-cookie/src/js.cookie.js"></script>
    <script src="<?php bloginfo('stylesheet_directory'); ?>/js/scripts.js"></script>
    <?php wp_head(); ?>
    </head>
<body class="body-bg cs-fcc">
    <header id="gb-fixed-header" role="banner" class="cs-fc">
        <div id="gb-header-inner" class="cs-fc max-width">
            <div class="cs-fc logo">
                <a href="<?php echo home_url();?>">
                    <img src="<?php bloginfo('stylesheet_directory'); ?>/img/logo.png"/>
                </a>
            </div>
            <?php if(is_page_template('page-homeowner.php')): ?>
                <nav id="main-navigation" class="cs-fc">
                    <?php wp_nav_menu( array(
                        'theme_location'       => 'Home Owner',
                        'depth'      => 2,
                        'container'  => false,
                        'menu_class' => 'navigation cs-fcc cs-aife',
                        'fallback_cb'    => '__return_false')
                    ); ?>
                </nav>
            <?php endif;?>
        </div>
    </header>