<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package hopeforjustice-2014
 */

get_header(); ?>

<main id="main" role="main" class="archive outer--single">
	<div class="inner">

		<?php if ( have_posts() ) : ?>

			<header class="archive__page-header">
				<h1 class="archive__page-title mega">
					<?php
					if ( is_category() ) :
						single_cat_title();

					elseif ( is_tag() ) :
						single_tag_title();

					elseif ( is_author() ) :
						printf( __( 'Author: %s', 'hopeforjustice-2014' ), '<span class="vcard">' . get_the_author() . '</span>' );

					elseif ( is_day() ) :
						printf( __( 'Day: %s', 'hopeforjustice-2014' ), '<span>' . get_the_date() . '</span>' );

					elseif ( is_month() ) :
						printf( __( 'Month: %s', 'hopeforjustice-2014' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'hopeforjustice-2014' ) ) . '</span>' );

					elseif ( is_year() ) :
						printf( __( 'Year: %s', 'hopeforjustice-2014' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'hopeforjustice-2014' ) ) . '</span>' );


					else :
						_e( 'Archives', 'hopeforjustice-2014' );

					endif;
					?>
				</h1>
				<?php
								// Show an optional term description.
				$term_description = term_description();
				if ( ! empty( $term_description ) ) :
					printf( '<div class="archive__tax-disc">%s</div>', $term_description );
				endif;
				?>
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
