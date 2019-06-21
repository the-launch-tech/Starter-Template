<?php
/**
 * Template part for displaying posts
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				the_launch_posted_on();
				the_launch_posted_by();
				?>
			</div>
		<?php endif; ?>
	</header>
	<?php the_launch_post_thumbnail(); ?>
	<div class="entry-content">
		<?php
		the_content( sprintf(
			wp_kses(
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'the-launch' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );
		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'the-launch' ),
			'after'  => '</div>',
		) );
		?>
	</div>
	<footer class="entry-footer">
		<?php the_launch_entry_footer(); ?>
	</footer>
</article>
