<?php
/**
 * Template Name: Extreme
 * 
 * @package hopeforjustice-2014
 */

get_header(); ?>

		<main id="main" class="site-main change" role="main">
			<?php while ( have_posts() ) : the_post(); ?>		
			
			<?php
			
			$thumbnail = '';
			
			// Get the ID of the post_thumbnail (if it exists)
			$post_thumbnail_id = get_post_thumbnail_id($post->ID);
			
			// if it exists
			if ($post_thumbnail_id) {
				$thumbnail = wp_get_attachment_image_src($post_thumbnail_id, 'campaign__image', false, '');
			}
			if (!empty($thumbnail)) { ?>
			<?php } ?>

			<section class="split_container">
				<div class="split_child split_picture" style="background-image:url('<?php echo $thumbnail[0]; ?>');">
					<div class="split_box"><div class="split_box_inner"><?php the_field('split_picture_description'); ?></div></div>
				</div>
				<div class="split_child split_gray">
					<div class="split_child_inner">
						<img class="split_logo"src="<?php the_field('split_logo'); ?>">
						<img class="split_date"src="<?php the_field('split_date'); ?>">
						<div class="split_description"><?php the_field('split_description'); ?></div>
						<div class="split_pull_out"><?php the_field('split_pull_out'); ?></div>
				</div>
			</section>
			
			<div style="background-color:white;">
			<section class="split_container split_sponsor">
				
				<div class="split_child">
					<div class="split_max">
						<!--<img src="https://hopeforjustice.org/wp-content/uploads/2019/05/Group-417.svg">
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
						<a class="button button--solid button--blue">Download pack</a>-->
						<?php the_field('sponsors_pack'); ?>
					</div>
				</div>
				<div class="split_child split_child--right">
					<div class="mountain_book_container">
						<img class="mountain_book" src="<?php the_field('sponsor_book'); ?>">
					</div>
				</div>
				<img class="mountain_image" src="<?php the_field('mountain_image'); ?>">
			</section>
		    </div>

		    <?php if (get_field('climbers_text')) : ?>
		    <section class="giveto">

		    	<div class="giveto_header">
		    		<img class="giveto_title" src="<?php the_field('climbers_title'); ?>">
		    		<p class="giveto_text">
		    			<?php the_field('climbers_text'); ?>
		    		</p>
		    	</div>

		    
		    <div class="giveto_people">
		    		<div class="giveto_person">
		    			<div style="background-image: url(<?php the_field('tim_image'); ?>);"  class="giveto_image"></div>
		    			<a class="button button--solid button--blue" href="<?php the_field('tim_link'); ?>"><?php the_field('tim_button'); ?></a>
		    		</div>

		    		<div class="giveto_person">
		    			<div style="background-image: url(<?php the_field('sheralyn_image'); ?>);" class="giveto_image"></div>
		    			<a class="button button--solid button--blue" href="<?php the_field('sheralyn_link'); ?>"><?php the_field('sheralyn_button'); ?></a>
		    		</div>
		    	</div>
		    </section>
		    <?php endif; ?>

			
			<?php if (get_field('current_sponsors')) : ?>
			<section class="sponsors">

		    	<div class="sponsors_header">
		    		<!--<img src="https://hopeforjustice.org/wp-content/uploads/2019/05/Current-sponsors.svg">
		    		<p>
		    		Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
		    		</p>-->
		    		<?php the_field('current_sponsors'); ?>
		    	</div>

		    	<div class="sponsors_slider flexslider">
  					<ul class="slides">
    					<!--<li>
      					<img src="http://placekitten.com/300/200" />
    					</li>
    					<li>
      					<img src="http://placekitten.com/300/150" />
    					</li>
    					<li>
      					<img src="http://placekitten.com/300/200" />
    					</li>
    					<li>
     					<img src="http://placekitten.com/300/100" />
    					</li>-->
    					<?php the_field('image_slider'); ?>
  					</ul>
				</div>
		    	
		    </section>
			<?php endif; ?>

			<?php endwhile; // end of the loop. ?>
		</main><!-- #main -->


<?php get_footer(); ?>