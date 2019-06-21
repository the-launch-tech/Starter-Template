<?php
/**
 * The header for our theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="site">
	<?php
	$SOCIAL_SHARING = __TLss__::initialize_social_sharing_shortcode();
	$SOCIAL_SHARING->load_custom_fields();
	$SOCIAL_SHARING->render( 40, '#000' );
	?>
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'the-launch' ); ?></a>
	<header id="masthead" class="site-header">
		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i class="fas fa-bars"></i></button>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary-menu',
				'menu_id'        => 'primary-menu',
			) );
			?>
		</nav>
	</header>
