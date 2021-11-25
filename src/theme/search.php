<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package hopeforjustice-2014
 */

get_header(); ?>

<main id="main" role="main" class="archive outer--single">
	<div class="inner">

		<?php if ( have_posts() ) : ?>

			<header class="archive__page-header">
				<h1 class="archive__page-title mega">
				Search results
				</h1>
				<h2><?php printf( __( 'Search for: \'%s\'', 'hopeforjustice-2014' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
		</header><!-- .page-header -->
			<div class="archive__search row">
				<?php get_search_form(); ?>
			</div>
			<div class="archive__cats row">
				<ul class="cat-nav">
					<li class="cat-nav__item"><a href="/news/archive" class="cat-nav__link button--black button--solid">All</a></li>
					<?php wp_list_categories(array('walker'=> new HFJCats_Walker, 'title_li'=> '' ));?>
				</ul>
			</div>			
			<div class="colgroup-3">
				<?php 
				while ( have_posts() ) : the_post(); 
				get_template_part( 'partials/content', 'archive' );
				endwhile; ?>
			</div>


	<?php else : ?>

		<?php get_template_part( 'content', 'none' ); ?>

	<?php endif; ?>


		<div class="row text--center">
			<?php hopeforjustice_2014_pagination(); ?>
		</div>
	</div>

</main><!-- #main -->

<?php get_footer(); ?>
