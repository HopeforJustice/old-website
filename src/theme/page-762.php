<?php
/**
 * The template used for /donate UK
 *
 * Root Donate page is a redirect which should point you to the correct page based on your location...
 * 
 * @package hopeforjustice-2014
 */

get_header();?>
<div id="video-overlay" class="video-overlay video-overlay--hidden">
    <iframe id="video" src="https://www.youtube.com/embed/vlorW93cBHI?&amp;loop=1&amp;rel=0&amp;controls=1&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    <div id="exit-thecla" class="exit-video button button--solid button--blue">Exit Video</div>
</div> 


<section class="donate-uk" role="main">

    <?php while ( have_posts() ) : the_post(); ?>



<div class="inner">


    <div class="donate-uk__wrapper">

        <div class="donate-uk__select">

            <div class="donate-uk__msgwrap">
                <div class="donate-uk__message">
                        <h1 class="beta" id="donate-uk__msgheader"><!--Become a <strong class="donate-uk__orange">GUARDIAN</strong>--><?php the_field('message_header_1'); ?></h1>
                        <p id="donate-uk__msgp"><!--There are 25 MILLION people trapped in forced labour, sex trafficking and domestic servitude. Become a GUARDIAN to unlock freedom for them and to get children back home to their families.
                        <br><br>Join us to prevent exploitation, rescue victims, restore lives and reform society. For £15 a month, or whatever you can afford to give, you can become a Hope for Justice GUARDIAN and help create a world free from slavery.--><?php the_field('message_p_1'); ?></p>
                        <div class="donate-uk__watch-video" id="watch-thecla"><div class="play play--thecla"></div>Watch Thecla's Story</div>
                </div>
            </div>

            <div class="donate-uk__formwrap">
                <div class="donate-uk__errorTxt"></div>
                    <ul class="donate-uk__options">        
                        <li><a href="/donate/uk?<?php if (isset($_GET['Campaign'])) {echo 'Campaign='. $_GET['Campaign'];}if (isset($_GET['Campaign'])) {echo '&Channel='. $_GET['Channel'];}?>" class="button button--solid button--orange button--lefthalf" id="donate-monthly-select">Monthly</a></li>
                        <li>
                            <a href="/donate-uk-once?<?php if (isset($_GET['Campaign'])) {echo 'Campaign='. $_GET['Campaign'];}if (isset($_GET['Campaign'])) {echo '&Channel='. $_GET['Channel'];}?>" class="button button--hollow button--orange button--righthalf" id="donate-one-off-select">One Off</a>
                        </li>
                    </ul>
                    <div class="donate-uk__forminner">
                        <div>
                            <div id="donation-donate-uk-form" class="donate-uk__form">
                                <div class="donate-uk__currency"><a id="currency">Donation in British Pounds</a></div>
                                <form method="post" id="DirectDebitForm">
                                    <div class="donate-uk__amount__inner">
                                        <input type="text" name="Amount" class="required numberOnly form-control donate-uk__amount" id="Amount" maxlength="10" placeholder="15" value="15">
                                    </div>
                                    <div class="donate-uk__button-container">
                                        <a data-link="https://hopeforjustice.org/go-cardless/?" data-vars="
                                            <?php
                                            if (isset($_GET['Campaign'])) {
                                                echo '&Campaign='. $_GET['Campaign'];
                                            }
                                            if (isset($_GET['Campaign'])) {
                                                echo '&Channel='. $_GET['Channel'];
                                            }
                                            ?>" 

                                        id="goCardless" class="button button--solid button--orange">Donate</a>
                                    </div>              
                                </form>
                            </div>
                        </div>
                    </div>
                    
            </div>


        </div>

    </div>






</div>
</section>

<section class="guardian-slice">
    <div class="inner">
        <div class="guardian-slice__info">
            <img class="guardian-slice__logo" src="https://hopeforjustice.org/wp-content/uploads/2019/07/guardian-dark.svg">
            <h3 class="guardian-slice__header">Become a GUARDIAN to invest in <br>a world free from slavery</h3>
            <p class="guardian-slice__p">By giving monthly, you will become part of our community of GUARDIANS, whose passion and financial commitment is enabling and empowering Hope for Justice’s life-changing anti-trafficking projects around the world.</p>
            <a class="button button--blue button--solid"href="/become-a-guardian-uk">Find out more</a>
        </div>
    </div>
   
</section>

<div class="modal fade" data-backdrop="static" id="payment-modal" tabindex="-1" role="dialog" aria-hidden="false">
  <div class="modal__dialog">
    <div class="modal__content">
        <div style="margin-bottom: 20px; "><a style="font-size: 12px; font-weight: 300; text-decoration: underline; text-decoration: underline; cursor: pointer;" data-dismiss="modal">Giving £<span id="textAmount"></span> Monthly (click to change)</a></div>
        <?php echo do_shortcode("[gravityform id=\"70\" title=\"false\" description=\"false\" ajax=\"false\"]"); ?>
        <a href="#" data-dismiss="parfait-modal" class="gi-close modal__close"><span class="accessibility">Close</span></a>
    </div>
 </div>
</div>

<!-- modal campaign -->
<div class="modal modal-campaign fade" id="campaign-modal" tabindex="-1" role="dialog" aria-hidden="false">
  <div class="modal__dialog">
    <div class="modal__content">
        <a href="#" data-dismiss="parfait-modal" class="gi-close modal__close"><span class="accessibility">Close</span></a>
        <h2>The Gift of Hope</h2>
        <p class="modal__text">Gifts to Hope for Justice via this link will be <b>DOUBLED</b> for a limited time thanks to our generous match-funders. You can give a victim of human trafficking the incredible gift of hope.</p>
        <a class="button button--red button--solid button--large" href="/thegiftofhope">Donate</a>
    </div>
    
 </div>
</div>

<?php endwhile; // end of the loop. ?>

    
<?php get_footer(); ?>