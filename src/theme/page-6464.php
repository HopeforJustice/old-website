<?php
/**
 * The template used for /keep-hope-alive/ (USA SCA)
 *
 * Root Donate-uk page is a redirect which should point you to the correct page based on your location...
 * 
 * @package hopeforjustice-2014
 */

get_header();?>
<section class="site-main donate-uk donate-uk__secondimg" role="main">
<script type="text/javascript" src="https://js.stripe.com/v3/"></script>

<div class="inner">


    <div class="donate-uk__wrapper">

        <div class="donate-uk__select">

            <div class="donate-uk__msgwrap">
                <div class="donate-uk__message">
                        <h1 class="beta" id="donate-uk__msgheader-nochange">#KeepHopeAlive</h1>
                        <p id="donate-uk__msgp-nochange">This is an emergency appeal to keep Hope for Justice’s network of Lighthouses open throughout the next difficult months. We are fully committed to keeping our 11 Lighthouses running despite the coronavirus pandemic, but we can only do that with your support. Some of the most vulnerable people on the planet, children who have been trafficked or faced horrific circumstances living on the streets, depend on us all. 
                        <br><br>
                        Hope for Justice relies on public donations, but with events and fundraising challenges all cancelled or postponed, the services we offer to children are at risk. We know that many supporters are facing financial hardship and uncertainty at this time and may feel unable to contribute right now, and we completely understand. We just ask that you give what you can. We believe our light shines brightest in the darkness.</p>
                </div>
            </div>

            <div class="donate-uk__formwrap">
                <div class="donate-uk__errorTxt"></div>


                    <ul class="donate-uk__forminner">
                    <a style="text-decoration: underline;" class="donate-uk__orange" id="givingAmountLink">Giving <strong class="donate-uk__orange" id="display">  </strong> Once (click to change)</a>
                        <li>
                            
                        </li>

                        <li>
                            <div class="donate-uk__form">
                            <div class="donate-uk__currency"><a id="currency">Change Currency</a></div>     
                            <form method="post" id="CreditCardForm" style="display: none;">   
                                            <h3 class="donate-uk__hidden">step1</h3>
                                            <section class="donate-uk__tab">
                                                <div>
                                                    <div class="donate-uk__amount__inner donate-uk__amount__inner--us">
                                                        <input type="text" name="Amount" class="required numberOnly form-control donate-uk__amount" id="Amount" maxlength="10" value="100.00">
                                                    </div>
                                                </div>
                                                
                                            </section>

                                            <h3 class="donate-uk__hidden">step2</h3>
                                            <section class="donate-uk__tab">

                                                <select type="text" name="Title" id="Title">
                                                                <option value="">-- Title (Optional) --</option>
                                                                <option value="Mrs">Mrs.</option>
                                                                <option value="Miss">Miss</option>
                                                                <option value="Ms">Ms.</option>
                                                                <option value="Mr">Mr.</option>
                                                                <option value="Dr">Dr.</option>
                                                                <option value="Professor">Professor</option>
                                                                <option value="Rev">None of the above</option>
                                                                
                                                </select>



                                                <input type="text" name="FirstName" class="required" id="FirstName" placeholder="First Name" maxlength="50"> 
                                
                                                <input type="text" name="LastName" class="required" id="LastName" placeholder="Last Name"maxlength="50"> 

                                                <input type="text" name="Email" class="required" type="email" id="Email" maxlength="50" placeholder="Email"> 

                                                <input type="text" name="Phone" class="" id="Phone" maxlength="50" placeholder="Phone"> 
                                
                                            </section>
                                            
                                            <h3 class="donate-uk__hidden">step3</h3>
                                            <section class="donate-uk__tab">
                                
                                                <input type="text" name="Address1" class="" id="Address1" maxlength="50" placeholder="Address 1"> 
                                        
                                                <input type="text" name="Address2" class="" id="Address2" maxlength="50" placeholder="Address 2 (optional)"> 

                                                <input type="text" name="Town" class="" id="Town" maxlength="50" placeholder="City"> 

                                                <input type="text" name="County" class="" id="County" maxlength="50" placeholder="State"> 

                                                <input type="text" name="Postcode" class="" id="Postcode" maxlength="10" placeholder="ZIP code"> 

                                                <select style="display: none;" name="Country" class="" id="Country" placeholder="Country">
                                                    <option disabled selected value> -- Country select -- </option>
                                                    <option value="United States">United States</option>
							                        <option value="Holland">Holland</option>
							                        <option value="Germany">Germany</option>
							                        <option value="France">France</option>
							                        <option value="United Kingdom">United Kingdom</option>
							                        <option value="Italy">Italy</option>
							                        <option value="Spain">Spain</option>
							                        <option value="New Zealand">New Zealand</option>
							                        <option value="Belgium">Belgium</option>
							                        <option value="Australia">Australia</option>
							                        <option value="Czech Republic">Czech Republic</option>
                                                </select>

                                            </section>

                                            <h3 class="donate-uk__hidden">step3</h3>
                                            <section class="donate-uk__tab">

                                                <label style="font-size:16px; font-weight: 100;" class="" for="ExpiryMonth">Card Number</label>
                                                <div id="card-number" class="donate-uk__input"></div>

                                                <label style="font-size:16px; font-weight: 100;" class="" for="ExpiryMonth">Expiry Date (mm/yy)</label>

                                                <div id="card-expiry" class="donate-uk__input"></div>
                                        
                                                <div id="card-cvc" class="donate-uk__input"></div>

                                                <p><input type="text" name="Comment" id="Comment" placeholder="What has inspired you to donate?"></p>

                                                <div id="ErrorContainer" class="ErrorContainer">
                                                <div style="color: red; font-size: 1.5em;" id="Errors"></div>
                                                </div>
                                                <div id="PleaseWait" style="display:none">Please wait ...</div>
                                                <input style="background-color: #F5BC26; border-color: #F5BC26;" class="button button--solid button--orange" type="submit" value="Donate" id="submitButton">
                                        
                                            </section>

                                            <h3 class="donate-uk__hidden">step4</h3>
                                            <section class="donate-uk__tab">
                                                
                                                    
                                                    <div class="donate-uk__hidden"><label><span>I want this gift to be a one off</span>
                                                        <input type="radio" id="OneOffPayment" name="PaymentType" value="OneOff" checked="checked">
                                                    </label>
                                                    <label><span>I want this gift to be an ongoing commitment to help</span>
                                                        <input type="radio" id="RecurringPayment" name="PaymentType" value="Recurring">
                                                    </label></div>

                                            
                                                    <div class="donate-uk__hidden" id="PaymentScheduleRow" style="display: none;">
                                                        
                                                            <label class="" for="CVC">I would like to donate-uk*</label>
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

                                                    <div id="ErrorContainer" class="ErrorContainer">
                                                        <div style="color: red; font-size: 1.5em;" id="Errors"></div>
                                                    </div>
                                                    <div id="PleaseWait" style="display:none">Please wait ...</div>
                                                    <input style="background-color: #F5BC26; border-color: #F5BC26;" class="button button--solid button--orange" type="submit" value="Donate" id="submitButton">                                     
                                                     <!-- Hidden fields for tags -->
                                                    <input type="hidden" id="ActiveTags" value="" />
                                                    <input type="hidden" id="BlockedTags" value="" />
                                                    <!-- Do not change these values -->
                                                    <input type="hidden" id="PublishableKey" value="pk_live_WMJp57zos3PJGIUIaXRYMY8I002yTFVYpi" />
                                                    <input type="hidden" id="TenantCode" value="HM9DCVXJ56" />
                                                    <input type="hidden" id="WidgetId" value="cba4175b-be7f-ea11-99e5-501ac58218d8" />
                                                    <input type="hidden" id="DonationPageId" value="" />
                                                    <input type="hidden" id="RedirectToPage" value="https://hopeforjustice.org/keep-hope-alive-thank-you" />
                                            </section>
                                            </form>
                                    </div>
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
            <a class="button button--blue button--solid"href="/become-a-guardian">Find out more</a>
        </div>
    </div>
   
</section>

    
<?php get_footer(); ?>