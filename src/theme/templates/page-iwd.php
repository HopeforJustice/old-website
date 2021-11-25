<?php
/**
 * Template Name: IWD
 * 
 * @package hopeforjustice-2014
 */

get_header(); ?>

<main id="main" class="site-main iwd" role="main">

	<!--
	--
	-- header
	--
	-->
	<div class="iwd__header">
		<div class="iwd__header-inner inner">
			<div class="iwd__header-text">
				<div class="iwd__logos">
					<img class="iwd__empowerall" src="https://hopeforjustice.org/wp-content/uploads/2021/03/iwd-empowerall.svg">
					<img class="iwd__bird" src="https://hopeforjustice.org/wp-content/uploads/2021/03/iwd-bird.svg">
				</div>
				<div class="iwd__title">
					<h1>International <br>Women’s Day</h1>
				</div>
				<div class="iwd__line"></div>
			</div>
			<div class="iwd__graphic">
				<img src="https://hopeforjustice.org/wp-content/uploads/2021/03/hands@2x.png">
			</div>
		</div>
		<div class="iwd__stat">
			<p class="iwd__stat-text">Did you know women and girls account for <br><span>71%</span> of victims of modern slavery?</p>
			<div data-toggle="modal" data-target="#event-modal" style="cursor: pointer;" class="button button--solid button--red">Watch event</div>
		</div>
	</div>
	<!--
	--
	-- Giving
	--
	-->
	<div class="inner">
		<div class="iwd__giving">
			<div class="iwd__photo" style="background-image: url(https://hopeforjustice.org/wp-content/uploads/2021/03/iwd-shg.jpg);">
			</div>
			<div class="iwd__giving-content">
					<h2>By Donating Today,</h2>
					<p>You could empower more women in Self-Help Groups to become less vulnerable to predatory traffickers.<br><br>You could help young girls catch up on their education so they can achieve their potential, and you could help reintegrate young women back into communities so that they can thrive.<br><br><span>Your donation will empower more women,</span> <br>and help prevent their risk of human trafficking.</p>
				<div class="iwd__giving-widget">
					<div class="iwd__amounts">
						<?php if($GLOBALS['userInfo'] && in_array($GLOBALS['userInfo'], $GLOBALS['usa'])){ ?>
							<div val="10" class="iwd__amount">$10</div>
							<div val="20" class="iwd__amount">$20</div>
							<div val="50" class="iwd__amount">$50</div>
						<?php } else if($GLOBALS['userInfo'] && in_array($GLOBALS['userInfo'], $GLOBALS['norway'])){ ?>
							<div val="100" class="iwd__amount">100Kr</div>
							<div val="200" class="iwd__amount">200Kr</div>
							<div val="500" class="iwd__amount">500Kr</div>
						<?php } else { ?>
							<div val="10" class="iwd__amount">£10</div>
							<div val="20" class="iwd__amount">£20</div>
							<div val="50" class="iwd__amount">£50</div>
						<?php } ?>
					</div>
					<div class="iwd__custom-amount">
						<?php if($GLOBALS['userInfo'] && in_array($GLOBALS['userInfo'], $GLOBALS['usa'])){ ?>
							<div class="iwd__input iwd__input-uk iwd__input-us">
								<input id="Amount" type="number" name="Amount" placeholder="Enter Amount" value="<?php echo htmlspecialchars($_GET["Amount"]);?>">
							</div>
						<?php } else if($GLOBALS['userInfo'] && in_array($GLOBALS['userInfo'], $GLOBALS['norway'])){ ?>
							<div class="iwd__input iwd__input-uk iwd__input-no">
								<input id="Amount" type="number" name="Amount" placeholder="Enter Amount" value="<?php echo htmlspecialchars($_GET["Amount"]);?>">
							</div>
						<?php } else { ?>
							<div class="iwd__input iwd__input-uk">
								<input id="Amount" type="number" name="Amount" placeholder="Enter Amount" value="<?php echo htmlspecialchars($_GET["Amount"]);?>">
							</div>							
						<?php } ?>	
						<div id="modalTrigger" data-toggle="modal" data-target="#payment-modal" class="iwd__amount-btn">DONATE</div>
					</div>
					<div class="iwd__giving-widget-footer">
						<p>Your donation, whatever it might be, can help change lives and end slavery.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--
	--
	-- Video
	--
	-->
	<div class="iwd__video">
		<div class="inner">
			<div id="iwdVideo">
				<iframe width="560" height="315" src="https://www.youtube.com/embed/3FhNd1kIAOU" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			</div>
		</div>
		
	</div>
	<!--
	--
	-- Modal payment
	--
	-->
    <div class="modal fade" id="payment-modal" tabindex="-1" role="dialog" aria-hidden="false">
	  	<div class="modal__dialog">
	    	<div class="modal__content">

	        	<?php if($GLOBALS['userInfo'] && in_array($GLOBALS['userInfo'], $GLOBALS['usa'])){ ?>

	        		<div style="margin-bottom: 20px; "><a style="font-size: 12px; font-weight: 300; text-decoration: underline; text-decoration: underline; cursor: pointer;" data-dismiss="modal">Giving $<span id="textAmount"><?php echo htmlspecialchars($_GET["Amount"]);?></span> Once (click to change)</a></div>
		        	<?php echo do_shortcode("[gravityform id=\"77\" title=\"false\" description=\"false\" ajax=\"true\" field_values=\"Campaign=IWD%202021\"]"); ?>

	        	<?php } else if($GLOBALS['userInfo'] && in_array($GLOBALS['userInfo'], $GLOBALS['norway'])){ ?>

	        		<div style="margin-bottom: 20px; "><a style="font-size: 12px; font-weight: 300; text-decoration: underline; text-decoration: underline; cursor: pointer;" data-dismiss="modal">Giving <span id="textAmount"><?php echo htmlspecialchars($_GET["Amount"]);?></span>Kr Once (click to change)</a></div>
		        	<?php echo do_shortcode("[gravityform id=\"71\" title=\"false\" description=\"false\" ajax=\"true\" field_values=\"Campaign=IWD%202021\"]"); ?>

	        	<?php } else { ?>

		        	<div style="margin-bottom: 20px; "><a style="font-size: 12px; font-weight: 300; text-decoration: underline; text-decoration: underline; cursor: pointer;" data-dismiss="modal">Giving £<span id="textAmount"><?php echo htmlspecialchars($_GET["Amount"]);?></span> Once (click to change)</a></div>
		        	<?php echo do_shortcode("[gravityform id=\"69\" title=\"false\" description=\"false\" ajax=\"true\" field_values=\"Campaign=IWD%202021\"]"); ?>

		        <?php } ?>

	        	<a href="#" data-dismiss="payment-modal" class="gi-close modal__close"><span class="accessibility">Close</span></a>
	    	</div>
	    	
	    </div>
	</div>
	<!--
	--
	-- Modal event
	--
	-->
    <div class="modal fade" id="event-modal" tabindex="-1" role="dialog" aria-hidden="false">
	  	<div class="modal__dialog">
	    	<div class="modal__content">

	        	<?php if($GLOBALS['userInfo'] && in_array($GLOBALS['userInfo'], $GLOBALS['usa'])){ ?>

	        		<h3 style="margin-bottom: 20px">Sign up to watch the event</h3>
		        	<?php echo do_shortcode("[gravityform id=\"109\" title=\"false\" description=\"false\" ajax=\"true\" field_values=\"Campaign=IWD%202021&amp;Activity=none&amp;Donorfy=US\"]"); ?>

	        	<?php } else if($GLOBALS['userInfo'] && in_array($GLOBALS['userInfo'], $GLOBALS['norway'])){ ?>

	        		<h3 style="margin-bottom: 20px" >Sign up to watch the event</h3>
		        	<?php echo do_shortcode("[gravityform id=\"109\" title=\"false\" description=\"false\" ajax=\"true\" field_values=\"Campaign=IWD%202021&amp;Activity=none&amp;Donorfy=NO\"]"); ?>

	        	<?php } else { ?>

	        		<h3 style="margin-bottom: 20px">Sign up to watch the event</h3>
		        	<?php echo do_shortcode("[gravityform id=\"109\" title=\"false\" description=\"false\" ajax=\"true\" field_values=\"Campaign=IWD%202021&amp;Activity=none&amp;Donorfy=UK\"]"); ?>

		        <?php } ?>

	        	<a href="#" data-dismiss="payment-modal" class="gi-close modal__close"><span class="accessibility">Close</span></a>
	    	</div>
	    	
	    </div>
	</div>

</main>


<?php get_footer(); ?>