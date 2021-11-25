<?php
/**
 * The template used for /signup - email signup page
 *
 * 
 * @package hopeforjustice-2014
 */

get_header();?>
	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
		<?php 
		$image = get_field('background_image');
		$background_image = ($image != '' ? 'background-image:url('.$image['url'].');' : '');
		$background_image_style = ($image != '' ? get_field('background_image_style') : '');
		$background_colour = (get_field('background_colour') && $image == '' ? 'background-color:'.get_field('background_colour') : '');
		$text_align = (get_field('text_alignment') != 'default' ? get_field('text_alignment') : '' );
		?>
		<article id="post-<?php the_ID(); ?>" class="page signup outer--double single <?php echo $background_image_style; ?> <?php the_field('text_colour_scheme');?> <?php echo $text_align; ?>" style="<?php echo $background_image;?><?php echo $background_colour;?>">

		<header class="signup-header text--center">
			<div class="inner">
				<?php if(get_field('page_title')) : ?>
					<h1 class="signup-header__title mega"><?php the_field('page_title'); ?></h1>
				<?php else : ?>
					<h1 class="signup-header__title mega"><?php the_title(); ?></h1>
				<?php endif ?>
				<?php if(get_field('sub-title')) : ?>
					<h2 class="signup-header__sub-title flush--top"><?php the_field('sub-title'); ?></h2>
				<?php endif ?>
			</div>
		</header>

		<div class="row" >

			<div class="inner">
				<div class="colcenter-10">
				<?php the_content(); ?>
				</div>

			</div>

		</section><!--/.signup-ptions-->

		<?php endwhile; // end of the loop. ?>

	</main><!-- #main -->
	
<?php get_footer(); ?>