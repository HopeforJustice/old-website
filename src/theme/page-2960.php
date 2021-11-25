<?php
/**
 * The template used for UK one off donation /donate-uk-once 
 *
 * Root Donate page is a redirect which should point you to the correct page based on your location...
 * 
 * @package hopeforjustice-2014
 */

get_header();?>
<section class="site-main donate-uk donate-uk__secondimg" role="main">
    <div class="inner">
        <div class="donate-uk__wrapper">
                <div class="donate-uk__msgwrap">
                    <div class="donate-uk__message">
                            <h1 class="beta" id="donate-uk__msgheader">Fund <strong class="donate-uk__orange">Freedom</strong></h1>
                            <p id="donate-uk__msgp">Your gift can change lives and end slavery.<br><br><strong class="donate-uk__orange">£25</strong> – Could provide meals for a week for a child at one of our Lighthouses as they are protected from exploitation<br><br><strong class="donate-uk__orange">£50</strong> – Could provide emergency shelter and care for a vulnerable child for one month<br><br><strong class="donate-uk__orange">£5,000</strong> – Could enable our team to run an entire investigative operation to identify and rescue a child or adult from modern slavery</p>
                    </div>
                </div>

                <div class="donate-uk__formwrap">
                        <ul class="donate-uk__options">        
                            <li>
                                <a href="/donate/uk?<?php if (isset($_GET['Campaign'])) {echo 'Campaign='. $_GET['Campaign'];}if (isset($_GET['Campaign'])) {echo '&Channel='. $_GET['Channel'];}?>" class="button button--hollow button--orange button--lefthalf" id="donate-monthly-select">Monthly</a>
                            </li>
                            <li>
                                <a href="/donate-uk-once?<?php if (isset($_GET['Campaign'])) {echo 'Campaign='. $_GET['Campaign'];}if (isset($_GET['Campaign'])) {echo '&Channel='. $_GET['Channel'];}?>" class="button button--solid button--orange button--righthalf" id="donate-one-off-select">One Off</a>
                            </li>
                        </ul>
                        <div class="donate-uk__form">
                            <div class="donate-uk__currency"><a id="currency">Donation in British Pounds</a></div>
                            <div class="donate-uk__amount__inner">
                                <input type="text" name="Amount" class="required numberOnly form-control donate-uk__amount" id="Amount" maxlength="10" placeholder="50" value="50.00">
                            </div>
                            <div class="donate-uk__modal-trig"><a data-toggle="modal" data-target="#payment-modal" class="button button--solid button--orange">Donate</a></div>
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



<!-- Modal form 
<div class="modal fade payment-modal" id="payment-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="payment-modal__dialog">
    <div class="payment-modal__content">
      
      <div class="video-modal__header">
        <a href="#" data-dismiss="modal" class="gi-close video-modal__close campaign__video-modal__close"><span class="accessibility">Close</span></a>
      </div>
      
        <div class="payment-modal__body">
            <div class="payment-modal__payment">
                <a style="text-decoration: underline;" data-dismiss="modal">Giving £<span id="textAmount"></span> Once (click to change)</a>
                <?php //echo do_shortcode("[gravityform id=\"69\" title=\"false\" description=\"false\" ajax=\"true\"]"); ?>
            </div>
        </div>
    
    </div>
  </div>
</div>-->

<div class="modal fade" id="payment-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="false">
  <div class="modal__dialog">
    <div class="modal__content">
        <div style="margin-bottom: 20px; "><a style="font-size: 12px; font-weight: 300; text-decoration: underline; text-decoration: underline; cursor: pointer;" data-dismiss="modal">Giving £<span id="textAmount"></span> Once (click to change)</a></div>
        <?php echo do_shortcode("[gravityform id=\"69\" title=\"false\" description=\"false\" ajax=\"true\"]"); ?>
            <a href="#" data-dismiss="payment-modal" class="gi-close modal__close"><span class="accessibility">Close</span></a>
    </div>

 </div>
</div>

    
<?php get_footer(); ?>