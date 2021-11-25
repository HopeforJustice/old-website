<?php
/**
 * Template Name: Christmas
 *
 * Root Donate page is a redirect which should point you to the correct page based on your location...
 * 
 * @package hopeforjustice-2014
 */

get_header();?>



<?php if($GLOBALS['userInfo'] && in_array($GLOBALS['userInfo'], $GLOBALS['usa'])){ ?>
<!-- USA -->

<?php while ( have_posts() ) : the_post(); ?>       

<?php

$thumbnail = '';

// Get the ID of the post_thumbnail (if it exists)
$post_thumbnail_id = get_post_thumbnail_id($post->ID);

$uk = get_field('uk'); //acf group
$usa = get_field('usa'); //acf group
$norway = get_field('norway'); //acf group

// if it exists
if ($post_thumbnail_id) {
    $thumbnail = wp_get_attachment_image_src($post_thumbnail_id, 'hero_full', false, '');
} ?>

<main id="main" class="site-main christmas" role="main">



    <div class="christmas__header" style="background-image: url('<?php echo $thumbnail[0]; ?>');">
        <div class="christmas__buttons">
            <a data-toggle="modal" data-target="#video-modal" class="button button--solid button--large button--black">
            <?php echo $usa['button_text'];?>
            </a>
            <a id="christmasDonate" class="button button--solid button--large button--red">
                <?php echo $usa['button_2_text'];?>
            </a>
        </div>
    </div>

    <div class="inner">
        <div class="christmas__info">
            <h2 class="christmas__h">
            <?php echo $usa['header_below_hero'];?>
            </h2>
            <p class="christmas__p">
            <?php echo $usa['text_below_hero'];?>
            </p>
        </div>
    </div>

    <div class="inner">
        <div class="christmas__donation">
            <!-- giving widget -->
            <div class="christmas__widget-container">
                <div class="giving-widget christmas__widget">
                    <div class="giving-widget__body">
                        <div class="giving-widget__content">
                            <div class="giving-widget__options">
                                <div msg="
                                <?php echo $usa['first_button_description'];?>
                                " value="<?php echo $usa['first_button_value'];?>" class="giving-widget__option giving-widget__option--active">
                                    <?php echo $usa['first_button_amount'];?></div>
                                <div msg="
                                <?php echo $usa['second_button_description'];?>
                                " value="<?php echo $usa['second_button_value'];?>" class="giving-widget__option"><?php echo $usa['second_button_amount'];?></div>
                                <div msg="
                                <?php echo $usa['third_button_description'];?>
                                " value="<?php echo $usa['third_button_value'];?>" class="giving-widget__option"><?php echo $usa['third_button_amount'];?></div>
                            </div> 
                            <div class="giving-widget__custom-amount christmas__amount giving-widget__custom-amount--pre-dolar">
                                <input type="text" name="Amount" class="required numberOnly form-control donate-uk__amount" id="Amount" maxlength="10" value="<?php echo $usa['first_button_value'];?>">
                            </div>
                            <a id="unlock-freedom" data-toggle="modal" data-target="#payment-modal" class="button button--solid button--black donate-uk__modal-trig" href=""><?php echo $uk['donate_button_text'];?></a>
                        </div>
                    </div>
                    <div class="christmas-widget__footer">
                        <div><b id="footer-amount">$25</b> <span id="footer-msg">
                        <?php echo $usa['first_button_description'];?>
                        </span></div>
                    </div>
                </div>
            </div><!-- /giving widget -->

            
            <div class="christmas__your-donation" style=" background-image: url('<?php echo $usa['second_section_image'];?>');">
                <h2 class="christmas__h"><?php echo $usa['second_header'];?></h2>
                <p class="christmas__p"><?php echo $usa['second_text'];?></p>
            </div>
        </div>
    </div>

    <div class="christmas__footer">
        <div class="inner">
            <h2 class="christmas__h"><?php echo $usa['footer_title'];?></h2>
            <p class="christmas__p"><?php echo $usa['footer_text_1'];?></p>
            <img src="<?php echo $usa['footer_image'];?>">
            <p><?php echo $usa['footer_text_2'];?></p>
        </div>
    </div>

</main><!-- #main  -->

<!-- Modal payment -->
<div class="modal fade" id="payment-modal" tabindex="-1" role="dialog" aria-hidden="false">
  <div class="modal__dialog">
    <div class="modal__content">
        <div style="margin-bottom: 20px; "><a style="font-size: 12px; font-weight: 300; text-decoration: underline; text-decoration: underline; cursor: pointer;" data-dismiss="modal">Giving $<span id="textAmount"></span> Once (click to change)</a></div>
        <?php echo do_shortcode('[gravityform id="77" title="false" description="false" ajax="true" field_values="Campaign=The Gift of Hope 2021"]');?>
        <a href="#" data-dismiss="payment-modal" class="gi-close modal__close"><span class="accessibility">Close</span></a>
    </div>
    
</div>

<?php endwhile; // end of the loop. ?>


<?php } else if($GLOBALS['userInfo'] && in_array($GLOBALS['userInfo'], $GLOBALS['norway'])){ ?>

<?php while ( have_posts() ) : the_post(); ?>       

<?php

$thumbnail = '';

// Get the ID of the post_thumbnail (if it exists)
$post_thumbnail_id = get_post_thumbnail_id($post->ID);

$uk = get_field('uk'); //acf group
$usa = get_field('usa'); //acf group
$norway = get_field('norway'); //acf group

// if it exists
if ($post_thumbnail_id) {
    $thumbnail = wp_get_attachment_image_src($post_thumbnail_id, 'hero_full', false, '');
} ?>

<!-- norway -->

<main id="main" class="site-main christmas" role="main">



    <div class="christmas__header" style="background-image: url('<?php echo $thumbnail[0]; ?>');">
        <div class="christmas__buttons">
            <a data-toggle="modal" data-target="#video-modal" class="button button--solid button--large button--black">
            <?php echo $norway['button_text'];?>
            </a>
            <a id="christmasDonate" class="button button--solid button--large button--red">
                <?php echo $norway['button_2_text'];?>
            </a>
        </div>
    </div>

    <div class="inner">
        <div class="christmas__info">
            <h2 class="christmas__h">
            <?php echo $norway['header_below_hero'];?>
            </h2>
            <p class="christmas__p">
            <?php echo $norway['text_below_hero'];?>
            </p>
        </div>
    </div>

    <div class="inner">
        <div class="christmas__donation">
            <!-- giving widget -->
            <div class="christmas__widget-container">
                <div class="giving-widget christmas__widget">
                    <div class="giving-widget__body">
                        <div class="giving-widget__content">
                            <div class="giving-widget__options">
                                <div msg="
                                <?php echo $norway['first_button_description'];?>
                                " value="<?php echo $norway['first_button_value'];?>" class="giving-widget__option giving-widget__option--active">
                                    <?php echo $norway['first_button_amount'];?></div>
                                <div msg="
                                <?php echo $norway['second_button_description'];?>
                                " value="<?php echo $norway['second_button_value'];?>" class="giving-widget__option"><?php echo $norway['second_button_amount'];?></div>
                                <div msg="
                                <?php echo $norway['third_button_description'];?>
                                " value="<?php echo $norway['third_button_value'];?>" class="giving-widget__option"><?php echo $norway['third_button_amount'];?></div>
                            </div> 
                            <div class="giving-widget__custom-amount christmas__amount giving-widget__custom-amount--pre-kr">
                                <input type="text" name="Amount" class="required numberOnly form-control donate-uk__amount" id="Amount" maxlength="10" value="<?php echo $norway['first_button_value'];?>">
                            </div>
                            <a id="unlock-freedom" data-toggle="modal" data-target="#payment-modal" class="button button--solid button--black donate-uk__modal-trig" href=""><?php echo $uk['donate_button_text'];?></a>
                        </div>
                    </div>
                    <div class="christmas-widget__footer">
                        <div><b id="footer-amount">250kr</b> <span id="footer-msg">
                        <?php echo $norway['first_button_description'];?>
                        </span></div>
                    </div>
                </div>
            </div><!-- /giving widget -->

            
            <div class="christmas__your-donation" style=" background-image: url('<?php echo $norway['second_section_image'];?>');">
                <h2 class="christmas__h"><?php echo $norway['second_header'];?></h2>
                <p class="christmas__p"><?php echo $norway['second_text'];?></p>
            </div>
        </div>
    </div>

    <div class="christmas__footer">
        <div class="inner">
            <h2 class="christmas__h"><?php echo $norway['footer_title'];?></h2>
            <p class="christmas__p"><?php echo $norway['footer_text_1'];?></p>
            <img src="<?php echo $norway['footer_image'];?>">
            <p><?php echo $norway['footer_text_2'];?></p>
        </div>
    </div>

</main><!-- #main  -->

<!-- Modal payment -->
<div class="modal fade" id="payment-modal" tabindex="-1" role="dialog" aria-hidden="false">
  <div class="modal__dialog">
    <div class="modal__content">
        <div style="margin-bottom: 20px; "><a style="font-size: 12px; font-weight: 300; text-decoration: underline; text-decoration: underline; cursor: pointer;" data-dismiss="modal">Giving <span id="textAmount"></span>Kr Once (click to change)</a></div>
        <?php echo do_shortcode('[gravityform id="71" title="false" description="false" ajax="true" field_values="Campaign=The Gift of Hope 2021"]');?>
        <a href="#" data-dismiss="payment-modal" class="gi-close modal__close"><span class="accessibility">Close</span></a>
    </div>
    
</div>

<?php endwhile; // end of the loop. ?>
  
<?php } else { ?>
<!-- rest of the world / uk -->

<?php while ( have_posts() ) : the_post(); ?>       

<?php

$thumbnail = '';

// Get the ID of the post_thumbnail (if it exists)
$post_thumbnail_id = get_post_thumbnail_id($post->ID);

$uk = get_field('uk'); //acf group
$usa = get_field('usa'); //acf group
$norway = get_field('norway'); //acf group

// if it exists
if ($post_thumbnail_id) {
    $thumbnail = wp_get_attachment_image_src($post_thumbnail_id, 'hero_full', false, '');
} ?>


<main id="main" class="site-main christmas" role="main">



    <div class="christmas__header" style="background-image: url('<?php echo $thumbnail[0]; ?>');">
        <div class="christmas__buttons">
            <a data-toggle="modal" data-target="#video-modal" class="button button--solid button--large button--black">
            <?php echo $uk['button_text'];?>
            </a>
            <a id="christmasDonate" class="button button--solid button--large button--red">
                <?php echo $uk['button_2_text'];?>
            </a>
        </div>
    </div>

    <div class="inner">
        <div class="christmas__info">
            <h2 class="christmas__h">
            <?php echo $uk['header_below_hero'];?>
            </h2>
            <p class="christmas__p">
            <?php echo $uk['text_below_hero'];?>
            </p>
        </div>
    </div>

    <div class="inner">
        <div class="christmas__donation">
            <!-- giving widget -->
            <div class="christmas__widget-container">
                <div class="giving-widget christmas__widget">
                    <div class="giving-widget__body">
                        <div class="giving-widget__content">
                            <div class="giving-widget__options">
                                <div msg="
                                <?php echo $uk['first_button_description'];?>
                                " value="<?php echo $uk['first_button_value'];?>" class="giving-widget__option giving-widget__option--active">
                                    <?php echo $uk['first_button_amount'];?></div>
                                <div msg="
                                <?php echo $uk['second_button_description'];?>
                                " value="<?php echo $uk['second_button_value'];?>" class="giving-widget__option"><?php echo $uk['second_button_amount'];?></div>
                                <div msg="
                                <?php echo $uk['third_button_description'];?>
                                " value="<?php echo $uk['third_button_value'];?>" class="giving-widget__option"><?php echo $uk['third_button_amount'];?></div>
                            </div> 
                            <div class="giving-widget__custom-amount christmas__amount">
                                <input type="text" name="Amount" class="required numberOnly form-control donate-uk__amount" id="Amount" maxlength="10" value="<?php echo $uk['first_button_value'];?>">
                            </div>
                            <a id="unlock-freedom" data-toggle="modal" data-target="#payment-modal" class="button button--solid button--black donate-uk__modal-trig" href=""><?php echo $uk['donate_button_text'];?></a>
                        </div>
                    </div>
                    <div class="christmas-widget__footer">
                        <div><b id="footer-amount">£25</b> <span id="footer-msg">
                        <?php echo $uk['first_button_description'];?>
                        </span></div>
                    </div>
                </div>
            </div><!-- /giving widget -->

            
            <div class="christmas__your-donation" style=" background-image: url('<?php echo $uk['second_section_image'];?>');">
                <h2 class="christmas__h"><?php echo $uk['second_header'];?></h2>
                <p class="christmas__p"><?php echo $uk['second_text'];?></p>
            </div>
        </div>

    </div>

    <div class="christmas__footer">
        <div class="inner">
            <h2 class="christmas__h"><?php echo $uk['footer_title'];?></h2>
            <p class="christmas__p"><?php echo $uk['footer_text_1'];?></p>
            <img src="<?php echo $uk['footer_image'];?>">
            <p><?php echo $uk['footer_text_2'];?></p>
        </div>
    </div>

</main><!-- #main  -->

<!-- Modal payment -->
<div class="modal fade" id="payment-modal" tabindex="-1" role="dialog" aria-hidden="false">
  <div class="modal__dialog">
    <div class="modal__content">
        <div style="margin-bottom: 20px; "><a style="font-size: 12px; font-weight: 300; text-decoration: underline; text-decoration: underline; cursor: pointer;" data-dismiss="modal">Giving £<span id="textAmount"></span> Once (click to change)</a></div>
        <?php echo do_shortcode('[gravityform id="69" title="false" description="false" ajax="true" field_values="Campaign=The Gift of Hope 2021"]');?>
        <a href="#" data-dismiss="payment-modal" class="gi-close modal__close"><span class="accessibility">Close</span></a>
    </div>
    
</div>

<?php endwhile; // end of the loop. ?>


<?php } ?>

<!-- Modal video -->
<div class="modal fade video-modal" id="video-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="video-modal__dialog">
    <div class="video-modal__content">
      <div class="video-modal__header">
      </div>
      <div id="christmas-video-uk" class="video-modal__body">
        <iframe id="video" width="560" height="315" src="<?php the_field('video_embed_source');?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
      <div class="video-modal__footer">
        <button type="button" class="video-modal__footer-close button button--solid button--large button--red" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<style type="text/css">
    .TickerNews, .ti_title {display: none;}
</style>


<?php get_footer(); ?>