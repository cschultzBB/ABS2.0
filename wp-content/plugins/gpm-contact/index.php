<?php
/*
Plugin Name: GPM Contact Details
Plugin URI: http://goldenproportions.com
Description: Specify Contact Details For Website	
Version: 1.0.0
Author: GPM
Author URI: http://goldenproportions.com
*/

if ( ! class_exists( 'ContactDetails' ) )
{
	class ContactDetails
	{
		var $name = 'Contact Details';
		var $tag = 'contact';
		var $options = array();
		var $messages = array();
		
		function ContactDetails()
		{
			if ( $options = get_option( $this->tag ) ) {
				$this->options = $options;
			}
			if ( is_admin() ) {
				register_activation_hook( __FILE__, array( &$this, 'activate' ) );
				add_action( 'admin_menu', array( &$this, 'admin_menu' ) );
				add_action( 'admin_init', array( &$this, 'admin_init' ) );
				add_filter( 'plugin_row_meta', array( &$this, 'plugin_row_meta' ), 10, 2 );
			} else {
				add_shortcode( 'contact', array( &$this, 'shortcode' ) );
				add_filter( 'contact_detail', array( &$this, 'build'), 1 );
			}
		}
		
		function activate()
		{
			if ( ! $this->options ) {
				update_option( $this->tag, array(
					'email' => get_option( 'admin_email' )
				) );
			}
		}
		
		function admin_menu()
		{
			add_menu_page(
				$this->name,
				$this->name,
				'manage_options',
				$this->tag,
				array( &$this, 'settings' ),
				null,
				61
			);
		}
		
		function admin_init()
		{
			register_setting( $this->tag.'_options', $this->tag );
		}
		
		function settings()
		{
			include_once( 'settings.php' );
		}
		
		function plugin_row_meta( $links, $file )
		{
			$plugin = plugin_basename( __FILE__ );
			if ( $file == $plugin ) {
				return array_merge(
					$links,
					array( sprintf(
						'<a href="options-general.php?page=%s">%s</a>',
						$this->tag, __( 'Edit Details' )
					) )
				);
			}
			return $links;
		}
		
		function build( $args )
		{
			extract( shortcode_atts( array(
				'type' => false,
				'before' => '',
				'after' => '',
				'echo' => true
			), $args ) );
			$value = $this->value( $type );
			if ( strlen( $value ) == 0 ) {
				return;
			}
			$detail = $before.$value.$after;
			if ( $echo ) {
				echo $detail;
			} else {
				return $detail;
			}
		}
		
		function value( $type = false )
		{
			if ( ( false != $type )  && array_key_exists( $type, $this->options ) ) {
				return ( 'address' == $type ? nl2br( $this->options[$type] ) : $this->options[$type] );
			}
			return null;
		}
		
		function shortcode( $atts )
		{
			extract( shortcode_atts( array(
				'type' => false,
				'include' => false
			), $atts ) );
			if ( 'form' == $type ) {
				return $this->form( $include );
			}
			return contact_detail( $type, false, false, false );
		}
		
		function form( $include = false )
		{
			ob_start();
			if ( ! isset( $this->options['email'] ) || ! is_email( $this->options['email'] ) ) {
				return __( 'You must define an email address on the options page in order to display the contact form.' );
			}			
			if ( isset( $_POST['contact'] ) ) {
				$this->messages['error'] = array();
				if ( ! wp_verify_nonce( $_POST[$this->tag.'_nonce'], $this->tag ) ) {
   					$this->messages['error'][] = __( 'Sorry, the nonce field provided was invalid.' );
				}
				$contact = $_POST['contact'];
				foreach ( $contact AS $key => $value ) {
					switch ( $key ) {
						case 'name':
							$value = apply_filters( 'pre_comment_author_name', $value );
							if ( strlen( $value ) < 1 ) {
								$this->messages['error'][] = __( 'Please enter your name.' );
							}
						break;
						case 'email':
							$value = apply_filters( 'pre_comment_author_email', sanitize_email( $value ) );
							if ( ! is_email( $value ) ) {
								$this->messages['error'][] = __( 'Please enter a valid email address.' );
							}
						break;
						case 'message':
							$value = trim( wp_kses( stripslashes( $value ), array() ) );
							if ( strlen( $value ) < 1 ) {
								$this->messages['error'][] = __( 'Please enter a message.' );
							}
						break;
						default:
							$value = trim( wp_kses( stripslashes( $value ), array() ) );
					}
					$contact[$key] = $value;
				}
				if ( count( $this->messages['error'] ) == 0 ) {
					if ( $this->is_blacklisted( $contact ) ) {
						$this->messages['error'][] = __(
							'Sorry, your comment failed the blacklist check and could not be sent.'
						);
					} else if ( $this->is_spam( $contact ) ) {
						$this->messages['error'][] = __(
							'Sorry, your comment failed the spam check and could not be sent.'
						);
					} else {
						if ( $this->send_mail( $contact ) ) {
							$this->messages['ok'] = __(
								'Your message has been sent.'
							);
							unset( $contact );
						} else {
							$this->messages['error'][] = __(
								'Sorry, we were unable to send your message.'
							);
						}
					}
				}
			}
			if ( ( false !== $include ) && file_exists( TEMPLATEPATH.'/'.basename( $include ) ) ) {
				include( TEMPLATEPATH.'/'.basename( $include ) );
			} else {
				include( 'form.php' );
			}
			$form = ob_get_contents(); ob_end_clean();
			return $form;
		}
	}
	$contactDetails = new ContactDetails();
	if ( isset( $contactDetails ) ) {
		function contact_detail( $t = false, $b = '', $a = '', $e = true ){
			return apply_filters( 'contact_detail', array(
				'type' => $t,
				'before' => $b,
				'after' => $a,
				'echo' => $e
			) );
		}
	}
}


