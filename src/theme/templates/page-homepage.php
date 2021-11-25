<?php
/**
 * Template Name: Homepage
 * Duplicate of the homepage template so that regional variants can be created
 * 
 * @package hopeforjustice-2014
 */

get_header(); ?>

		<div id="video-overlay" class="video-overlay video-overlay--hidden">
			<iframe src="<?php the_field('modal_video'); ?>?loop=1&amp;rel=0&amp;controls=1&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
			<div id="exit-video" class="exit-video button button--solid button--blue">Exit Video</div>
		</div> 

		<main id="main" class="site-main" role="main">
			<?php while ( have_posts() ) : the_post(); ?>		
			
			<?php
			
			$thumbnail = '';
			
			// Get the ID of the post_thumbnail (if it exists)
			$post_thumbnail_id = get_post_thumbnail_id($post->ID);
			
			// if it exists
			if ($post_thumbnail_id) {
				$thumbnail = wp_get_attachment_image_src($post_thumbnail_id, 'hero_full', false, '');
			}
			if (!empty($thumbnail)) { ?>

			<div style="background-image:url('<?php echo $thumbnail[0]; ?>');"  class="hero__background hero--tall background-video" data-stellar-ratio="0.3">
				
				<?php if(get_field('background_video')): ?>
					<div class="background-video__inner">
						<iframe class="background-video__iframe" id="heroVid" src="" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
					</div>
					<script>
						init.push(function () {
							hfj.objects.videoRespond.init('<?php  echo get_field('background_video') . '?mute=1&amp;loop=1&amp;autoplay=1&amp;rel=0&amp;controls=0&amp;showinfo=0&amp;playlist=' . get_field('playlist'); ?>', 'heroVid','desktopLarge' );
						});
					</script>
				<?php endif; ?>
			</div>

			<?php } ?>

			<section class="hero hero--tall">
				<div class="inner">
					<div class="hero__content col">
						<?php the_content(); ?>
					</div>
				</div>
			</section>

		<?php if (get_field('strapline')) : ?>
		
		<aside class="box-video"><!--strapline-->

			<div class="box-video__inner">
				<div class="box-video__description">
					<h1 class="box-video__text"><?php the_field('strapline'); ?></h1>
					<div class="box-video__buttons">
						<a class="box-video__button button--line" href="<?php the_field('button_1_link'); ?>"><?php the_field('button_1_text'); ?></a>
						<a class="box-video__button button--line" href="<?php the_field('button_2_link'); ?>"><?php the_field('button_2_text'); ?></a>  
					</div>
				</div>

				<div class="box-video__video" style="background-image:url('<?php the_field('video_image'); ?>');">
					<div id="play-button" class="play-button"><i class="play"></i></div>
				</div>
			</div>

		</aside><!--/. strapline-->

		<?php endif; ?>

		<?php if (get_field('card_1_image')) : ?>

		<aside class="cards"><!--involvment cards-->
			<h2 class="bignbold cards__title home__cards-title"><?php the_field('involvement_title'); ?></h2>

			<div class="cards__inner">

					<a href="<?php the_field('card_1_link'); ?>">
						<div class="card__wrapper">
							<div class="cards__image" style="background-image:url('<?php the_field('card_1_image'); ?>');"></div>
							<div class="cards__info">
								<p><?php the_field('card_1_info'); ?></p>
								<div class="button button--solid button--blue"><?php the_field('card_1_button'); ?></div>
							</div>
						</div>
					</a>

					<a href="<?php the_field('card_2_link'); ?>">
						<div class="card__wrapper">
							<div class="cards__image" style="background-image:url('<?php the_field('card_2_image'); ?>');"></div>
							<div class="cards__info">
								<p><?php the_field('card_2_info'); ?></p>
								<div class="button button--solid button--blue cards__button"><?php the_field('card_2_button'); ?></div>
							</div>
						</div>
					</a>

					<a href="<?php the_field('card_3_link'); ?>">
						<div class="card__wrapper">
							<div class="cards__image" style="background-image:url('<?php the_field('card_3_image'); ?>');"></div>
							<div class="cards__info">
								<p><?php the_field('card_3_info'); ?></p>
								<div class="button button--solid button--blue card__button"><?php the_field('card_3_button'); ?></div>
							</div>
						</div>
					</a>

	
			</div>


		</aside><!--/. involvment cards-->

		<?php endif; ?>

		<?php if (get_field('lock_info')) : ?>

		<!-- lock-->
		<aside class="lock" style="background-image:url('<?php the_field('lock_background_image'); ?>');">
			<div class="lock__inner">
				<div style="background-image:url('<?php the_field('lock_image'); ?>');" class="lock__image">
				</div>
				<div class="lock__info">
					<p><?php the_field('lock_info'); ?></p>
					<a href="<?php the_field('lock_link'); ?>" class="button button--solid button--blue"><?php the_field('lock_button'); ?></a>
				</div>
			</div>
		</aside>

		<!--/. lock footer-->



		<?php endif; ?>




			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->


<?php get_footer(); ?>
