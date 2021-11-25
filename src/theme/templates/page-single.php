<?php
/**
 *
 * Template Name: Single page
 *
 * No stacking - just pagey goodness.
 *
 * @package hopeforjustice-2014
 */

get_header(); ?>


	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>


			<?php get_template_part( 'partials/content', 'single' ); ?>


		<?php endwhile; // end of the loop. ?>

	</main><!-- #main -->

<?php get_footer(); ?>
