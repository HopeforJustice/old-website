<?php
/**
 * The template used for /donate-us-once/ (USA SCA)
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
                            <?php

                            if(isset($_GET['BTC'])) { ?>
                                <h1 class="beta" id="donate-uk__msgheader">Fund Freedom</h1>
                                <p id="donate-uk__msgp">Your gift could help a trafficking victim here in Iowa or in our US / international programs.<br><br><strong class="donate-uk__orange">$250</strong> – Could provide materials vital to locating a missing and vulnerable child at risk of trafficking<br><br><strong class="donate-uk__orange">$500</strong> – Could provide medical care and medicine for 15 children at one of our Lighthouses throughout their whole stay<br><br><strong class="donate-uk__orange">$5,000</strong> – Could partially fund our expansion and investigations here in Iowa</p>
                            <?php } else { ?>
                                <h1 class="beta" id="donate-uk__msgheader">Fund Freedom</h1>
                                <p id="donate-uk__msgp">Your gift can change lives and end slavery.<br><br><strong class="donate-uk__orange">$25</strong> – Could provide meals for a week for a child at one of our Lighthouses as they are protected from exploitation<br><br><strong class="donate-uk__orange">$50</strong> – Could provide emergency shelter and care for a vulnerable child for one month<br><br><strong class="donate-uk__orange">$5,000</strong> – Could enable our team to run an entire investigative operation to identify and rescue a child or adult from modern slavery.</p>
                            <?php } ?>
                    </div>
                </div>


                <div class="donate-uk__formwrap">
                    <ul class="donate-uk__options">        
                        <li><a href="/donate/us?<?php if (isset($_GET['Campaign'])) {echo 'Campaign='. $_GET['Campaign'];}if (isset($_GET['Campaign'])) {echo '&Channel='. $_GET['Channel'];}?>" class="button button--hollow button--orange button--lefthalf" id="donate-monthly-select">Monthly</a></li>
                        <li><a href="/donate-us-once?<?php if (isset($_GET['Campaign'])) {echo 'Campaign='. $_GET['Campaign'];}if (isset($_GET['Campaign'])) {echo '&Channel='. $_GET['Channel'];}?>" class="button button--solid button--orange button--righthalf" id="donate-one-off-select">One Time</a></li>
                    </ul>
                    <div class="donate-uk__form">
                        <div class="donate-uk__currency"><a id="currency">Donation in US Dollars</a></div>     
                        <div class="donate-uk__amount__inner donate-uk__amount__inner--us">
                            <?php

                            if(isset($_GET['BTC'])) { ?>
                            <input type="text" name="Amount" class="required numberOnly form-control donate-uk__amount" id="Amount" maxlength="10" value="250.00">
                            <?php } else { ?>
                            <input type="text" name="Amount" class="required numberOnly form-control donate-uk__amount" id="Amount" maxlength="10" value="25.00">
                            <?php } ?>
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
            <a class="button button--blue button--solid"href="/become-a-guardian">Find out more</a>
        </div>
    </div>
</section>


<div class="modal fade" data-backdrop="static" id="payment-modal" tabindex="-1" role="dialog" aria-hidden="false">
  <div class="modal__dialog">
    <div class="modal__content">
        <div style="margin-bottom: 20px; "><a style="font-size: 12px; font-weight: 300; text-decoration: underline; text-decoration: underline; cursor: pointer;" data-dismiss="modal">Giving $<span id="textAmount"></span> Once (click to change)</a></div>
        <?php echo do_shortcode("[gravityform id=\"77\" title=\"false\" description=\"false\" ajax=\"true\"]"); ?>
        <a href="#" data-dismiss="parfait-modal" class="gi-close modal__close"><span class="accessibility">Close</span></a>
    </div>
    
 </div>
    
<?php get_footer(); ?>