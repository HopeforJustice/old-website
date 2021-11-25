<?php
/**
 * The template for the homepage x
 *
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
			} ?>
			



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


		<section class="hero hero--tall">
			<div class="inner">
				<div class="hero__content col">
					<?php the_content(); ?>
					
				</div>
			</div>
		</section>


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
		


		<?php if (get_field('card_1_image')) : ?>

		<aside class="cards"><!--involvment cards-->
			<!-- UK -->
			<?php if($GLOBALS['userInfo'] && in_array($GLOBALS['userInfo'], $GLOBALS['uk'])){ ?>
			<div style="height:80px; width:100%;" class="homepage__asw-space"></div>
			<!-- Norway -->
			<?php } else if($GLOBALS['userInfo'] && in_array($GLOBALS['userInfo'], $GLOBALS['norway'])){ ?>
			<!-- Rest of the world  -->
			<h2 class="bignbold cards__title home__cards-title"><?php the_field('involvement_title_no'); ?></h2>
			<?php } else { ?>
			<h2 class="bignbold cards__title home__cards-title"><?php the_field('involvement_title_alt'); ?></h2>
			<?php } ?>

			<div class="cards__inner">
					<!---------------------------------------- Card 1------------------------------------->
					<!-- UK -->
					<?php if($GLOBALS['userInfo'] && in_array($GLOBALS['userInfo'], $GLOBALS['uk'])){ ?>
					<a href="<?php the_field('card_1_link'); ?>">
						<div class="card__wrapper">
							<div class="cards__image" style="background-image:url('<?php the_field('card_1_image'); ?>');"></div>
							<div class="cards__info">
								<p><?php the_field('card_1_info'); ?></p>
								<div class="button button--solid button--blue card__button"><?php the_field('card_1_button'); ?></div>
							</div>
						</div>
					</a>
					<!-- Norway -->
					<?php } else if($GLOBALS['userInfo'] && in_array($GLOBALS['userInfo'], $GLOBALS['norway'])){ ?>
					<a href="<?php the_field('card_1_link_no'); ?>">
						<div class="card__wrapper">
							<div class="cards__image" style="background-image:url('<?php the_field('card_1_image_no'); ?>');"></div>
							<div class="cards__info">
								<p><?php the_field('card_1_info_no'); ?></p>
								<div class="button button--solid button--blue card__button"><?php the_field('card_1_button_no'); ?></div>
							</div>
						</div>
					</a>
					<!-- Rest of the world  -->
					<?php } else { ?>
					<a href="<?php the_field('card_1_link_alt'); ?>">
						<div class="card__wrapper">
							<div class="cards__image" style="background-image:url('<?php the_field('card_1_image_alt'); ?>');"></div>
							<div class="cards__info">
								<p><?php the_field('card_1_info_alt'); ?></p>
								<div class="button button--solid button--blue card__button"><?php the_field('card_1_button_alt'); ?></div>
							</div>
						</div>
					</a>
					<?php } ?>

					<!---------------------------------------- Card 2------------------------------------->
					<!-- UK -->
					<?php if($GLOBALS['userInfo'] && in_array($GLOBALS['userInfo'], $GLOBALS['uk'])){ ?>
					<a href="<?php the_field('card_2_link'); ?>">
						<div class="card__wrapper">
							<div class="cards__image" style="background-image:url('<?php the_field('card_2_image'); ?>');"></div>
							<div class="cards__info">
								<p><?php the_field('card_2_info'); ?></p>
								<div class="button button--solid button--blue card__button"><?php the_field('card_2_button'); ?></div>
							</div>
						</div>
					</a>
					<!-- Norway -->
					<?php } else if($GLOBALS['userInfo'] && in_array($GLOBALS['userInfo'], $GLOBALS['norway'])){ ?>
					<a href="<?php the_field('card_2_link_no'); ?>">
						<div class="card__wrapper">
							<div class="cards__image" style="background-image:url('<?php the_field('card_2_image_no'); ?>');"></div>
							<div class="cards__info">
								<p><?php the_field('card_2_info_no'); ?></p>
								<div class="button button--solid button--blue card__button"><?php the_field('card_2_button_no'); ?></div>
							</div>
						</div>
					</a>
					<!-- Rest of the world  -->
					<?php } else { ?>
					<a href="<?php the_field('card_2_link_alt'); ?>">
						<div class="card__wrapper">
							<div class="cards__image" style="background-image:url('<?php the_field('card_2_image_alt'); ?>');"></div>
							<div class="cards__info">
								<p><?php the_field('card_2_info_alt'); ?></p>
								<div class="button button--solid button--blue card__button"><?php the_field('card_2_button_alt'); ?></div>
							</div>
						</div>
					</a>
					<?php } ?>


					<!---------------------------------------- Card 3------------------------------------->
					<!-- UK -->
					<?php if($GLOBALS['userInfo'] && in_array($GLOBALS['userInfo'], $GLOBALS['uk'])){ ?>
					<a href="<?php the_field('card_3_link'); ?>">
						<div class="card__wrapper">
							<div class="cards__image" style="background-image:url('<?php the_field('card_3_image'); ?>');"></div>
							<div class="cards__info">
								<p><?php the_field('card_3_info'); ?></p>
								<div class="button button--solid button--blue card__button"><?php the_field('card_3_button'); ?></div>
							</div>
						</div>
					</a>
					<!-- Norway -->
					<?php } else if($GLOBALS['userInfo'] && in_array($GLOBALS['userInfo'], $GLOBALS['norway'])){ ?>
					<a href="<?php the_field('card_3_link_no'); ?>">
						<div class="card__wrapper">
							<div class="cards__image" style="background-image:url('<?php the_field('card_3_image_no'); ?>');"></div>
							<div class="cards__info">
								<p><?php the_field('card_3_info_no'); ?></p>
								<div class="button button--solid button--blue card__button"><?php the_field('card_3_button_no'); ?></div>
							</div>
						</div>
					</a>
					<!-- Rest of the world  -->
					<?php } else { ?>
					<a href="<?php the_field('card_3_link_alt'); ?>">
						<div class="card__wrapper">
							<div class="cards__image" style="background-image:url('<?php the_field('card_3_image_alt'); ?>');"></div>
							<div class="cards__info">
								<p><?php the_field('card_3_info_alt'); ?></p>
								<div class="button button--solid button--blue card__button"><?php the_field('card_3_button_alt'); ?></div>
							</div>
						</div>
					</a>
					<?php } ?>
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

		<!-- modal
	     <div class="modal fade letter-modal" id="letter-modal" tabindex="-1" role="dialog" aria-hidden="false">
	      <div class="letter-modal__dialog">
	        <div class="letter-modal__content">
		          	<h2>Write a letter to a child who is now free from trafficking</h2>
		          	<div class="letter-modal__body">
		          	<p>
		          	Millions of children are trafficked every year. We are working across the globe to set them free and to restore their dreams. To mark World Day Against Trafficking in Persons, we would love you to join with us in bringing life, hope and joy to the children in our care by writing a letter to a survivor we support.
		          	</p>
		          	<div class="letter-modal__footer"style="display:flex;"><a class="button button--solid button--blue button--large" href="/letter-to-survivor?Source=Popup">Find out more</a></div>
		         </div>

	        </div>
	        <a href="#" data-dismiss="modal" class="gi-close letter-modal__close"><span class="accessibility">Close</span></a>
	      </div>

	    </div>-->


		<?php endif; ?>

		<?php
		//retrak modal
		if(isset($_GET['retrak'])) { ?>
		  
		  	<div class="modal fade" id="retrak-modal" tabindex="-1" role="dialog" aria-hidden="false">
		      <div class="modal__dialog">
		        <div class="modal__content">
		        	<a href="#" data-dismiss="parfait-modal" class="gi-close modal__close"><span class="accessibility">Close</span></a>
		        	<h3>Retrak is now part of the Hope for Justice family</h3>
					<p class="modal__text">It looks like you were trying to reach <a>retrak.org.</a> We are proud to say that Retrak is now part of Hope for Justice. Our life-changing projects helping some of the world’s most vulnerable children and families continue, and we are grateful for your ongoing support. If you have questions or were trying to find a specific resource on the Retrak website, email <a href="mailto:supporters@hopeforjustice.org">supporters@hopeforjustice.org</a></p>
		        </div>
		        
		     </div>


		<?php } ?>
		
		<?php
		//retrak modal
		if(isset($_GET['retrakdonate'])) { ?>
		  
		  	<div class="modal fade" id="retrak-modal" tabindex="-1" role="dialog" aria-hidden="false">
		      <div class="modal__dialog">
		        <div class="modal__content">
		        	<a href="#" data-dismiss="parfait-modal" class="gi-close modal__close"><span class="accessibility">Close</span></a>
		        	<h3>Retrak is now part of the Hope for Justice family</h3>
					<p class="modal__text">It looks like you were trying to reach <a>retrak.org/donate</a>. Thank you so much for considering donating to Retrak! We are proud to say that Retrak is now part of Hope for Justice. Our life-changing projects helping some of the world’s most vulnerable children and families continue, and we are grateful for your ongoing support. If you have questions about donating, email <a>supporters@hopeforjustice.org</a></p>
		        </div>
		        
		     </div>


		<?php } ?>
		


			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->


<?php get_footer(); ?>
