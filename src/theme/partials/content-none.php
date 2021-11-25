<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package hopeforjustice-2014
 */
?>

<article class="no-results not-found outer">
	<div class="inner">
		<header class="single-header">
			<h1 class="single-header__title"><?php _e( 'Nothing Found', 'hopeforjustice-2014' ); ?></h1>
		</header><!-- .page-header -->

		<div class="page-content">
			<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

				<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'hopeforjustice-2014' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

			<?php elseif ( is_search() ) : ?>

				<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'hopeforjustice-2014' ); ?></p>
				<?php get_search_form(); ?>

			<?php else : ?>

				<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'hopeforjustice-2014' ); ?></p>
				<?php get_search_form(); ?>

			<?php endif; ?>
		</div><!-- .page-content -->
	</div>
</article><!-- .no-results -->
