<?php

add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails' );
add_post_type_support('page', 'excerpt');

function custom_excerpt_length( $length ) {
	return 50;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

add_action( 'widgets_init', 'unregister_search' );

function unregister_search() {
	unregister_widget( 'WP_Widget_Search' );
}

// Puts link in excerpts more tag
function new_excerpt_more($more) {
       global $post;
	return '... <a class="moretag" href="'. get_permalink($post->ID) . '">Read More...</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

add_action( 'init', 'create_post_type' );
function create_post_type() {
	
	register_post_type( 'homepage-slider',
		array(
			'labels' => array(
				'name' => __( 'Homepage Slider' ),
				'singular_name' => __( 'Homepage Slider' )
			),
			'menu_icon' => 'dashicons-slides',
			'public' => true,
			'has_archive' => true,
			'map_meta_cap' => true,
			'hierarchical' => true,
			'supports' => array(
				'title',
				'editor',
				'excerpt',
				'thumbnail',
				'custom-fields',
				'page-attributes'
				),
			'rewrite' => array('slug' => 'homepage-slider')
		)
	);
	
	register_post_type( 'promos',
		array(
			'labels' => array(
				'name' => __( 'Promos' ),
				'singular_name' => __( 'promos' )
			),
			'public' => true,
			'menu_icon' => 'dashicons-star-empty',
			'has_archive' => true,
			'map_meta_cap' => true,
			'hierarchical' => true,
			'supports' => array(
				'title',
				'editor',
				'excerpt',
				'thumbnail',
				'custom-fields',
				'page-attributes'
				),
			'rewrite' => array('slug' => 'promos')
		)
	);

	register_post_type( 'flyer',
		array(
			'labels' => array(
				'name' => __( 'Flyer' ),
				'singular_name' => __( 'flyer' )
			),
			'public' => true,
			'menu_icon' => 'dashicons-media-spreadsheet',
			'has_archive' => true,
			'map_meta_cap' => true,
			'hierarchical' => true,
			'supports' => array(
				'title',
				'editor',
				'excerpt',
				'thumbnail',
				'custom-fields',
				'page-attributes'
				),
			'rewrite' => array('slug' => 'flyer')
		)
	);
}

if ( function_exists('register_sidebar') ) {

	register_sidebar(array(
	  'name' => 'Quicklinks',
	  'id' => 'quicklinks',
	  'before_widget' => '<div class="quicklinks-inner">',
	  'before_title' => '<div class="cs-widget-heading"><h3 class="panel-title">',
	  'after_title' => '</h3></div><div class="cs-widget-body">',
	  'after_widget' => '</div></div>'
	));
	
	register_sidebar(array(
	  'name' => 'Page Sidebar',
	  'description' => '',
	  'before_widget' => '<li><div class="panel panel-default">',
	  'before_title' => '<div class="panel-heading"><h3 class="panel-title">',
	  'after_title' => '</h3></div><div class="panel-body">',
	  'after_widget' => '</div></div></li>'
	));

}

function my_login_logo() { ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/logo.png);
            padding-bottom: 30px;
			background-size: 240px 100px;
			width: 240px;
			height: 100px;
            box-sizing: border-box;
        }
    </style>
<?php }

add_action( 'login_enqueue_scripts', 'my_login_logo' );

function show_all_thumbs($atts) {
	global $post;
	$post = get_post($post);
	
	extract(shortcode_atts(array(
		'numperrow' => 2,
		'numrows' => -1,
		'disablelinks' => 0,
		'imgthumb' => array(150,150),
		'linksize' => 'large',
		'excludechild' => ''
	 ), $atts));
	
	/* image code */
	$images =& get_children('post_type=attachment&post_mime_type=image&output=ARRAY_N&orderby=menu_order&order=ASC&exclude='.$excludechild.'&post_parent='.$post->ID);
	
    $i = 1;
	$thumblist .=  '<div class="row gallery-row">';
	if($images){
		if ($numrows == -1) {
			foreach( $images as $imageID => $imagePost ){
		
				unset($the_b_img);
				unset($the_l_img);
				$the_b_img = wp_get_attachment_image($imageID, $imgthumb, true, array('class'=>'img-thumbnail img-responsive'));
				$the_l_img = wp_get_attachment_image($imageID, $linksize, false, array('class'=>'img-thumbnail img-responsive'));
				$thumblist .= '<div class="col-lg-'.(12/$numperrow).'"><div class="gallery-row-img">';
				if ($disablelinks == 0) {
					$src = wp_get_attachment_image_src( $imageID, $linksize);
					$thumblist .= '<a class="gallery-'.$imageID.'" href="'.$src[0].'" data-featherlight="image">';
				}
				else {
					$thumblist .= '<span class="footer-img">';
				}
				$thumblist .= $the_b_img;
				if ($disablelinks == 0) {
					$thumblist .= '</a>';
				} else {
					$thumblist .= '</span>';
				}
				$thumblist .= '</div></div>';
				if($i % $numperrow == 0) {
					$thumblist .= '</div><div class="row gallery-row">';
			
				}
            	$i++;
			}
			
		} else {
			$j = 1;
			foreach( $images as $imageID => $imagePost ){
				if ($j <= ($numperrow*$numrows)) {
				  unset($the_b_img);
				  unset($the_l_img);
				  $the_b_img = wp_get_attachment_image($imageID, $imgthumb, true, array('class'=>'img-thumbnail img-responsive'));
				  $the_l_img = wp_get_attachment_image($imageID, $linksize, false, array('class'=>'img-thumbnail img-responsive'));
				  $thumblist .= '<div class="col-lg-'.(12/$numperrow).'"><div class="gallery-row-img">';
				  if ($disablelinks == 0) {
					  	$src = wp_get_attachment_image_src( $imageID, $linksize);
						$thumblist .= '<a class="gallery-'.$imageID.'" href="'.$src[0].'" data-featherlight="image">';
				  }
				  else {
					  $thumblist .= '<span class="footer-img">';
				  }
				  $thumblist .= $the_b_img;
				  if ($disablelinks == 0) {
					  $thumblist .= '</a>';
				  } else {
					  $thumblist .= '</span>';
				  }
				  $thumblist .= '</div></div>';
				  if($j % $numperrow == 0) {
					  $thumblist .= '</div><div class="row gallery-row">';
				  }
				  $j++;
				} else {
					break;	
				}
			}
			
		}	
	}
	$thumblist .=  '</div>';
	return $thumblist;
}

add_shortcode( 'gpm-gallery', 'show_all_thumbs' );

class newest_post extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		parent::__construct(
			'newest_post', // Base ID
			__('Newest Post', 'newest_post'), // Name
			array( 'description' => __( 'Show newest blog post', 'newest_post' ), ) // Args
		);
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		// outputs the content of the widget
			$widget_args = array( 'post_type' => 'post', 'orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => 1 );
			$widget_loop = new WP_Query( $widget_args ); 
			
			while ( $widget_loop->have_posts() ) {
				$widget_loop->the_post();
				echo '<div class="custom-widget">';
					echo '<div class="panel panel-default">';
						echo '<div class="panel-heading">';
							echo '<a href="'.get_the_permalink().'" class="blog-roll-title">'.get_the_title().'</a><br/>';
							echo '<span class="upper-meta-side">'.get_the_date().'</span>';
						echo '</div>';
						echo '<div class="panel-body"><p>'.get_the_excerpt().'</p></div>';
					echo '</div>';
				echo '</div>';
			}
			wp_reset_query();
	}

	/**
	 * Ouputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin
		echo '<p></p>';
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
	}
}

add_action( 'widgets_init', function(){
     register_widget( 'newest_post' );
});

class bootstrap_menu extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		parent::__construct(
			'bootstrap_menu', // Base ID
			__('Bootstrap Menu', 'bootsrap_menu'), // Name
			array( 'description' => __( 'Add a Bootstrap Menu to sidebar. Name menu "Side Menu".', 'bootstrap_menu' ), ) // Args
		);
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		echo '<div class="custom-widget">';
			wp_nav_menu( array(
				'menu'       => 'Side Menu',
				'depth'      => 1,
				'container'  => false,
				'menu_class' => 'nav nav-pills nav-stacked',
				'fallback_cb'    => '__return_false')
			);
		echo '</div>';
	}

	/**
	 * Ouputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin
		echo '<p></p>';
	}
}

add_action( 'widgets_init', function(){
     register_widget( 'bootstrap_menu' );
});

add_action( 'edit_form_after_title', 'gpm_edit_form_after_title' );
function gpm_edit_form_after_title() {

	if( isset($_GET['post_type']) ) { 
		$post_type = $_GET['post_type']; 
	} else {
		$post_type = get_post_type( $post_ID );
	}
	
	if( $post_type == 'gallery' ) :
    	echo '<br/><p>Hint: <strong><em>To add images to the smile gallery, click the "Add Media" button below and upload your photos. Once your files have finished uploading, close the upload dialog and click "Publish" or "Update" on the right hand side.</em></strong></p>';	
	endif;
	
}


//Darken Color of Navbar
function colourBrightness($hex, $percent) {
	// Work out if hash given
	$hash = '';
	if (stristr($hex,'#')) {
		$hex = str_replace('#','',$hex);
		$hash = '#';
	}
	/// HEX TO RGB
	$rgb = array(hexdec(substr($hex,0,2)), hexdec(substr($hex,2,2)), hexdec(substr($hex,4,2)));
	//// CALCULATE 
	for ($i=0; $i<3; $i++) {
		// See if brighter or darker
		if ($percent > 0) {
			// Lighter
			$rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1-$percent));
		} else {
			// Darker
			$positivePercent = $percent - ($percent*2);
			$rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1-$positivePercent));
		}
		// In case rounding up causes us to go to 256
		if ($rgb[$i] > 255) {
			$rgb[$i] = 255;
		}
	}
	//// RBG to Hex
	$hex = '';
	for($i=0; $i < 3; $i++) {
		// Convert the decimal digit to hex
		$hexDigit = dechex($rgb[$i]);
		// Add a leading zero if necessary
		if(strlen($hexDigit) == 1) {
		$hexDigit = "0" . $hexDigit;
		}
		// Append to the hex string
		$hex .= $hexDigit;
	}
	return $hash.$hex;
}


//Convert Hex to RGB
function hex2rgb($hex) {
	
   $hex = colourBrightness($hex, -0.8);
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return implode(",", $rgb); // returns the rgb values separated by commas
   //return $rgb; // returns an array with the rgb values
}

register_nav_menus( array(
	'Main Menu' => 'Main Menu',
    'Home Owner' => 'Home Owner',
    'Contractor' => 'Contractor'
) );

// Get theme options
function get_wpbs_theme_options(){
  $theme_options_styles = '';
  
  	// Top Bar
 
  
	  $top_bar_bg_color = of_get_option('top_bar_bg_color');
	  if ( $top_bar_bg_color ) {
		$theme_options_styles .= '
		.top-bar {
		  background-color: '. $top_bar_bg_color . ';
		}';
	  }
	  
	  $top_bar_text_color = of_get_option('top_bar_text_color');
	  if ( $top_bar_text_color ) {
		$theme_options_styles .= '
		.hours-short {
		  color: '. $top_bar_text_color . ';
		}';
	  }
	  
	  $top_bar_link_color = of_get_option('top_bar_link_color');
	  if ( $top_bar_link_color ) {
		$theme_options_styles .= '
		.hours-short a {
		  color: '. $top_bar_link_color . ';
		}';
	  }
	  
	  // Body BG
	  
	  $body_bg_color = of_get_option('body_bg_color');
	  if ( $body_bg_color ) {
		$theme_options_styles .= '
		.body-bg{
		  background-color: '. $body_bg_color . ';
		}';
		
	  }
	  
	  
	  $body_bg_container_color = of_get_option('body_bg_container_color');
	  if ( $body_bg_container_color ) {
		$theme_options_styles .= '
		.body-bg .container{
		  background-color: '. $body_bg_container_color . ';
		}';
	  }
	  
	  $body_bg_container_shadow = of_get_option('body_bg_container_shadow');
	  if ( $body_bg_container_shadow == 1 ) {
		$theme_options_styles .= '
		.body-bg .container{
		  box-shadow: 2px 3px 5px rgba(0,0,0,0.4);
		}';
	  }
	  
	  // Footer Bar
	  
	  $footer_bar_bg_color = of_get_option('footer_bar_bg_color');
	  if ( $footer_bar_bg_color ) {
		$theme_options_styles .= '
		.footer-bar {
		  background-color: '. $footer_bar_bg_color . ';
		}';
	  }
	  
	  $footer_bar_text_color = of_get_option('footer_bar_text_color');
	  if ( $footer_bar_text_color ) {
		$theme_options_styles .= '
		.footer-bar {
		  color: '. $footer_bar_text_color . ';
		}';
	  }
	  
	  $footer_bar_link_color = of_get_option('footer_bar_link_color');
	  if ( $footer_bar_link_color ) {
		$theme_options_styles .= '
		.footer-bar a, .footer-menu li a {
		  color: '. $footer_bar_link_color . ';
		}';
	  }
	  
	  // Cppyright Bar
	  
	  $copyright_bar_bg_color = of_get_option('copyright_bar_bg_color');
	  if ( $copyright_bar_bg_color ) {
		$theme_options_styles .= '
		.footer-copyright {
		  background-color: '. $copyright_bar_bg_color . ';
		}';
	  }
	  
	  $copyright_bar_text_color = of_get_option('copyright_bar_text_color');
	  if ( $copyright_bar_text_color ) {
		$theme_options_styles .= '
		.footer-copyright {
		  color: '. $copyright_bar_text_color . ';
		}';
	  }
	  
	  $copyright_bar_link_color = of_get_option('copyright_bar_link_color');
	  if ( $copyright_bar_link_color ) {
		$theme_options_styles .= '
		.footer-copyright a {
		  color: '. $copyright_bar_link_color . ';
		}';
	  }
	  
	  
      $topbar_bg_color = of_get_option('top_nav_bg_color');
      if ( $topbar_bg_color ) {
        $theme_options_styles .= '
        .navbar-default {
          background-color: '. $topbar_bg_color . ';
        }
		.navbar-default .navbar-nav > .active > a {
          background-color: rgba('.hex2rgb($topbar_bg_color).',1.0) !important;
        }';
      }

      $topbar_link_color = of_get_option('top_nav_link_color');
      if ($topbar_link_color) {
        $theme_options_styles .= '
        .navbar-default .navbar-nav > li > a {
          color: '. $topbar_link_color . ';
        }';
      }

      $topbar_link_hover_color = of_get_option('top_nav_link_hover_color');
      if ($topbar_link_hover_color) {
        $theme_options_styles .= '
        .navbar-default .navbar-nav > li > a {
          color: '. $topbar_link_hover_color . ';
        }';
      }
	  
	  $topbar_dropdown_bg_color = of_get_option('top_nav_dropdown_bg');
      if ($topbar_dropdown_bg_color) {
        $theme_options_styles .= '
          .dropdown-menu {
            background-color: ' . $topbar_dropdown_bg_color . ';
			border-color: rgba('.hex2rgb($topbar_dropdown_bg_color).',1.0) !important;
          }
        ';
      }

      $topbar_dropdown_hover_bg_color = of_get_option('top_nav_dropdown_hover_bg');
      if ($topbar_dropdown_hover_bg_color) {
        $theme_options_styles .= '
          .dropdown-menu li > a:hover, .dropdown-menu .active > a, .dropdown-menu .active > a:hover {
            background-color: ' . $topbar_dropdown_hover_bg_color . ';
          }
        ';
      }

      $topbar_dropdown_item_color = of_get_option('top_nav_dropdown_item');
      if ($topbar_dropdown_item_color){
        $theme_options_styles .= '
          .dropdown-menu a{
            color: ' . $topbar_dropdown_item_color . ' !important;
          }
        ';
      }

      $hero_unit_bg_color = of_get_option('hero_unit_bg_color');
      if ($hero_unit_bg_color) {
        $theme_options_styles .= '
        .hero-unit {
          background-color: '. $hero_unit_bg_color . ';
        }';
      }

      $suppress_comments_message = of_get_option('suppress_comments_message');
      if ($suppress_comments_message){
        $theme_options_styles .= '
        #main article {
          border-bottom: none;
        }';
      }

      $additional_css = of_get_option('wpbs_css');
      if( $additional_css ){
        $theme_options_styles .= $additional_css;
      }

      if($theme_options_styles){
        echo '<style>'
        . $theme_options_styles . '
        </style>';
      }

      $bootstrap_theme = of_get_option('wpbs_theme');
      $use_theme = of_get_option('showhidden_themes');

      if( $bootstrap_theme && $use_theme ){
        if( $bootstrap_theme == 'default' ){}
        else {
          echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/admin/themes/' . $bootstrap_theme . '.css">';
        }
      }
} // end get_wpbs_theme_options function

add_editor_style('editor-style.css');

?>