<?php
/**
 *
 * The template for sectioned pages
 * Template Name: Page parfait
 *
 * This is the joy of HFJ parfait
 *
 * @package hopeforjustice-2014
 */

get_header(); ?>


	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php if(get_field('page_top')) :?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('page parfait'); ?>>

			<?php endif; ?>

			<?php get_template_part( 'partials/content', 'parfait' ); ?>

			<?php if(get_field('page_top')) : // see if this is the top of a stack of pages ?>

				<?php 
 
				$posts = get_field('stack_pages');
				 
				if( $posts ): ?>

				    <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
				        
				        <?php setup_postdata($post); ?>

				        <?php get_template_part( 'partials/content', 'parfait' ); ?>
				        
				    <?php endforeach; ?>

				    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
				
				<?php endif; ?>

				</article>

			<?php endif; ?>

		<?php endwhile; // end of the loop. ?>

		<?php if(get_field('has_modal')) :?>

			<div class="modal fade" id="parfait-modal" tabindex="-1" role="dialog" aria-hidden="false">
		      <div class="modal__dialog">
		        <div class="modal__content">
		        	<?php the_field('modal_content'); ?>
		        </div>
		        <a href="#" data-dismiss="parfait-modal" class="gi-close modal__close"><span class="accessibility">Close</span></a>
		     </div>

		<?php endif; ?>

	</main><!-- #main -->

<?php get_footer(); ?>
