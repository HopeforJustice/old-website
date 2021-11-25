<?php
/**
 * Template Name: Guardian USA
 *
 * Root Donate page is a redirect which should point you to the correct page based on your location...
 * 
 * @package hopeforjustice-2014
 */

get_header();?>
	<main id="main" class="site-main guardian" role="main">
		<script type="text/javascript" src="https://js.stripe.com/v3/"></script>
		<script src="https://www.google.com/recaptcha/api.js?render=6LeSscYZAAAAABIur1rDAvJtDiR7SayCuAylTV2q"></script>
		<div class="guardian__row guardian__hero">
			<div class="inner">
					<div class="guardian__describer">
						<img class="guardian__logo" src="<?php the_field('guardian_logo'); ?>">
						<h2 class="beta"><?php the_field('guardian_subtitle'); ?></h2>
						<p class="text--large-print guardian__text-desktop"><?php the_field('guardian_description'); ?></p>
					</div>
			
				<div class="guardian__giving">
						<div class="guardian__split row">
							<p class="guardian__text-mobile text--large-print"><?php the_field('guardian_description'); ?></p>
								<div class="giving-widget guardian__widget">
									<div class="giving-widget__header">
										<h2 class="beta--no-marg"><?php the_field('widget_title'); ?></h2>
									</div>
									<div class="giving-widget__body">
										<div class="giving-widget__content">
											<div class="giving-widget__options">
												<div id="giving-widget-18" class="giving-widget__option giving-widget__option--active"><?php the_field('widget_selection_1'); ?></div>
												<div id="giving-widget-30" class="giving-widget__option"><?php the_field('widget_selection_2'); ?></div>
												<div id="giving-widget-50" class="giving-widget__option"><?php the_field('widget_selection_3'); ?></div>
											</div>
											<div class="giving-widget__custom-amount giving-widget__custom-amount--pre-dolar">
												<input type="text" name="Amount" class="required numberOnly form-control donate-uk__amount" id="Amount" maxlength="10" placeholder="18.00" value="18.00">
											</div>
											<a id="become-a-guardian" data-toggle="modal" data-target="#payment-modal" class="button button--solid button--black" href="">Become a GUARDIAN</a>
											<a class="giving-widget__currency" id="currency">Donation in US Dollars</a>
										</div>
									</div>
									<div class="giving-widget__footer">
										<div><?php the_field('widget_footer_text'); ?></div>
									</div>
								</div>
						</div>
				</div>
			</div>
		</div>

		<!--expander section -->
		<div class="row expander">
			<div class="inner">
				<h2 class="expander__title text--side-line"><?php the_field('accordian_title'); ?></h2>
				<div id="guardian-thecla" class="expander__img" data-toggle="modal" data-target="#video-modal">
					<div class="play-button expander__play"><i class="play"></i></div>
				</div>
				<div class="expander__accordian">
					<div class="expander__accordian-inner">
						
						<!--rescue victims -->
						<div class="expander__accordian-section">
							<div class="expander__accordian-header">
								<h3 class="expander__accordian-title"><?php the_field('accordian_subtitle_1'); ?></h3> <div class="expander__triangle expander__triangle--active"></div>
							</div>
							<hr class="expander__hr">
							<p class="expander__accordian-text expander__accordian-text--active">
								<?php the_field('accordian_description_1'); ?>
 							</p>
						</div><!--/rescue victims -->

						<!--restore lives -->
						<div class="expander__accordian-section">
							<div class="expander__accordian-header">
								<h3 class="expander__accordian-title"><?php the_field('accordian_subtitle_2'); ?></h3> <div class="expander__triangle"></div>
							</div>
							<hr class="expander__hr">
							<p class="expander__accordian-text">
								<?php the_field('accordian_description_2'); ?>  
 							</p>
						</div><!--/restore lives -->

						<!--reform society -->
						<div class="expander__accordian-section">
							<div class="expander__accordian-header">
								<h3 class="expander__accordian-title"><?php the_field('accordian_subtitle_3'); ?></h3> <div class="expander__triangle"></div>
							</div>
							<hr class="expander__hr">
							<p class="expander__accordian-text">
								<?php the_field('accordian_description_3'); ?>
 							</p>
						</div><!--/reform-->

						<!-- Prevent exploitation -->
						<div class="expander__accordian-section">
							<div class="expander__accordian-header">
								<h3 class="expander__accordian-title"><?php the_field('accordian_subtitle_4'); ?></h3> <div class="expander__triangle"></div>
							</div>
							<hr class="expander__hr">
							<p class="expander__accordian-text">
								<?php the_field('accordian_description_4'); ?>
 							</p>
						</div><!--/prevent-->
					</div>
				</div>

			</div>
		</div>		

		<div class="picture-quote">
				<div id="guardian-iam" data-toggle="modal" data-target="#video-modal" class="picture-quote__img ">
					<div class="play-button picture-quote__play"><i class="play"></i></div>
				</div>
				<div class="picture-quote__quote">
					<span class="picture-quote__marks">"</span><?php the_field('picture_quote_quote'); ?><span class="picture-quote__marks">"</span>
				</div>
				</div>
		</div>

		<div class="updates">
			<div class="inner">
				<div class="updates__left">
					<img class="updates__img" src="https://hopeforjustice.org/wp-content/uploads/2019/09/guardian-iphone-mockup@2xcrop-1.png">
				</div>
				<div class="updates__right">
					<h2 class="updates__title"><?php the_field('updates_title_1'); ?></h2>
					<h3 class="updates__subtitle"><?php the_field('updates_subtitle_1'); ?></h3>
					<p class="updates__text"><?php the_field('updates_text_1'); ?></p>
					<h3 class="updates__subtitle"><?php the_field('updates_subtitle_2'); ?></h3>
					<p class="updates__text"><?php the_field('updates_text_2'); ?></p>
					<h3 class="updates__subtitle"><?php the_field('updates_subtitle_3'); ?></h3>
					<p class="updates__text"><?php the_field('updates_text_3'); ?></p>
					<a id="footer-button-guardian" class="button button--solid button--black"><?php the_field('updates_button'); ?></a>
				</div>
			</div><!--/inner-->
		</div>
	
		<!-- Modal -->
		<div class="modal fade video-modal" data-backdrop="static" id="video-modal" tabindex="-1" role="dialog" aria-hidden="true">
		  <div class="video-modal__dialog">
		    <div class="video-modal__content">
		      <div class="video-modal__header">
		        <a href="#" data-dismiss="modal" class="gi-close video-modal__close"><span class="accessibility">Close</span></a>
		      </div>
		      <div class="video-modal__body">
		        <iframe id="video" width="560" height="315" src="https://www.youtube.com/embed/8YWYlhmg5_M" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		      </div>
		      <div class="video-modal__footer">
		        <button type="button" class="video-modal__footer-close button button--solid button--blue" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>

		<!-- Modal payment -->
		<div class="modal fade" id="payment-modal" tabindex="-1" role="dialog" aria-hidden="false">
		  <div class="modal__dialog">
		    <div class="modal__content">
		    	<a href="#" data-dismiss="payment-modal" class="gi-close modal__close"><span class="accessibility">Close</span></a>
			      	<div class="donate-uk__errorTxt"></div>
			      		<a style="text-decoration: underline;" class="donate-uk__orange" id="givingAmount" data-dismiss="modal" >Giving&nbsp<strong class="donate-uk__orange" id="display-amount-us"></strong>&nbspMonthly (click to change)</a>
			  		            <div id="donation-donate-uk-form" class="donate-uk__form" style="margin-top:20px;">
	                                <form method="post" id="CreditCardForm" style="display: none;">   

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

	                                            <select name="Country" class="" id="Country" placeholder="Country">
	                                                <option disabled selected value> -- Country select -- </option>
	                                                <option value="United States">United States</option>
													<option value="Costa Rica">Costa Rica</option>
													<option value="Argentina">Argentina</option>
													<option value="Brazil">Brazil</option>
													<option value="Chile">Chile</option>
													<option value="Colombia">Colombia</option>
													<option value="Greenland">Greenland</option>
													<option value="Mexico">Mexico</option>
													<option value="Puerto Rico">Puerto Rico</option>
													<option value="Trinidad and Tobago">Trinidad and Tobago</option>
													<option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
													<option value="Canada">Canada</option>
													<option value="Philippines">Philippines</option>
													<option value="United Kingdom">United Kingdom</option>
													<option value="New Zealand">New Zealand</option>
													<option value="Australia">Australia</option>

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
	                                            <input type="radio" id="OneOffPayment" name="PaymentType" value="OneOff">
	                                        </label>
	                                        <label><span>I want this gift to be an ongoing commitment to help</span>
	                                            <input type="radio" id="RecurringPayment" name="PaymentType" value="Recurring" checked="checked">
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
	                                                                             
	                                        <!-- Hidden fields for tags -->
	                                        <input type="hidden" id="ActiveTags" value="" />
	                                        <input type="hidden" id="BlockedTags" value="" />
	                                        <!-- Do not change these values -->
	                                        <input type="hidden" id="PublishableKey" value="pk_live_WMJp57zos3PJGIUIaXRYMY8I002yTFVYpi" />
	                                        <input type="hidden" id="TenantCode" value="HM9DCVXJ56" />
	                                        <input type="hidden" id="WidgetId" value="ee383a63-9733-ea11-8454-00155d5613f8" />
	                                        <input type="hidden" id="DonationPageId" value="" />
	                                        <input type="hidden" id="RedirectToPage" value="http://hopeforjustice.org/thank-you-usa-regular" />
	                                        <input type="hidden" id="ReCaptchaSiteKey" value="6LeSscYZAAAAABIur1rDAvJtDiR7SayCuAylTV2q" />
                                        	<input type="hidden" id="ReCaptchaAction" value="Donorfy" /> 
	                                                                    </div>
	                                        </section>
	                                </form>
	                            </div>

		    </div>

		 </div>
		</div>


	</main><!-- #main  -->
<?php get_footer(); ?>