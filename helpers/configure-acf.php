<?php

define( 'MY_ACF_PATH', get_stylesheet_directory() . '/assets/acf/' );
define( 'MY_ACF_URL', get_stylesheet_directory_uri() . '/assets/acf/' );

include_once( MY_ACF_PATH . 'acf.php' );

add_filter('acf/settings/url', function ( $url ) {
  return MY_ACF_URL;
} );

add_filter('acf/settings/show_admin', function ( $show_admin ) {
  return true;
} );

if ( function_exists( 'acf_add_options_page' ) ) {

	acf_add_options_page( array(
		'page_title' 	=> 'Theme Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	) );

}
