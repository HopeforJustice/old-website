<?php
/**
 * @package hopeforjustice-2014
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('outer'); ?>>

		<div class="inner">

			<header class="post__header">
				<h1 class="post__title"><?php the_title(); ?></h1>
			</header><!-- .entry-header -->

			<div class="post__content">
				<?php the_content(); ?>
			</div><!-- .entry-content -->

			<div class="post__meta">
				<div class="post__categories">
					Filed under: 
					<?php echo get_the_category_list(','); ?>
				</div>
				<span class="post__author">
					<?php if(get_field('news_source')) {
						the_field('news_source');
					} else {
						the_author();
					} ?>
				</span>
				<span class="post__date"> &mdash; <?php hopeforjustice_2014_posted_date('post__date'); ?> </span>
			</div>

		</div>

</article><!-- #post-## -->
