<?php
/**
 * The template for displaying archive pages
 */

get_header();
?>
<div id="content" class="site-content">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
		<?php if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', get_post_type() );
			endwhile;
			the_posts_navigation();
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif;
		?>
		</main>
	</div>
</div>
<?php
get_sidebar();
get_footer();
