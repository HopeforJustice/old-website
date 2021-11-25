<?php
/**
 * The template used for /give-the-gift-thank-you
 *
 * Root Donate page is a redirect which should point you to the correct page based on your location...
 * 
 * @package hopeforjustice-2014
 */

get_header();?>

<!--<div style="background-color: white; color: black; padding:50px;">
<?php

if (isset($_GET['amount'])) {echo $_GET['amount'];} else {echo 'none';}

if (isset($_GET['deliveryMethod'])) {echo $_GET['deliveryMethod'];} else {echo 'none';}

if (isset($_GET['recepientAddress'])) {echo $_GET['recepientAddress'];} else {echo 'none';}

if (isset($_GET['deliverBy'])) {echo $_GET['deliverBy'];}

if (isset($_GET['cardChoice'])) {echo $_GET['cardChoice'];} else {echo 'none';}


?>
</div>-->

<div class="gift-receipt">
	<div class="inner">

		<h1 class="mega">Thank you
		<?php
		if (isset($_GET['Name'])) {
			echo $_GET['Name'];
		} 
		else {
			echo 'friend';
		}
		?>!
		</h1>
		<p class="gift-receipt__message gamma">Your gift will soon be winging its way towards the lucky recipient via
		<span class="gift-receipt__lowercase"><?php
		if (isset($_GET['deliveryMethod'])) {
			echo $_GET['deliveryMethod'];
		} 
		else {
			echo 'the method you selected';
		}
		?>!</span> 
		Thank you so much for choosing to give a gift that truly changes lives.</p>
		<a class="button button--solid button--blue" href="#" onclick="window.print();return false;">Print this page for your records.</a>
		<div class="gift-receipt__details">
			<img class="gift-receipt__img" src="
				<?php if (isset($_GET['Img'])) {
					echo $_GET['Img'];
				} 
				else {
					echo 'N/A';
				}?>
			">
			<div class="gift-receipt__text">
				<p>
					<strong>Total amount paid:</strong><br> 
					£<?php 
					if (isset($_GET['amount'])) {
						echo $_GET['amount'];
					} 
					else {
						echo 'N/A';
					}?>
				</p>

				<p>
					<strong>Being delivered to:</strong><br> 
					<?php 
					if (isset($_GET['recepientAddress'])) {
						echo $_GET['recepientAddress'];
					} 
					else {
						echo 'N/A';
					}?>
				</p>

				<?php 
				if (isset($_GET['deliverBy'])) {?>
					<p><strong>Being delived by: </strong><br><?php echo $_GET['deliverBy'];?></p> 
				<?php } ?>

				<p>
					<strong>Story chosen:</strong><br> 
					<?php 
					if (isset($_GET['cardChoice'])) {
						echo $_GET['cardChoice'];
					} 
					else {
						echo 'N/A';
					}?>
				</p>
			</div>
		</div>


	</div>
</div>

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

</main><!-- #main -->

<?php get_footer(); ?>