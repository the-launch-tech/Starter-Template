<?php
/**
 * The template for displaying 404 pages (not found)
 */

get_header();
?>
<div id="content" class="site-content">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'the-launch' ); ?></h1>
				</header>
				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'the-launch' ); ?></p>
					<?php
					get_search_form();
					the_widget( 'WP_Widget_Recent_Posts' );
					?>
					<div class="widget widget_categories">
						<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'the-launch' ); ?></h2>
						<ul>
							<?php
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							) );
							?>
						</ul>
					</div>
					<?php
					$the_launch_archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'the-launch' ), convert_smilies( ':)' ) ) . '</p>';
					the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$the_launch_archive_content" );

					the_widget( 'WP_Widget_Tag_Cloud' );
					?>
				</div>
			</section>
		</main>
	</div>
</div>
<?php
get_footer();
