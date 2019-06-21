<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package The_Launch
 */

if ( ! is_active_sidebar( 'default-sidebar' ) )
	return;
?>
<aside id="secondary" class="widget-area">
	<?php dynamic_sidebar( 'default-sidebar' ); ?>
</aside>
