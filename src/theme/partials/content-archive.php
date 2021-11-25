<?php
/**
 * @package hopeforjustice-2014
 */
?>

<?php 
setup_postdata( $post );
$category = get_the_category();
$storytype = $category[0]->cat_name; 
?>

<article id="post-<?php the_ID(); ?>" class="col teaser">
	<?php if(has_post_thumbnail( $post->ID )) : ?>
		<a href="<?php the_permalink() ?>" class="teaser__img-link">
			<?php the_post_thumbnail('news-feature-small'); ?>
		</a>
	<?php else : ?>
		<a href="<?php the_permalink() ?>" class="teaser__img-link">
			<div class="teaser__no-img gi-hfj"></div>
		</a>
	<?php endif; ?>
	<h3 class="teaser__title">
		<span class="teaser__type"> <?php echo $storytype ?> : </span>
		<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
	</h3>
	<div class="teaser__meta">
		<span class="teaser__author">
			<?php if(get_field('news_source')) {
				the_field('news_source');
			} else {
				the_author();
			} ?>
		</span>
		<span class="teaser__date"> &mdash; <?php hopeforjustice_2014_posted_date('teaser__date'); ?> </span>
	</div>
</article><!-- #post-## -->