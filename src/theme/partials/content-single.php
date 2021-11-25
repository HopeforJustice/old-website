<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package hopeforjustice-2014
 */
?>

	<?php 
	$image = get_field('background_image');
	$background_image = $image != '' ? 'background-image:url('.$image['url'].');' : '';
	$background_image_style = $image != '' ? get_field('background_image_style') : '';
	$background_colour = get_field('background_colour') && $image == '' ? 'background-color:'.get_field('background_colour') : '';
	$text_align = get_field('text_alignment') != 'default' ? ' '.get_field('text_alignment') : '' ;
	$text_size = get_field('text_size') != 'default' ? ' '.get_field('text_size') : '' ;

	?>

	<article id="<?php echo $post->post_name; ?>" class="single <?php echo $post->post_name; ?> outer <?php the_field('section_format'); ?> <?php echo $background_image_style; ?> <?php the_field('text_colour_scheme');?><?php echo $text_align; ?>" style="<?php echo $background_image;?><?php echo $background_colour;?>">


		<div class="inner">

			<?php if (get_field('show_title')) :?>

			<header class="single-header">

				<h1 class="single-header__title alpha"><?php the_title(); ?></h1>

				<?php if(get_field('sub-title')) : ?>
					<h2 class="single-header__sub-title gamma"><?php the_field('sub-title'); ?></h2>
				<?php endif ?>

			</header><!-- .entry-header -->

			<?php endif; ?>


			<?php if (get_field('section_format') == 'full-width') :

				// layout for full-width content
				echo '<div class="single-content'. $text_size . '">';
				the_field('content');
				echo '</div>';

			elseif(get_field('section_format') == 'image-header') :

				// layout for image-header 
				echo '<div class="single-content'. $text_size . '">';
				the_field('content');
				echo '</div>';	

			elseif (get_field('section_format') == 'split') :

				$content_image = get_field('content_image');
				$split = get_field('split_arrangement');
				$split_class_left = ( $split == 'two-thirds-left' ? 'colspan-2' : 'col');
				$split_class_right = ( $split == 'two-thirds-right' ? 'colspan-2' : 'col');

				// half-width content ?>

				<?php if ($split == 'half' || $split == '') : ?>

					<div class="colgroup-2 single-content<?php echo $text_size; ?>">

				<?php else : ?>

					<div class="colgroup-3 single-content<?php echo $text_size; ?>">

				<?php endif; ?>

				<?php if(get_field('content_alignment') == 'left') :?>

					<div class="<?php echo $split_class_left ?><?php echo (get_field('additional_content_type') == 'image' ? ' split__image' : ' split__content'); ?>">

						<?php if(get_field('additional_content_type') == 'image' && $content_image):?>

							<img src="<?php echo $content_image['url']; ?>" alt="<?php echo $content_image['alt'] ?>" />

						<?php elseif(get_field('additional_content_type') == 'text') : ?>

							<?php the_field('additional_content'); ?>

						<?php endif; ?>

					</div>


					<div class="<?php echo $split_class_right; ?> split__content">

						<?php the_field('content'); ?>

					</div>


				<?php else : // if it's not additional content on the left ?>

					<div class="<?php echo $split_class_left; ?> split__content">

						<?php the_field('content'); ?>

					</div>

					<div class="<?php echo $split_class_left ?><?php echo (get_field('additional_content_type') == 'image' ? ' split__image' : ' split__content'); ?>">					

						<?php if(get_field('additional_content_type') == 'image'  && $content_image) :?>

							<img src="<?php echo $content_image['url']; ?>" alt="<?php echo $content_image['alt'] ?>" />

						<?php elseif(get_field('additional_content_type') == 'text') :?>
						
							<?php the_field('additional_content'); ?>

						<?php endif; ?>

					</div>
					
				<?php endif; ?>

				</div><!--/colgroup-->

				<?php if(get_field('footer')) : ?>

					<footer class="single-footer">
						<?php the_field('footer');	?>
					</footer>

				<?php endif; ?>						

			<?php 

			elseif (get_field('section_format') == 'quotation') :

				// quotation format 

				$quote_image = get_field('quote_image');?>

				<div class="colgroup-3">

					<div class="col <?php the_field('image_alignment'); ?>">

						<img src="<?php echo $quote_image['url']; ?>" alt="<?php echo $quote_image['alt'] ?>" />

					</div>

					<div class="colspan-2">
						<blockquote class="quote">
							<?php the_field('quote_text'); ?>
							<footer "quote__source"><?php the_field('quote_source');?></footer>
						</blockquote>
						<?php the_content();?>

					</div>

				</div>
				
				<?php if(get_field('footer')) : ?>

					<footer class="single-footer">
						<?php the_field('footer');	?>
					</footer>

				<?php endif; ?>


			<?php 

			elseif(get_field('section_format') == 'three-col') : ?>

			<div class="colgroup-3 single-content<?php echo $text_size; ?>">

			<?php 	
				// layout for three column plus images
				//if get_field('columns')

				$i = 1;

				while (have_rows('columns')) : the_row();

					$col_img = get_sub_field('column_image');
					$col_class = '';

					if($i % 3 == 0) {

						$col_class = ' col--last';

					} ?>

					<div class="col<?php echo $col_class;?>">

						<?php echo (get_sub_field('column_image_link') && $col_img ? '<a href="'. get_sub_field('column_image_link') .'" class="three-col__link" title="'. $col_img['caption'] .'">' : '') ;?>
				
						<?php if ($col_img) : ?>
							<img class="three-col__image" src="<?php echo $col_img['url']; ?>" <?php echo($col_img['alt'] ? 'alt="'.$col_img['alt'].'"' : '');?> />
						<?php endif; ?>
					
						<?php echo (get_sub_field('column_image_link') && $col_img ? '</a>' : ''); ?>

						<div class="three-col__content">
							<?php the_sub_field('column_content'); ?>
						</div>

					</div>

					<?php  $i++;

				endwhile; ?>

				</div>


				<?php 

				if(get_field('footer')) : 

					echo '<footer class="single-footer">';
						
						the_field('footer');
					
					echo '</footer>';

				endif;

			elseif(get_field('section_format') == 'four-col') :

				// layout for four column plus images ?>

				<div class="colgroup-4 single-content<?php echo $text_size; ?>">

				<?php 

				$i = 1;

				while (have_rows('columns')) : the_row();

					$col_img = get_sub_field('column_image');
					$col_class = '';

					if($i % 4 == 0) {

						$col_class = ' col--last';

					} ?>

					<div class="col<?php echo $col_class;?>">

						<?php echo (get_sub_field('column_image_link') && $col_img ? '<a href="'. get_sub_field('column_image_link') .'" class="four-col__link"  title="'. $col_img['caption'] .'">' : '') ;?>
				
						<?php if ($col_img) : ?>
							<img class="four-col__image" src="<?php echo $col_img['url']; ?>" <?php echo($col_img['alt'] ? 'alt="'.$col_img['alt'].'"' : '');?> />
						<?php endif; ?>
					
						<?php echo (get_sub_field('column_image_link') && $col_img ? '</a>' : ''); ?>

						<div class="four-col__content">
							<?php the_sub_field('column_content'); ?>
						</div>

					</div><!--/col-->

					<?php  $i++;


				endwhile; ?>

				</div><!--colgroup-4-->

				<?php 

				if(get_field('footer')) : 

					echo '<footer class="single-footer">';
						
						the_field('footer');
					
					echo '</footer>';

				endif;						


			endif; ?>



		</div><!--/.inner -->

	</article><!--/.single -->