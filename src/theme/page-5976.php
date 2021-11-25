<?php
/**
 * The template used for /donate-uk-once
 *
 * Root Donate page is a redirect which should point you to the correct page based on your location...
 * 
 * @package hopeforjustice-2014
 */

get_header();?>
<section class="site-main donate-uk donate-uk__secondimg" role="main">

    <?php while ( have_posts() ) : the_post(); ?>
<script type="text/javascript" src="https://js.stripe.com/v3/"></script>

<div class="inner">


    <div class="donate-uk__wrapper">

        <div class="donate-uk__select">

            <div class="donate-uk__msgwrap">
                <div class="donate-uk__message">
                        <h1 class="donate-uk__msgheader" id="donate-uk__msgheader">Fund <strong class="donate-uk__orange">Freedom</strong></h1>
                        <p id="donate-uk__msgp">Your gift can change lives and end slavery.<br><br><strong class="donate-uk__orange">£25</strong> – Could provide meals for a week for a child at one of our Lighthouses as they are protected from exploitation<br><br><strong class="donate-uk__orange">£50</strong> – Could provide emergency shelter and care for a vulnerable child for one month<br><br><strong class="donate-uk__orange">£5,000</strong> – Could enable our team to run an entire investigative operation to identify and rescue a child or adult from modern slavery</p>
                </div>
            </div>

            <div class="donate-uk__formwrap">
                <div class="donate-uk__errorTxt"></div>
                    <ul class="donate-uk__options">        
                        <li><a class="button button--hollow button--orange button--lefthalf" id="donate-monthly-select">Monthly</a></li>
                        <li><a class="button button--solid button--orange button--righthalf" id="donate-one-off-select">One Off</a></li>
                    </ul>

                    <ul class="donate-uk__forminner">
                    <a style="text-decoration: underline;" class="donate-uk__orange" id="givingAmountLink">Giving <strong class="donate-uk__orange" id="display">  </strong> Once (click to change)</a>
                        <li>
                            
                        </li>

                        <li>
                            <div class="donate-uk__form">
                                 
                            <form method="post" id="CreditCardForm" style="display: none;">
                                            
                                                
                                            <h3 class="donate-uk__hidden">step1</h3>
                                            <section class="donate-uk__tab">
                                                <div>
                                                    <div class="donate-uk__amount__inner">
                                                        <input type="text" name="Amount" class="required numberOnly form-control donate-uk__amount" id="Amount" maxlength="10" placeholder="50">
                                                    </div>
                                                </div>
                                            </section>

                                            <h3 class="donate-uk__hidden">step2</h3>
                                            <section class="donate-uk__tab">

                                                <select type="text" name="Title" class="required" id="Title">
                                                                <option value="">-- Title --</option>
                                                                <option value="Mrs">Mrs</option>
                                                                <option value="Miss">Miss</option>
                                                                <option value="Ms">Ms</option>
                                                                <option value="Mr">Mr</option>
                                                                <option value="Dr">Dr</option>
                                                                <option value="Bishop">Bishop</option>
                                                                <option value="Councillor">Councillor</option>
                                                                <option value="Friar">Friar</option>
                                                                <option value="Sir">Sir</option>
                                                                <option value="Lady">Lady</option>
                                                                <option value="Pastor">Pastor</option>
                                                                <option value="Professor">Professor</option>
                                                                <option value="Rev">Rev</option>
                                                                <option value="Rev">Other</option>
                                                                
                                                </select>



                                                <input type="text" name="FirstName" class="required" id="FirstName" placeholder="First Name" maxlength="50"> 
                                
                                                <input type="text" name="LastName" class="required" id="LastName" placeholder="Last Name"maxlength="50"> 

                                                <input type="text" name="Email" class="required" type="email" id="Email" maxlength="50" placeholder="Email"> 

                                                <input type="text" name="Phone" class="" id="Phone" maxlength="50" placeholder="Phone"> 
                                
                                            </section>
                                            
                                            <h3 class="donate-uk__hidden">step3</h3>
                                            <section class="donate-uk__tab">

                                                <input type="text" class="" id="AddressSearch" maxlength="50" placeholder="Address search - use postcode"> 
                                
                                                <input type="text" name="Address1" class="" id="Address1" maxlength="50" placeholder="Address 1"> 
                                        
                                                <input type="text" name="Address2" class="" id="Address2" maxlength="50" placeholder="Address 2"> 

                                                <input type="text" name="Town" class="" id="Town" maxlength="50" placeholder="City"> 

                                                <input type="text" name="County" class="" id="County" maxlength="50" placeholder="County"> 

                                                <input type="text" name="Postcode" class="" id="Postcode" maxlength="10" placeholder="Postcode"> 

                                                <select name="Country" class="" id="Country" placeholder="Country">
                                                    <option disabled selected value> -- Country select -- </option>
                                                    <option value="Holland">Holland</option>
                                                    <option value="Germany">Germany</option>
                                                    <option value="France">France</option>
                                                    <option value="United Kingdom">United Kingdom</option>
                                                    <option value="Italy">Italy</option>
                                                    <option value="Spain">Spain</option>
                                                    <option value="New Zealand">New Zealand</option>
                                                    <option value="Australia">Australia</option>
                                                </select>

                                            </section>

                                            <h3 class="donate-uk__hidden">step4</h3>
                                            <section class="donate-uk__tab">

                                                <label style="font-size:12px; font-weight: 100;" class="" for="ExpiryMonth">Card Number</label>
                                                <div id="card-number" class="donate-uk__input"></div>

                                                <label style="font-size:12px; font-weight: 100;" class="" for="ExpiryMonth">Expiry Date (mm/yy)*</label>

                                                <div id="card-expiry" class="donate-uk__input"></div>
                                        
                                                <div id="card-cvc" class="donate-uk__input"></div>

                                                <p><input type="text" name="Why" id="Why" placeholder="What has inspired you to donate?"></p>
                                        
                                            </section>

                                        <h3 class="donate-uk__hidden">step4</h3>
                                        <section class="donate-uk__tab">
                                            
                                                
                                                <div class="donate-uk__hidden"><label><span>I want this gift to be a one off</span>
                                                    <input type="radio" id="OneOffPayment" name="PaymentType" value="OneOff" checked="checked">
                                                </label>
                                                <label><span>I want this gift to be an ongoing commitment to help</span>
                                                    <input type="radio" id="RecurringPayment" name="PaymentType" value="Recurring">
                                                </label></div>

                                        
                                                <div id="PaymentScheduleRow" style="display: none;">
                                                    
                                                        <label class="" for="CVC">I would like to donate*</label>
                                                        <br>
                                                        <label><span>Monthly</span>
                                                            <input type="radio" id="MonthlyPayment" name="PaymentSchedule" value="Monthly" checked="checked">
                                                        </label>
                                                        <label><span>Quarterly</span>
                                                            <input type="radio" id="QuarterlyPayment" name="PaymentSchedule" value="Quarterly">
                                                        </label>
                                                        <label><span>Annually</span>
                                                            <input type="radio" id="AnnualPayment" name="PaymentSchedule" value="Annually">
                                                        </label>
                                                    
                                                </div>
                                        


                                                <h1 class="donate-uk__orange mega donate-uk__yes">YES!</h1>
                                                <h4>I would like updates about how my money is making a difference, via:</h4>
                                                
                                                <div class="donate-uk__pref">
                                                        <label><input type="checkbox" value="2" class="KeepInTouch">&nbsp;Email
                                                        </label>
                                                        
                                                        <label><input type="checkbox" value="4" class="KeepInTouch">&nbsp;Post
                                                        </label>
                                                        
                                                        <label><input type="checkbox" value="8" class="KeepInTouch">&nbsp;Sms
                                                        </label>
                                                        
                                                        <label><input type="checkbox" value="16" class="KeepInTouch">&nbsp;Phone
                                                        </label>
                                                </div>
                                                <p class="go_cardlesstext">Tick the boxes if you wish Hope for Justice to contact you for the following purposes: To keep you informed of our ongoing activities, news, campaigns and appeals; and to invite you to events we think might interest you. You can unsubscribe from receiving communications at any time, or change your preferences, at: <a class="donate-uk__link">hopeforjustice.org/manage-your-preferences</a>
                                                <br><br>We will always store your personal information securely. We will use it to provide the service(s) you have requested, and communicate with you in the way(s) you have agreed to. We will only allow your information to be used by third parties working on our behalf. We will share your information if required to do so by law. For details see our <a class="donate-uk__link">Privacy Policy</a>.</p>


                                                <h1 class="donate-uk__giftaid donate-uk__orange">Gift Aid it!</h1>

                                                <h4><?php the_field('giftaid_h2'); ?><!--Tick yes to add 25p to every £1 you give at no cost to you!--></h4>
                                                
                                                <div class="donate-uk__pref">
                                                    <label><input type="radio" name="GiftAid" id="GiftAid" required>Yes</label>
                                                    <label><input type="radio" name="GiftAid" id="GiftAidno">No</label>
                                                </div>
                                                
                                                <div class="donate-uk__errorTxt" id="gift-aid-error"></div>
                                                    <div class="go_cardlesstext">Please add Gift Aid to all donations I’ve made to Hope for Justice in the past four years and all donations in future until I notify Hope for Justice otherwise. 
                                                    <br><br>
                                                   I confirm that I am a UK taxpayer and understand that if I pay less Income Tax and/or Capital Gains Tax than the amount of Gift Aid claimed on all my donations in the tax year, it is my responsibility to pay any difference.
                                                   <br><br>Hope for Justice will claim 25p on every £1 I donate.
                                                   <br><br>I confirm that this is my own money and I am not paying over donations made by third parties such as monies collected at an event, a company donation or a donation from a friend or family member.
                                                   <br><br>I am not receiving anything in return for my donation such as a book, prize or ticket.
                                                   <br><br>I am not making a donation as part of a sweepstake, raffle or lottery.
                                                   
                                                   <br><br><a href="/giftaid">Find out more about Gift Aid and eligibility</a>
                                                   <br><a href="http://hopeforjustice.org/wp-content/uploads/2019/07/GiftAid-Declaration.pdf">Download a printable Gift Aid form if you would prefer to post this into us</a>

                                                   </div>


                                                <div id="ErrorContainer" class="ErrorContainer">
                                                    <div style="color: red; font-size: 1.5em;" id="Errors"></div>
                                                </div>
                                                <div id="PleaseWait" style="display:none">Please wait ...</div>
                                                <input style="background-color: #F5BC26; border-color: #F5BC26;" class="button button--solid button--orange" type="submit" value="Donate" id="submitButton"> 
                                        

                                                    <!-- Hidden fields for tags --->
                                                    <input type="hidden" id="ActiveTags" value="" />
                                                    <input type="hidden" id="BlockedTags" value="" />
                                                    <!-- Do not change these values --->
                                                    <input type="hidden" id="PublishableKey" value="pk_live_SFebjgG48FeTTASNalyWIAHF" />
                                                    <input type="hidden" id="TenantCode" value="GO66X0NEL4" />
                                                    <input type="hidden" id="WidgetId" value="10fe2cbf-383e-6f05-b282-ff00004460b4" />
                                                    <input type="hidden" id="DonationPageId" value="" />
                                                    <input type="hidden" id="RedirectToPage" value="http://hopeforjustice.org/donate-thankyou-uk-once/" /> </form>
                                                <div id="spinner" style="display:none;"> <img id="img-spinner" src="http://cdn.donorfy.com/wwimages/loading.gif" alt="Loading" /> </div>
                                                                            </div>
                                        </section>
                        </li>
                    </ul>
                    
            </div>


        </div>

    </div>



        

</div>
</section>

<script>
function InitialiseForm() {}
</script>

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

<?php endwhile; // end of the loop. ?>
    
<?php get_footer(); ?>