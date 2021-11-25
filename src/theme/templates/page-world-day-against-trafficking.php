<?php
/**
 * Template Name: World day against trafficking
 * 
 * @package hopeforjustice-2014
 */

get_header(); ?>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet">
	<main id="main" class="site-main" role="main" style="background-color: white;">
		<div class="world-day">
			<div class="inner">
				<div class="world-day__content">
					<div class="world-day__logo"><img src="https://hopeforjustice.org/wp-content/uploads/2020/07/wdat.svg"></div>
					<h1 class="world-day__title">Write a letter to a child who is now free from trafficking</h1>
					<p class="world-day__sub-title">Millions of children are trafficked every year. We are working across the globe to set them free and to restore their dreams. To mark World Day Against Trafficking in Persons, we would love you to join with us in bringing life, hope and joy to the children in our care by writing a letter to a survivor, sharing what is on your heart.</p>

					<p class="world-day__sub-title-2">Leave a legacy of love that will empower and uplift a child every time they read it.</p>
			        <?php if($GLOBALS['userInfo'] && in_array($GLOBALS['userInfo'], $GLOBALS['usa'])){ ?>
                    <?php the_field('usa_form'); ?>  
                    <?php } else { ?>
                    <?php the_field('uk_form'); ?>
                    <?php } ?>
					<a style="display:none;" class="world-day__example">See example letters here</a>
				</div>
			</div>

		</div>


	</main>


<?php get_footer(); ?>