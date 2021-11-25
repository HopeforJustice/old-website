<?php
/**
 * Template Name: Guardian UK
 *
 * Root Donate page is a redirect which should point you to the correct page based on your location...
 * 
 * @package hopeforjustice-2014
 */

get_header();?>
	<main id="main" class="site-main guardian" role="main">
		<div class="guardian__row guardian__hero">
			<div class="inner">
					<div class="guardian__describer">
						<img class="guardian__logo" src="<?php the_field('guardian_logo'); ?>">
						<h2 class="beta"><?php the_field('guardian_subtitle'); ?></h2>
						<p class="text--large-print guardian__text-desktop"><?php the_field('guardian_description'); ?></p>
					</div>
			
				<div class="guardian__giving">
						<div class="guardian__split row">
							<p class="guardian__text-mobile text--large-print"><?php the_field('guardian_description'); ?></p>
								<!-- giving widget -->
								<div class="giving-widget guardian__widget">
									<div class="giving-widget__header">
										<h2 class="beta--no-marg"><?php the_field('widget_title'); ?></h2>
									</div>
									<div class="giving-widget__body">
										<div class="giving-widget__content">
											<div class="giving-widget__options">
												<div id="giving-widget-15" class="giving-widget__option giving-widget__option--active"><?php the_field('widget_selection_1'); ?></div>
												<div id="giving-widget-30" class="giving-widget__option"><?php the_field('widget_selection_2'); ?></div>
												<div id="giving-widget-50" class="giving-widget__option"><?php the_field('widget_selection_3'); ?></div>
											</div>
											<div class="giving-widget__custom-amount">
												<input type="text" name="Amount" class="required numberOnly form-control donate-uk__amount" id="Amount" maxlength="10" value="15.00">
											</div>
											<div id="goCardless"><a class="button button--solid button--black"><?php the_field('widget_button_text'); ?></a></div>
											<a class="giving-widget__currency" id="currency">Donation in British Pounds</a>
										</div>
									</div>
									<div class="giving-widget__footer">
										<div><?php the_field('widget_footer_text'); ?></div>
									</div>
								</div><!-- /giving widget -->
						</div>
				</div>
			</div>
		</div>

		<!--expander section -->
		<div class="row expander">
			<div class="inner">
				<h2 class="expander__title text--side-line"><?php the_field('accordian_title'); ?></h2>
				<div id="guardian-thecla" class="expander__img" data-toggle="modal" data-target="#video-modal">
					<div class="play-button expander__play"><i class="play"></i></div>
				</div>
				<div class="expander__accordian">
					<div class="expander__accordian-inner">
						
						<!--rescue victims -->
						<div class="expander__accordian-section">
							<div class="expander__accordian-header">
								<h3 class="expander__accordian-title"><?php the_field('accordian_subtitle_1'); ?></h3> <div class="expander__triangle expander__triangle--active"></div>
							</div>
							<hr class="expander__hr">
							<p class="expander__accordian-text expander__accordian-text--active">
								<?php the_field('accordian_description_1'); ?>
 							</p>
						</div><!--/rescue victims -->

						<!--restore lives -->
						<div class="expander__accordian-section">
							<div class="expander__accordian-header">
								<h3 class="expander__accordian-title"><?php the_field('accordian_subtitle_2'); ?></h3> <div class="expander__triangle"></div>
							</div>
							<hr class="expander__hr">
							<p class="expander__accordian-text">
								<?php the_field('accordian_description_2'); ?> 
 							</p>
						</div><!--/restore lives -->

						<!--reform society -->
						<div class="expander__accordian-section">
							<div class="expander__accordian-header">
								<h3 class="expander__accordian-title"><?php the_field('accordian_subtitle_3'); ?></h3> <div class="expander__triangle"></div>
							</div>
							<hr class="expander__hr">
							<p class="expander__accordian-text">
								<?php the_field('accordian_description_3'); ?>
 							</p>
						</div><!--/reform-->

						<!-- Prevent exploitation -->
						<div class="expander__accordian-section">
							<div class="expander__accordian-header">
								<h3 class="expander__accordian-title"><?php the_field('accordian_subtitle_4'); ?></h3> <div class="expander__triangle"></div>
							</div>
							<hr class="expander__hr">
							<p class="expander__accordian-text">
								<?php the_field('accordian_description_4'); ?>
 							</p>
						</div><!--/prevent-->
					</div>
				</div>

			</div>
		</div>		

		<div class="picture-quote">
				<div id="guardian-iam" data-toggle="modal" data-target="#video-modal" class="picture-quote__img ">
					<div class="play-button picture-quote__play"><i class="play"></i></div>
				</div>
				<div class="picture-quote__quote">
					<span class="picture-quote__marks">"</span><?php the_field('picture_quote_quote'); ?><span class="picture-quote__marks">"</span>
				</div>
				</div>
		</div>

		<div class="updates">
			<div class="inner">
				<div class="updates__left">
					<img class="updates__img" src="https://hopeforjustice.org/wp-content/uploads/2019/09/guardian-iphone-mockup@2xcrop-1.png">
				</div>
				<div class="updates__right">
					<h2 class="updates__title"><?php the_field('updates_title_1'); ?></h2>
					<h3 class="updates__subtitle"><?php the_field('updates_subtitle_1'); ?></h3>
					<p class="updates__text"><?php the_field('updates_text_1'); ?></p>
					<h3 class="updates__subtitle"><?php the_field('updates_subtitle_2'); ?></h3>
					<p class="updates__text"><?php the_field('updates_text_2'); ?></p>
					<h3 class="updates__subtitle"><?php the_field('updates_subtitle_3'); ?></h3>
					<p class="updates__text"><?php the_field('updates_text_3'); ?></p>
					<a id="footer-button-guardian" class="button button--solid button--black"><?php the_field('updates_button'); ?></a>
				</div>
			</div><!--/inner-->
		</div>
	
		<!-- Modal video -->
		<div class="modal fade video-modal" id="video-modal" tabindex="-1" role="dialog" aria-hidden="true">
		  <div class="video-modal__dialog">
		    <div class="video-modal__content">
		      <div class="video-modal__header">
		        <a href="#" data-dismiss="modal" class="gi-close video-modal__close"><span class="accessibility">Close</span></a>
		      </div>
		      <div class="video-modal__body">
		        <iframe id="video" width="560" height="315" src="https://www.youtube.com/embed/8YWYlhmg5_M" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		      </div>
		      <div class="video-modal__footer">
		        <button type="button" class="video-modal__footer-close button button--solid button--blue" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>

	</main><!-- #main  -->
<?php get_footer(); ?>