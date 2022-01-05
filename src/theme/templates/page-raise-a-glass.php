<?php
/**
 * Template Name: Raise a glass
 * 
 * @package hopeforjustice-2014
 */
get_header();
?>



<main id="main" class="site-main rag" role="main">

<div style="background-image: url('<?php the_field('background'); ?>');" class="rag-hero">
    <a href="/"><img class="rag-hero__logo" src="https://archive.hopeforjustice.org/wp-content/uploads/2021/10/logo-white-new.svg"></a>
</div>


<div class="rag-description">
    <h1 class="rag-description__header"><?php the_field('title'); ?></h1>
    <p><?php the_field('description'); ?></p>
</div>


<?php
    $cards = get_field('cards'); // parent group
    $card_1 = $cards['card_1']; // child group
    $card_2 = $cards['card_2']; // child group 
    $card_3 = $cards['card_3']; // child group 
    $card_4 = $cards['card_4']; // child group 
?>
 


<div class="rag-prices">

    <div class="rag-prices__card">
        <div class="rag-prices__price"><?php echo $card_1['card_1_price'];?></div>
        <div class="rag-prices__description"><?php echo $card_1['card_1_description'];?></div>
        <div text="<?php echo $card_1['card_1_text'];?>" value="<?php echo $card_1['card_1_value'];?>" data-toggle="modal" data-backdrop="static" data-target="#payment-modal" class="rag-prices__button">Donate <?php echo $card_1['card_1_price'];?></div>
    </div>
    <div class="rag-prices__card">
        <div class="rag-prices__price"><?php echo $card_2['card_2_price'];?></div>
        <div class="rag-prices__description"><?php echo $card_2['card_2_description'];?></div>
        <div text="<?php echo $card_2['card_2_text'];?>" value="<?php echo $card_2['card_2_value'];?>" data-toggle="modal" data-backdrop="static" data-target="#payment-modal" class="rag-prices__button">Donate <?php echo $card_2['card_2_price'];?></div>
    </div>
    <div class="rag-prices__card">
        <div class="rag-prices__price"><?php echo $card_3['card_3_price'];?></div>
        <div class="rag-prices__description"><?php echo $card_3['card_3_description'];?></div>
        <div text="<?php echo $card_3['card_3_text'];?>" value="<?php echo $card_3['card_3_value'];?>" data-toggle="modal" data-backdrop="static" data-target="#payment-modal" class="rag-prices__button">Donate <?php echo $card_3['card_3_price'];?></div>
    </div>
    <div class="rag-prices__card">
        <div class="rag-prices__price"><?php echo $card_4['card_4_price'];?></div>
        <div class="rag-prices__description"><?php echo $card_4['card_4_description'];?></div>
        <div text="<?php echo $card_4['card_4_text'];?>" value="<?php echo $card_4['card_4_value'];?>" data-toggle="modal" data-backdrop="static" data-target="#payment-modal" class="rag-prices__button">Donate <?php echo $card_4['card_4_price'];?></div>
    </div>

    <div class="rag-prices__card rag-prices__custom">
        <div class="rag-prices__price">Custom amount</div>
        <div class="rag-prices__description">Enter a custom<br>amount to donate</div>
        <div class="rag-prices__custom-amount">
            <input id="ragInput" type="number" name="customAmount">
        </div>
        <div id="ragButton" data-toggle="modal" data-backdrop="static" data-target="#payment-modal" class="rag-prices__button">Custom amount</div>
    </div>
</div>


<div class="modal fade" id="payment-modal" tabindex="-1" role="dialog" aria-hidden="false">
  <div class="modal__dialog">
    <div class="modal__content">
        <div style="margin-bottom: 20px; "><a style="font-size: 12px; font-weight: 300; text-decoration: underline; text-decoration: underline; cursor: pointer;" data-dismiss="modal">Giving $<span id="textAmount"></span> Once (click to change)</a></div>
        <?php the_field('form'); ?>
        <a href="" data-dismiss="modal" class="gi-close modal__close"><span class="accessibility">Close</span></a>
    </div>
    </div>
</div>


</main>


<?php get_footer(); ?>