<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package hopeforjustice-2014
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('outer single'); ?>>

		<div class="inner">
			<header class="single-header">
				<h1 class="single-header__title"><?php the_title(); ?></h1>
			</header><!-- .entry-header -->

			<div class="single-content">
				<?php the_content(); ?>
			</div><!-- .entry-content -->
		</div>

</article><!-- #post-## -->
