<?php
/**
 * The template used for /donate NO
 *
 * Root Donate page is a redirect which should point you to the correct page based on your location...
 * 
 * @package hopeforjustice-2014
 */

get_header();?>
	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class('page donate'); ?>>

		<header class="donate-header outer">
			<div class="inner">
				<?php if(get_field('page_title')) : ?>
					<h1 class="donate-header__title mega"><?php the_field('page_title'); ?></h1>
				<?php else : ?>
					<h1 class="donate-header__title mega"><?php the_title(); ?></h1>
				<?php endif ?>
				<?php if(get_field('sub-title')) : ?>
					<h2 class="donate-header__sub-title flush--top"><?php the_field('sub-title'); ?></h2>
				<?php endif ?>
			</div>
		</header>
		<?php 
		$image = get_field('background_image');
		$background_image = ($image != '' ? 'background-image:url('.$image['url'].');' : '');
		$background_image_style = ($image != '' ? get_field('background_image_style') : '');
		$background_colour = (get_field('background_colour') && $image == '' ? 'background-color:'.get_field('background_colour') : '');
		$text_align = (get_field('text_alignment') != 'default' ? get_field('text_alignment') : '' );
		?>
		<section class="donate-options outer--double single <?php echo $background_image_style; ?> <?php the_field('text_colour_scheme');?> <?php echo $text_align; ?>" style="<?php echo $background_image;?><?php echo $background_colour;?>">

			<div class="inner">
				

					<?php the_content(); ?>

			</div>

		</section><!--/.donate-ptions-->
		
		<!-- Modal -->
		<div class="modal fade donate-alt" id="donate-alt" tabindex="-1" role="dialog" aria-labelledby="donate-alt__title" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <a href="#" data-dismiss="modal" class="gi-close modal__close"><span class="accessibility">Close</span></a>
				<?php if(get_field('modal_title')) : ?>
					<h2 class="modal-title gamma" id="donate-alt__title"><?php the_field('modal_title');?></h2>
				<?php endif;?>
		      </div>
		      <div class="modal-body">
		        <?php the_field('modal_content'); ?>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="button button--solid float--right" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>

		<?php endwhile; // end of the loop. ?>

	</main><!-- #main -->
	
<?php get_footer(); ?>