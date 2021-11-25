<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package hopeforjustice-2014
 */

get_header(); ?>

		<main id="main" class="site-main" role="main">

			<article class="error-404 not-found outer single ">

				<div class="inner">
				<header class="single-header">
					<h1 class="single-header__title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'hopeforjustice-2014' ); ?></h1>
				</header><!-- .page-header -->

				<div class="single-content colcenter-10">
					<p>It looks like the page you were looking for isn't here any more. Why not visit one of the links below, or <a href="/contact-us">contact us</a> if you still can't find what you need?</p>
								<?php wp_nav_menu( array( 'theme_location' => 'mobile', 'container' => false, 'menu_class' => 'menu vertical' ) ); ?>



				</div><!-- .page-content -->
			</div><!-- /inner -->
			</article><!-- .error-404 -->

		</main><!-- #main -->

<?php get_footer(); ?>