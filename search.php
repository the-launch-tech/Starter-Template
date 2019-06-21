<?php
/**
 * The template for displaying search results pages
 */

get_header();
?>
<div id="content" class="site-content">
	<section id="primary" class="content-area">
		<main id="main" class="site-main">
		<?php if ( have_posts() ) : ?>
			<header class="page-header">
				<h1 class="page-title">
					<?php printf( esc_html__( 'Search Results for: %s', 'the-launch' ), '<span>' . get_search_query() . '</span>' ); ?>
				</h1>
			</header>
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', 'search' );
			endwhile;
			the_posts_navigation();
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif;
		?>
		</main>
	</section>
</div>
<?php
get_sidebar();
get_footer();
