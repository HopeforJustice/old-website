<?php
/**
 * Template Name: Thank You
 * 
 * @package hopeforjustice-2014
 */

get_header(); ?>
<?php if($GLOBALS['userInfo'] && in_array($GLOBALS['userInfo'], $GLOBALS['norway'])){ ?>
<main id="main" style="padding-bottom: 200px; background-color: #ffffff;" class="site-main thanks__main" role="main">
    <div class="christmas__header christmas__thankyou-header">
        <div class="christmas__logo-container">
            <img class="christmas__logo christmas__logo-taak-norge" src="https://hopeforjustice.org/wp-content/uploads/2020/11/takk.svg">
        </div>
        <p class="christmas__thankyou-text">Din donasjon var vellykket. <br>Du vil straks motta en kvittering via email.</p>
        <div class="christmas__logo-container christmas__thankyou-unlock">
            <img class="christmas__logo" src="https://hopeforjustice.org/wp-content/uploads/2020/11/norwayhash.svg">
        </div>
    </div>
    <div class="christmas__snowman">
        <img src="https://hopeforjustice.org/wp-content/uploads/2020/11/snowman.svg">
    </div>
</main>

<?php } else { ?>
<main id="main" style="padding-bottom: 200px; background-color: #ffffff;" class="site-main thanks__main" role="main">
    <div class="christmas__header christmas__thankyou-header">
        <div class="christmas__logo-container">
            <img class="christmas__logo" src="https://hopeforjustice.org/wp-content/uploads/2020/11/thankyousvg.svg">
        </div>
        <p class="christmas__thankyou-text">Your donation has been successful. <br>You will receive a receipt via email shortly.</p>
        <div class="christmas__logo-container christmas__thankyou-unlock">
            <img class="christmas__logo" src="https://hopeforjustice.org/wp-content/uploads/2020/11/unlockfreedompink.svg">
        </div>
    </div>
    <div class="christmas__snowman">
        <img src="https://hopeforjustice.org/wp-content/uploads/2020/11/snowman.svg">
    </div>
</main>
<?php } ?>
<?php get_footer(); ?>