<?php
/**
 * Template Name: Prevention Month 2020
 * 
 * @package hopeforjustice-2014
 */

get_header(); ?>

	<main id="main" class="site-main prevention" role="main">
		<div class="prevention__hero" style="background-image: url('<?php the_field('background_image'); ?>');">
			<div class="inner">
				<?php the_field('logo_date'); ?>
				<div class="prevention__logo">
					<img src="https://hopeforjustice.org/wp-content/uploads/2020/01/prevention-logo.svg">
					<div class="prevention__line"></div>
					<p class="prevention__date"><strong>January 2021</strong></p>
				</div>
			</div><!--/inner-->
		</div><!--/p-hero-->

		<div class="prevention__split">
			<div class="prevention__about prevention__padding prevention__half">
				<div class="inner">
					<?php the_field('about'); ?>
				</div><!--/inner-->
			</div><!--/about-->

			<div class="prevention__sts prevention__padding prevention__half">
				<div class="inner">
					<?php the_field('sts'); ?>
				</div><!--/inner-->
			</div><!--/sts-->
		</div><!--/split-->

		<div class="prevention__split">	
			<div class="prevention__get-involved prevention__padding prevention__half">
				<div class="inner">
					<?php the_field('get-involved'); ?>	
				</div><!--/inner-->
			</div><!--/get-involved-->

			<div class="prevention__slider prevention__padding prevention__half">
				<?php the_field('slider'); ?>
			</div><!--/slider-->
		</div><!--/split-->

		<div class="prevention__split">
			<div class="prevention__partner prevention__padding prevention__half">
				<div class="inner">
					<?php the_field('partner'); ?>
				</div><!--/inner-->
			</div><!--/partner-->

			<div class="prevention__form prevention__padding prevention__half">
				<div class="inner">
					<?php the_field('the_form'); ?>
				</div><!--/inner-->
			</div><!--/form-->
		</div><!--/split-->

	</main>


<?php get_footer(); ?>