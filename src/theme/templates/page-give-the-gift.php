<?php
/**
 * Template Name: Give the gift UK
 *
 * Root Donate page is a redirect which should point you to the correct page based on your location...
 * 
 * @package hopeforjustice-2014
 */

get_header();?>

<script type="text/javascript" src="https://js.stripe.com/v3/"></script>
<main style="background-color: white; color: black;">
	<div class="inner inner-gift">

		<!--header text -->
		<div class="gift__header">
			<div class="inner">
				<img class="gift__header-img" src="https://hopeforjustice.org/wp-content/uploads/2020/03/Group-6272@2x.jpg">
				<div class="gift__typed">
					<h1 class="gift__title">Give the gift of...<br class="gift__mobile-break"><span class="giftText"></span></h1>
				</div>
			</div>
		</div>

		<div class="gift__line"></div>

		<div class="gift__info">
			<div class="inner">
				If you are looking for the perfect gift for a friend or loved one – or seeking to do something a bit different this year for Mother’s Day, Father’s Day or a birthday – what better gift could there possibly be than helping to change the life of a person trapped in modern slavery?
 				<br><br>
				Give to Hope for Justice on their behalf, and we will send a beautiful card telling the inspiring story of a life changed. We can send the card either directly to you, or if you prefer we can send it to your loved one with your message inside. The card can be physically posted, or done as an e-card, perhaps if you are in a particular hurry! Your generous gift will have a real impact in the fight against human trafficking and the recipient will learn how the gift you have given on their behalf will help change a life.
			</div>
		</div>

		<div class="gift__line"></div>
		
		<!--images and other content column on mobile-->
		<div class="gift__split">
			
			<!--images -->
			<div class="gift__images">
				<div id="big" style="background-image: url(https://hopeforjustice.org/wp-content/uploads/2020/02/bluecard.jpg);" class="gift__large-img"></div>
				<div class="gift__small-images">
					<div id="small-1" style="background-image: url(https://hopeforjustice.org/wp-content/uploads/2020/02/bluecardinside1.jpg);" class="gift__small-img"></div>
					<div id="small-2" style="background-image: url(https://hopeforjustice.org/wp-content/uploads/2020/02/bluecardinside2.jpg);" class="gift__small-img"></div>
					<div id="small-3" style="background-image: url(https://hopeforjustice.org/wp-content/uploads/2020/02/bluecardinside3.jpg);" class="gift__small-img"></div>
				</div>
			</div>

			<!-- other content -->
			<div class="gift__content">
				<p><strong>Choose a design and story:</strong></p>
				<div>
					<img id="orangeCircle" class="gift__circle no-lazyload" src="https://hopeforjustice.org/wp-content/uploads/2020/02/orangecircle.png">
					<img id="pinkCircle" class="gift__circle no-lazyload" src="https://hopeforjustice.org/wp-content/uploads/2020/02/pinkcircle.png">
					<img id="blueCircle" class="gift__circle gift__circle--selected no-lazyload" src="https://hopeforjustice.org/wp-content/uploads/2020/02/bluecircle.png">
				</div>
				<p class="gift__story-title"><strong>We helped Emily and her son<br> find a safe place to live.</strong></p>
				<p class="gift__description">
					Each card design comes with a unique story of a real life changed thanks to the work of Hope for Justice. That story is told inside the card (or e-card) that is sent to your recipient.
				</p>

				<ul class="gift__send-options">        
                    <li><a id="Post-button" class="button button--solid button--blue button--lefthalf" id="donate-monthly-select">Send by post</a></li>
                    <li><a id="Email-button" class="button button--hollow button--blue button--righthalf" id="donate-one-off-select">Send by email</a></li>
                </ul>
                <p class="gift__small-text">Postage and admin fee: £1.50. Cards are sent by 1st Class post and should arrive within 3-5 working days after your order date. If you need it to arrive within the next 3 working days, please select Email as we cannot guarantee a posted card would arrive in time.</p>

                <a id="giveGiftButton" data-toggle="modal" data-target="#payment-modal" class="button button--solid button--blue">Buy this gift</a>

			</div>

		</div> <!--/gift split -->



	</div><!--/inner-->



	<!-- Modal payment -->
	<div class="modal fade" id="payment-modal" tabindex="-1" role="dialog" aria-hidden="false">
	  <div class="modal__dialog">
	    <div class="modal__content">
	    	<a href="#" data-dismiss="payment-modal" class="gi-close modal__close"><span class="accessibility">Close</span></a>
	    	<div class="givegift__inner payment-modal__body payment-modal__body--no-margin">
					<form method="post" id="CreditCardForm"> 
				        <div style="color: red; font-size: 1em;" class="errors"></div>
				        

				        <!-- Step 1 -->
				        <h3 style="display: none;">Step 1</h3>
				        <section>
				        	
					        	<!-- Amount to give use options -->
    					        <div class="givegift__title">Amount you would like to give to Hope for Justice as a gift on behalf of another:</div>
    					     	<div class="givegift__flex-start">
    					        <label class="givegift__amount-options" style="margin-right: 10px;"><span>£15</span>
    					        	<input style="display: none;" type="radio" name="amountOption" value="15.00">
    					        </label>
    					        <label class="givegift__amount-options" style="margin-right: 10px;"><span>£25</span>
    					        	<input style="display: none;" type="radio" name="amountOption" value="25.00">
    					        </label>
    					       	<label class="givegift__amount-options"><span>£50</span>
    					        	<input style="display: none;" type="radio" name="amountOption" value="50.00">
    					        </label>
					    	</div>
					        <input type="text" name="Amount" class="required numberOnly form-control" id="Amount" maxlength="10" placeholder="Other Amount (minimum £5)" title="Please enter the amount you want to give - don't include the pound sign">
					        <!-- /Amount -->


					        <!--<p>
					        A Thank You card can be sent to the recipient by email. Or, for a small postage and administration fee of £1.50, we can make this a physical gift by sending a Thank You card in the post to your recipient (or directly to you, for you to pass on).
					        <br><br>
							This will be processed within 1 working day and then sent via first-class post, so if you need the Thank You card to be received in less than five working days’ time, please select Email as we cannot guarantee a posted card will arrive in time.
							</p>


					        How the gift is sent 
				        	<label><span>Post</span>
					            <input type="radio" id="" name="giftType" value="Post" class="required">
					        </label>
					        
					        <label><span>Email</span>
					            <input type="radio" id="" name="giftType" value="Email">
					        </label>
					    	/How the gift is sent -->



					    	<!-- Postal gift send options -->
					    	<div class="givegift__post-options" style="display: none;">
						        <div class="givegift__title">Would you like us to post the card to you for you to handwrite your message and pass on? Or would you like us to insert your message and post it directly to the recipient?</div>
							       	<div class="givegift__flex-start">
							        	<label style="margin-right: 10px;"><span>Send to me</span>
								            <input type="radio" id="sendToMe" name="giftSendType" value="sendToMe" class="required">
								        </label>
								        
								        <label><span>Send to the recipient</span>
								            <input type="radio" id="sendToThem" name="giftSendType" value="sendToThem">
								        </label>
							    	</div>
						    </div>
					    	<!-- /Postal gift send options -->

    					    <!-- Email gift send options -->
					    	<input style="display: none;" type="text" name="gifteeEmail" id="gifteeEmail" placeholder="Recipient’s email address" maxlength="50">
					    	<!-- /Email gift send options -->
				        </section>
				        <!-- /Step 1 -->



				        <!-- Step 2 -->
				        <h3 style="display: none;">Step 2</h3>
				    	<section>
				    		<div id="step-2-content">
				    		<!-- Gift card details -->
					    	<div class="givegift__gift-details">
					    		<img class="gift__details-img" src="https://hopeforjustice.org/wp-content/uploads/2020/02/bluecardinside2.jpg">
							    	<input type="text" name="To" class="required" id="To" placeholder="To" maxlength="50">
							    	<input type="text" name="From" class="required" id="From" placeholder="From" maxlength="50"> 
							    	<textarea style="height:80px;" name="message" id="message" class="required" placeholder="A personal message..." maxlength="200"></textarea>
							   		
							   		<div class="givegift__title">Would you like the card to show how much the donation is for?</div>
							       	<div class="givegift__flex-start">
							        	<label><span>Yes</span>
								            <input type="radio" id="" name="Publicise" value="Yes" class="required">
								        </label>
								        
								        <label><span>No</span>
								            <input type="radio" id="" name="Publicise" value="No">
								        </label>
							    	</div>
						    </div>
					    	<!-- /Gift card details -->


					    	<!-- Email send by -->
					    	<div id="emailBy">
						    	<div class="givegift__title">On what date would you like the card to be emailed to the recipient?</div>
						    	<input type="text" name="gifteeEmailDate" id="gifteeEmailDate">
					    	</div>
					    	<!-- /Email send by -->
				    	</section>
				    	<!-- /Step 2 -->



				    	<!-- Step 3 possible only with post option-->
				    	<h3 style="display: none;">Step 3</h3>
				    	<section>
							<!-- Delivery details -->
					        <div class="givegift__delivery-options">
					        	<div class="givegift__title" id="deliveryHeader">Your delivery address</div>
					        	<select type="text" name="deliveryTitle" class="required" id="deliveryTitle">
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
						       	<input type="text" name="deliveryFirstName" class="deliveryOptions" id="deliveryFirstName" placeholder="First Name" maxlength="50"> 
						        <input type="text" name="deliveryLastName" class="deliveryOptions" id="deliveryLastName" placeholder="Last Name"maxlength="50"> 
						        <input type="text" name="deliveryAddress1" class="deliveryOptions" id="deliveryAddress1" maxlength="50" placeholder="Address 1"> 
						        <input type="text" name="deliveryAddress2" id="deliveryAddress2" maxlength="50" placeholder="Address 2"> 
						        <input type="text" name="deliveryTown" class="deliveryOptions" id="deliveryTown" maxlength="50" placeholder="City"> 
						        <input type="text" name="deliveryCounty" class="deliveryOptions" id="deliveryCounty" maxlength="50" placeholder="County"> 
						        <input type="text" name="deliveryPostcode" class="deliveryOptions" id="deliveryPostcode" maxlength="10" placeholder="Postcode">
					        </div>
					        <!-- /Delivery details -->
				    	</section>
				    	<!-- /Step 3 -->


				    	<!-- Step 4 -->
				    	<h3 style="display: none;">Step 4</h3>
						<section id="possible-section">					    	
							<!-- Billing details -->
				    		<div id="isBilling">
					        	<div class="givegift__title">Is your billing address the same as your delivery address?</div>
					        	<div class="givegift__flex-start">
					        		<label><span>Yes</span>
					        		<input type="radio" id="billingIsDelivery" name="billingIsDelivery" value="Yes">
						        	</label>
						        	<label><span>No</span>
							            <input type="radio" id="" name="billingIsDelivery" value="No">
							        </label>
						    	</div>
						    </div>

					    	<div class="givegift__billing-address">
						    	<div class="givegift__title">Billing details</div>
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
							        <input type="text" name="Phone" class="" id="Phone" maxlength="50" placeholder="Phone">

								        <input type="text" name="Address1" class="required" id="Address1" maxlength="50" placeholder="Address 1"> 
								        <input type="text" name="Address2" class="" id="Address2" maxlength="50" placeholder="Address 2"> 
								        <input type="text" name="Town" class="required" id="Town" maxlength="50" placeholder="City"> 
								        <input type="text" name="County" id="County" maxlength="50" placeholder="County"> 
								        <input type="text" name="Postcode" class="required" id="Postcode" maxlength="10" placeholder="Postcode"> 
						   		</div>
					        <!-- /Billing details -->
					    </section>
					    <!-- /step 4 -->

					    <!-- Step 5 -->
				    	<h3 style="display: none;">Step 5</h3>
						<section>
							<!-- Card details -->
							<div class="givegift__title">Card details</div>
							<div class="donate-uk__input" id="card-number"></div>
							<div class="donate-uk__input" id="card-expiry"></div>
							<div class="donate-uk__input" id="card-cvc"></div>
							<input type="text" name="Email" class="required" type="email" id="Email" maxlength="50" placeholder="Your email address"> 
							<input type="text" name="giftComment" id="giftComment" placeholder="What has inspired you to give this gift today?">
							<input style="display: none;" type="text" name="Honey" id="Honey">
							<!-- /Card details -->

					        <!-- Gift aid -->
					        <h1 class="givegift__gift-aid">GIFT AID IT!</h1>
				            <div class="givegift__flex-start">
				                <label style="margin-right: 10px;"><input type="radio" name="GiftAid" id="GiftAid" required>Yes</label>
				                <label><input type="radio" name="GiftAid" id="GiftAidno">No</label>
				            </div>
				            <div class="givegift__errorTxt" id="gift-aid-error"></div>
					        	<p class="givegift__giftaid-text">
			        					Please add Gift Aid to all donations I’ve made to Hope for Justice in the past four years and all donations in future until I notify Hope for Justice otherwise. 
                                        <br><br>
                                       	I confirm that I am a UK taxpayer and understand that if I pay less Income Tax and/or Capital Gains Tax than the amount of Gift Aid claimed on all my donations in the tax year, it is my responsibility to pay any difference.
                                       	<br><br><strong>Hope for Justice will claim 25p on every £1 I donate.</strong>
                                       	<br><br>I confirm that this is my own money and I am not paying over donations made by third parties such as monies collected at an event, a company donation or a donation from a friend or family member. I am not receiving anything in return for my donation such as a book, prize or ticket.
                                       	<br><br>I am not making a donation as part of a sweepstake, raffle or lottery. Please note that the postage and administration fee of £1.50 cannot be Gift Aided.
                                       	<br><br><a target="_blank" href="/giftaid">Find out more about Gift Aid and eligibility</a>
                                       	<br><a target="_blank" href="http://hopeforjustice.org/wp-content/uploads/2019/07/GiftAid-Declaration.pdf">Download a printable Gift Aid form if you would prefer to post this into us</a>
					        		<br>
					            </p>
				        </section>
				        <!-- /Step 5 -->

				        <!-- Step 6 -->
				        <h3 style="display: none;">Step 5</h3>
				        <section>
				        	<h1 class="mega" style="margin-bottom: 15px">YES!</h1>
					        <h4>I would like updates about how my gift is making a difference, via:</h4>
					        
					        <div class="givegift__pref givegift__flex-start">
					                <label style="margin-right: 10px;"><input type="checkbox" value="2" class="KeepInTouch">&nbsp;Email
					                </label>
					                
					                <label style="margin-right: 10px;"><input type="checkbox" value="4" class="KeepInTouch">&nbsp;Post
					                </label>
					                
					                <label style="margin-right: 10px;"><input type="checkbox" value="8" class="KeepInTouch">&nbsp;Sms
					                </label>
					                
					                <label><input type="checkbox" value="16" class="KeepInTouch">&nbsp;Phone
					                </label>
					        </div>
					        <p class="givegift__small">Tick the boxes if you wish Hope for Justice to contact you for the following purposes: To keep you informed of our ongoing activities, news, campaigns and appeals; and to invite you to events we think might interest you. You can unsubscribe from receiving communications at any time, or change your preferences, at: <a style="color: #2e9df7;">hopeforjustice.org/manage-your-preferences</a>
					        <br><br>We will always store your personal information securely. We will use it to provide the service(s) you have requested, and communicate with you in the way(s) you have agreed to. We will only allow your information to be used by third parties working on our behalf. We will share your information if required to do so by law. For details see our <a style="color: #2e9df7;">Privacy Policy</a>.</p>

					        <hr style="margin-top: 20px;">

					        <p>Subtotal: £<span class="givegift__subtotal"></span></p>
					        <p id="postalCharge">Postal charge: £1.50</p>
					        <p class="givegift__total-charge">Total: £<span class="givegift__total"></span></p>

					        <div id="ErrorContainer" class="ErrorContainer">
					            <div style="color: red; font-size: 1em;" id="Errors" class="errors"></div>
					        </div>
					        
					        <div id="PleaseWait" style="display:none">Please wait ...</div>
					        <input style="background-color: #2e9df7;color: #fff; border-color: #2e9df7; font-size: 14px; float: right;" class="button button--solid button--blue" type="submit" value="Donate" id="submitButton"> 
					        <!-- /Marketing -->
					        <div style="font-size: 12px;" class="test">Test comment</div>
				        </section>
				        <!-- /Step 6 -->

					        <!-- Hidden fields for tags + choice values -->
					        <input type="hidden" id="Comment" name="Comment" value="">
					        <input type="hidden" id="designChoice" name="designChoice" value="">
					        <input type="hidden" id="deliveryMethod" name="deliveryMethod" value="">
					        <input type="hidden" id="deliveryToWho" name="deliveryToWho" value="">
					        <input type="hidden" id="deliveryIsBilling" name="deliveryIsBilling" value="">
					        <input type="hidden" id="ActiveTags" value="" />
					        <input type="hidden" id="BlockedTags" value="" />
					        <!-- Do not change these values - unless you want to change them :P -->
					        <input type="hidden" id="PublishableKey" value="pk_live_I2CBzkYVfZ4xBuCmTj7IStTp" />
					        <input type="hidden" id="TenantCode" value="GO66X0NEL4" />
					        <input type="hidden" id="WidgetId" value="cf4e8a9b-f453-ea11-b698-00155d56ad8b" />
					        <input type="hidden" id="DonationPageId" value="" />
					        <input type="hidden" id="RedirectToPage" value="/give-the-gift-thank-you" />
					        <!-- Hidden recurring options (set to one-off) --> 
					       	<div class="donate-uk__hidden">
					        	<label><span>I want this gift to be a one off</span>
						            <input type="radio" id="OneOffPayment" name="PaymentType" value="OneOff" checked="checked">
						        </label>
						        
						        <label><span>I want this gift to be an ongoing commitment to help</span>
						            <input type="radio" id="RecurringPayment" name="PaymentType" value="Recurring">
						        </label>
					    	</div>
					    	<div class="donate-uk__hidden" id="PaymentScheduleRow" style="display: none;">	            
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
					        <!-- /Hidden fields -->
					</form>
			</div><!--/modal-inner -->
	    </div>

	 </div>
	</div>


</main>

<?php get_footer(); ?>