<?php
/**
 * The template used for /news
 *
 * This template is used for the news landing page
 * 
 * @package hopeforjustice-2014
 */

get_header(); ?>

<div id="post-<?php the_ID(); ?>" <?php post_class('news outer--single'); ?>>

		<div class="inner">
			<header class="news__page-header">
				<h1 class="news__page-title mega"><?php the_title(); ?></h1>
			</header><!-- .entry-header -->


			<section class="colgroup-3 news__feat-news">
				<div class="colspan-2">
					<?php
					$post_object = get_field('feature_1');

					if( $post_object ): 
						// override $post
						$post = $post_object;
						setup_postdata( $post ); 

						?>
						<a href="<?php the_permalink(); ?>" class="story story--large">
						    <article>
						    	<?php
						    	if(has_post_thumbnail()) {
						    		// normal news page - so use the post thumbnail
						    		the_post_thumbnail( 'news-feature-large', array( 'class' => 'story__image' ) );	
					    		} elseif(get_field('background_image')) {
					    			// page content - so see if there's background image in the header of the page
					    			$image = get_field('background_image');
					    			echo '<img src="' . $image['sizes']['news-feature-large'] . '" class="story__image"  alt="' . $image['alt'] . '"/>';
				    			} elseif(get_field('background_colour')) {
				    				// page content - maybe there isn't a background image - so maybe see if there's a background colour
				    				echo '<div style="background-color:'.get_field('background_colour').';" class="story__background">&nbsp;</div>';
				    			}
				    			?>
				    			<div class="story__text">
							    	<?php hopeforjustice_2014_posted_date('story__date'); ?>			    			
							    	<h2 class="story__title"><?php the_title(); ?></h2>
						    	</div>
						    </article>
					    </a>
					    <?php wp_reset_postdata(); 
					endif; ?>
				</div>
				<div class="col">
					<?php
					$post_object = get_field('feature_2');

					if( $post_object ): 
						// override $post
						$post = $post_object;
						setup_postdata( $post ); 

						?>
						<a href="<?php the_permalink(); ?>" class="story">
						    <article>
						    	<?php
						    	if(has_post_thumbnail()) {
						    		// normal news page - so use the post thumbnail
						    		the_post_thumbnail( 'news-feature-small', array( 'class' => 'story__image' ) );	
					    		} elseif(get_field('background_image')) {
					    			// page content - so see if there's background image in the header of the page
					    			$image = get_field('background_image');
					    			echo '<img src="' . $image['sizes']['news-feature-small'] . '" class="story__image"  alt="' . $image['alt'] . '"/>';
				    			} elseif(get_field('background_colour')) {
				    				// page content - maybe there isn't a background image - so maybe see if there's a background colour
				    				echo '<div style="background-color:'.get_field('background_colour').';" class="story__background">&nbsp;</div>';
				    			}
				    			?>
				    			<div class="story__text">
							    	<?php hopeforjustice_2014_posted_date('story__date'); ?>			    			
							    	<h2 class="story__title"><?php the_title(); ?></h2>
						    	</div>
						    </article>
					    </a>

					    <?php wp_reset_postdata();
					endif;
					$post_object = get_field('feature_3');

					if( $post_object ): 
						// override $post
						$post = $post_object;
						setup_postdata( $post );
						?>
						<a href="<?php the_permalink(); ?>" class="story">
						    <article>
						    	<?php
						    	if(has_post_thumbnail()) {
						    		// normal news page - so use the post thumbnail
						    		the_post_thumbnail( 'news-feature-small', array( 'class' => 'story__image' ) );	
					    		} elseif(get_field('background_image')) {
					    			// page content - so see if there's background image in the header of the page
					    			$image = get_field('background_image');
					    			echo '<img src="' . $image['sizes']['news-feature-small'] . '" class="story__image"  alt="' . $image['alt'] . '"/>';
				    			} elseif(get_field('background_colour')) {
				    				// page content - maybe there isn't a background image - so maybe see if there's a background colour
				    				echo '<div style="background-color:'.get_field('background_colour').';" class="story__background">&nbsp;</div>';
				    			}
				    			?>
				    			<div class="story__text">
							    	<?php hopeforjustice_2014_posted_date('story__date'); ?>			    			
							    	<h2 class="story__title"><?php the_title(); ?></h2>
						    	</div>
						    </article>
					    </a>
					    <?php wp_reset_postdata(); 
					endif; ?>					
	
				</div>
			</section><!-- .news__feat-news -->


			<div class="colgroup-3">
				<div class="colspan-2">
					<section class="news__top-stories news__section">
						<h2 class="lined--large"><span>Top Stories</span></h2>
						<div class="row">
						<?php
						$posts = get_posts(array(
							'numberposts' => 2,
							'meta_query' => array(
						        array(
						            'key' => 'news_options', // name of custom field
						            'value' => '"top-story"',
						            'compare' => 'LIKE'
						        )
						    )
						));

						if($posts) :
							foreach($posts as $post) :
								// get the category array
								setup_postdata( $post );
								$category = get_the_category();
								$storytype = $category[0]->cat_name; 
								?>
								
								<article class="col teaser">
								<?php if(has_post_thumbnail( $post->ID )) : ?>
									<a href="<?php the_permalink() ?>">
										<?php the_post_thumbnail('news-feature-small'); ?>
									</a>
								<?php endif; ?>
								<h3 class="teaser__title">
									<span class="teaser__type"> <?php echo $storytype ?> : </span>
									<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
								</h3>
								<div class="teaser__meta">
									<span class="teaser__author">
										<?php if(get_field('news_source')) {
											the_field('news_source');
										} else {
											the_author();
										} ?>
									</span>
									<span class="teaser__date"> &mdash; <?php hopeforjustice_2014_posted_date('teaser__date'); ?> </span>
								</div>
								<?php the_excerpt();?>								
								</article>
							<?php endforeach;

						wp_reset_postdata();
						endif; ?>
						</div>
						<a class="news__archive-link button button--gray button--solid" href="/news/category/news/">More News</a>
					</section><!--/.news__top-stories-->

					<section class="news__feat-films news__section">
						<h2 class="lined--small"><span>Featured Films</span></h2>
						<div class="row">
						<?php
						$post_object = get_field('featured_film_2');

						if( $post_object ): 
							// override $post
							$post = $post_object;
							setup_postdata( $post ); 

							?>
							<div class="col">
								<a href="<?php the_permalink(); ?>" class="story">
								    <article>
						    			<?php the_post_thumbnail( 'news-feature-small', array( 'class' => 'story__image' ) ); ?>
						    			<div class="story__text">
									    	<?php hopeforjustice_2014_posted_date('story__date'); ?>			    			
									    	<h3 class="story__title"><?php the_title(); ?></h3>
								    	</div>
								    </article>
							    </a>
						    </div>

						    <?php 
					    	wp_reset_postdata();
						endif; 
						
						$post_object = get_field('featured_film_1');

						if( $post_object ): 
							// override $post
							$post = $post_object;
							setup_postdata( $post ); 

							?>
							<div class="col">
								<a href="<?php the_permalink(); ?>" class="story">
								    <article>
						    			<?php the_post_thumbnail( 'news-feature-small', array( 'class' => 'story__image' ) ); ?>
						    			<div class="story__text">
									    	<?php hopeforjustice_2014_posted_date('story__date'); ?>			    			
									    	<h3 class="story__title"><?php the_title(); ?></h3>
								    	</div>
								    </article>
							    </a>
						    </div>

						    <?php 
						    wp_reset_postdata(); 
						endif; ?>
						</div>
						<a class="news__archive-link button button--gray button--solid" href="/news/category/films/">More Films</a>											
					</section><!--/.news__feat-films-->

					<section class="news__blogs news__section">
						<h2 class="lined--small"><span>Blogs &amp; Opinion Editorials</span></h2>
						<div class="row">
						<?php 

						$posts = get_posts(array(
							'posts_per_page'	=> 7,
							'category'			=> '11,8'
						));

						if( $posts ): ?>
							
							<div class="col">
							<?php foreach( array_slice($posts, 0, 2) as $post ): 
								
								setup_postdata( $post )
								
								?>
								<article class="teaser--small">
									<h3 class="teaser__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<?php the_excerpt();?>
								</article>
							
							<?php endforeach; ?>
							</div>
							<div class="col">
								<ul class="news__blogs-list">
									<?php 
									foreach( array_slice($posts, 2, 10) as $post ): 
									setup_postdata( $post )
									?>
										<li class="teaser--small">
											<h3 class="teaser__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
										</li>
									
									<?php endforeach; ?>
								</ul>

							</div>
							<?php wp_reset_postdata();
						endif; ?>
						</div>
						<a class="news__archive-link button button--gray button--solid" href="/news/category/blogs/">More Blogs</a>
					</section><!--/news__blogs-->

					<section class="news__press news__section">
						<h3 class="lined--small"><span>In the Headlines</span></h3>
						<div class="row">
							<div class="col">
							<?php							
							if(have_rows('media_links')) : ?>

									<?php 
									$j = 1;
									while ( have_rows('media_links') ) : the_row();
										if ($j == 1) {
											if(get_sub_field('image')):	
												$image = get_sub_field('image');
												echo '<div class="teaser"><a href="'. get_sub_field('url') .'" class="teaser__img-link"><img src="' . $image['sizes']['news-feature-small'] . '" alt="' . $image['alt'] . '" /></a>';
											endif;
											echo '<h3 class="teaser__title"><a href="' . get_sub_field('url') . '">' . get_sub_field('title') . '</a></h3>';
											echo '<div class="teaser__meta"><span class="teaser__author press__source">' . get_sub_field('source') . '</span> &ndash; <span class="press__date">' . get_sub_field('date') . '</span></div>';
											echo '</div></div>';
											echo '<div class="col"><ul class="news__press-list">';
										} else {
											echo '<li class="teaser--small"><span class="teaser__author">' . get_sub_field('source') . '</span>: ';
											echo '<a href="' . get_sub_field('url') .'" target="_blank">' . get_sub_field('title') . '</a></li>';
										}
									$j++;
								    endwhile;
								    echo '</ul>';

									if(get_field('press_disclaimer')) {
									    echo '<p class="news__disclaimer">' . get_field('press_disclaimer') . '</p>';
									}
								    ?>
							<?php
							else :
							    echo '<p>No media stories</p>';
							endif;
							?>
						    </div>
					    </div>
					</section><!--/.news__press-->
					<a class="news__archive-link button button--gray button--solid" href="/news/archive">Press, News &amp; Media Archive</a>
				</div>
				<div class="col">
					<div class="follow">
						<h3 class="lined--small"><span>Follow Us</span></h3>
						<ul class="follow__list">
							<li class="follow__item"><a href="<?php the_field('twitter', 'option'); ?>" class="follow__link follow__twitter gi-twitter"><span class="accessibility">Follow us on Twitter</span></a></li>
							<li class="follow__item"><a href="<?php the_field('facebook', 'option'); ?>" class="follow__link follow__facebook gi-facebook" target="_blank"><span class="accessibility">Follow us on Facebook</span></a></li>
							<li class="follow__item"><a href="<?php the_field('linkedin', 'option'); ?>" class="follow__link follow__linkedin gi-linkedin" target="_blank"><span class="accessibility">Follow us on Linkedin</span></a></li>
							<li class="follow__item"><a href="<?php the_field('vine', 'option'); ?>" class="follow__link follow__vine gi-vine" target="_blank"><span class="accessibility">Follow us on Vine</span></a></li>
							<li class="follow__item"><a href="<?php the_field('youtube', 'option'); ?>" class="follow__link follow__youtube gi-youtube" target="_blank"><span class="accessibility">Subscribe to our Youtube Channel</span></a></li>
							<li class="follow__item"><a href="<?php the_field('instagram', 'option'); ?>" class="follow__link follow__instagram gi-instagram" target="_blank"><span class="accessibility">Follow us on Instagram</span></a></li>
						</ul>
					</div>
					<div class="newsletter form--hidden-label">
						<h3 class="lined--small"><span>Get Email Updates</span></h3><a href="/signup/" class="button button--solid  push--bottom button--block button--blue">Sign Up</a>
					</div>
					<div class="tweets">
						<h3 class="lined--small"><span>Recent Tweets</span></h3>
						<a class="gi-hfj tweets__link" href="<?php the_field('twitter', 'option'); ?>"><span class="tweets__title">Hope for Justice</span><span class="tweets__handle"><?php the_field('twitter_handle', 'option'); ?></span></a>
						<?php echo do_shortcode( '[tweets max=1 user=hopeforjustice]' );?>
					</div>
					<div class="news__ads">
						<?php							
						if(have_rows('adverts')) :
							while ( have_rows('adverts') ) : the_row();
								if(get_sub_field('ad_image')):	
									$image = get_sub_field('ad_image');
									echo '<a class="news-ad" href="'. get_sub_field('ad_url') .'"><img src="' . $image['sizes']['ad-large'] . '" alt="' . $image['alt'] . '" class="news-ad__img" />';
								endif;
								echo '<div class="news-ad__button ' . get_sub_field('ad_button_colour') .'">'. get_sub_field('ad_button_label') . '</div>';
								echo '</a>';
						    endwhile;
						endif;
						?>
					</div>
					<div class="news__contact">
						<h3 class="lined--small"><span>Contact Press</span></h3>
						<div class="contact">
						<div class="contact-row">
							<span class="contact-label">Email: </span>
							<span class="contact-detail"><a href="mailto:<?php the_field('press_email', 'option'); ?>"><?php the_field('press_email', 'option'); ?></a></span>
						</div>
						<div class="contact-row">
							<span class="contact-label">Tel: </span>
							<span class="contact-detail">
								<?php 
								$chars = array(" ", "(", ")", "-");

								$telLinkUK = str_replace($chars, "", get_field('press_telephone_uk', 'option'));
								$telLinkUS = str_replace($chars, "", get_field('press_telephone_us', 'option'));
								?>
								<a href="tel:<?php echo $telLinkUK; ?>">UK <?php the_field('press_telephone_uk', 'option'); ?></a>
								<a href="tel:<?php echo $telLinkUS; ?>">US <?php the_field('press_telephone_us', 'option'); ?></a>
							</span>
						</div>
					</div>
				</div>
			</div><!-- /.colgroup-3 -->
		</div>

</div><!-- #post-## -->
<?php get_footer(); ?>