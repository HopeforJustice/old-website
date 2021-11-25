<?php
/**
 *
 * The template for the news archive
 * Template Name: News archive
 *
 * This is the archive template used for showing news
 *
 * @package hopeforjustice-2014
 */

get_header(); ?>

	<main id="main" role="main" class="archive outer--single">
		<div class="inner">
			<header class="archive__page-header">
				<h1 class="archive__page-title mega"><?php the_title(); ?></h1>
			</header><!-- .archive__page-header -->
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
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$query = new WP_Query('posts_per_page=30&paged=' . $paged); 
				
				while ( $query->have_posts() ) : $query->the_post(); ?>

					<?php get_template_part( 'partials/content', 'archive' ); ?>

				<?php endwhile; // end of the loop. ?>
			</div>
			<div class="row text--center">
				<?php hopeforjustice_2014_pagination($query->max_num_pages); ?>
			</div>
		</div>
	</main><!-- #main -->
	
<?php get_footer(); ?>
