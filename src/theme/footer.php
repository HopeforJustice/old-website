<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package hopeforjustice-2014
 */
?>

		</div><!-- #content -->

		<footer class="site-footer footer" role="contentinfo">

			<div class="outer outer--dark">

				<div class="inner">

					<div class="colgroup-2">
						<div class="footer__social col">
							<a href="https://twitter.com/intent/user?user_id=70643731" title="Follow @hopeforjustice on Twitter" class="gi-twitter"><span class="screen-reader-text">Follow us on twitter</span></a>
							<a href="http://www.facebook.com/hopeforjustice" title="Find Hope for Justice on Facebook" class="gi-facebook"><span class="screen-reader-text">Find Hope for Justice on Facebook</span></a>
							<a href="http://instagram.com/hopeforjusticeintl" title="Follow Hope for Justice on Instagram" class="gi-instagram"><span class="screen-reader-text">Follow Hope for Justice on Instagram</span></a>
							<a href="https://www.linkedin.com/company/9277701" title="Follow Hope for Justice on LinkedIn" class="gi-linkedin"><span class="screen-reader-text">Follow Hope for Justice on LinkedIn</span></a>							
						</div>
						<div class="footer__subscribe col form--dark form--small form--hidden-label ">
							
							<?php if($GLOBALS['userInfo'] && in_array($GLOBALS['userInfo'], $GLOBALS['norway'])){
								echo "<span class=\"push-half--right\">Få oppdateringer fra vårt arbeid på mail </span><a href=\"/signup/\" class=\"button button--solid button--blue\">Meld deg på</a>";
							}
							else {
								echo "<span class=\"push-half--right\">Get Hope for Justice email updates </span><a href=\"/signup/\" class=\"button button--solid button--blue\">Sign Up</a>";
							}
							?>
						</div>
					</div>

					<div class="footer__divider row">

						<nav class="footer__nav footer__nav__1">
							<?php if($GLOBALS['userInfo'] && in_array($GLOBALS['userInfo'], $GLOBALS['norway'])){
								// footer menu 1
								$location = 'norway-footer-1';
								$menu_obj = hopeforjustice_get_menu_by_location($location); 
								echo "<h3 class=\"footer__nav-title\">".esc_html($menu_obj->name)."</h3>";	
								wp_nav_menu( array( 'theme_location' => 'norway-footer-1', 'container' => false, 'menu_class' => 'footer__links' ) );
							}
							else {
								// footer menu 1
								$location = 'footer-1';
								$menu_obj = hopeforjustice_get_menu_by_location($location); 
								echo "<h3 class=\"footer__nav-title\">".esc_html($menu_obj->name)."</h3>";	
								wp_nav_menu( array( 'theme_location' => 'footer-1', 'container' => false, 'menu_class' => 'footer__links' ) );
							}
							?>
						</nav><!--/footer__nav-->

						<nav class="footer__nav footer__nav__2">
							<?php if($GLOBALS['userInfo'] && in_array($GLOBALS['userInfo'], $GLOBALS['norway'])){
								// footer menu 2
								$location = 'norway-footer-2';
								$menu_obj = hopeforjustice_get_menu_by_location($location); 
								echo "<h3 class=\"footer__nav-title\">".esc_html($menu_obj->name)."</h3>";	
								wp_nav_menu( array( 'theme_location' => 'norway-footer-2', 'container' => false, 'menu_class' => 'footer__links' ) );
							}
							else {
								// footer menu 2
								$location = 'footer-2';
								$menu_obj = hopeforjustice_get_menu_by_location($location); 
								echo "<h3 class=\"footer__nav-title\">".esc_html($menu_obj->name)."</h3>";	
								wp_nav_menu( array( 'theme_location' => 'footer-2', 'container' => false, 'menu_class' => 'footer__links' ) );
							}
							?>
						</nav><!--/footer__nav-->

						<nav class="footer__nav footer__nav__3">
							<?php if($GLOBALS['userInfo'] && in_array($GLOBALS['userInfo'], $GLOBALS['norway'])){
								// footer menu 3 
								$location = 'norway-footer-3';
								$menu_obj = hopeforjustice_get_menu_by_location($location); 
								echo "<h3 class=\"footer__nav-title\">".esc_html($menu_obj->name)."</h3>";
								wp_nav_menu( array( 'theme_location' => 'norway-footer-3', 'container' => false, 'menu_class' => 'footer__links' ) );
							}
							else {
								// footer menu 3 
								$location = 'footer-3';
								$menu_obj = hopeforjustice_get_menu_by_location($location); 
								echo "<h3 class=\"footer__nav-title\">".esc_html($menu_obj->name)."</h3>";
								wp_nav_menu( array( 'theme_location' => 'footer-3', 'container' => false, 'menu_class' => 'footer__links' ) );
							}
							?>
						</nav><!--/footer__nav-->

						<div class="footer__colophon">
							<img class="footer__circle" src="https://hopeforjustice.org/wp-content/uploads/2021/07/footer-logo.png">
							<a href="/financials"><img class="footer__fundraising"src="https://hopeforjustice.org/wp-content/uploads/2020/08/fr.png"></a>
							<a href="/financials"><img class="footer__circle" src="https://hopeforjustice.org/wp-content/uploads/2020/08/guideStarSeal_platinum_SM.png"></a>
							
						</div>

					</div>

					<small class="footer__cookies">
						<?php if($GLOBALS['userInfo'] && in_array($GLOBALS['userInfo'], $GLOBALS['norway'])){
							echo "<span>Vi bruker cookies for å gjøre siden vår bedre. <a href=\"/cookie-statement-for-hope-for-justice/\">Dette er hvordan vi bruker dem</a>. Du kan endre innstillinger for cookies i din nettleser. <a href=\"/privacy-policy/\">Dette er vår personvern-policy.</a>.</span>";
						}
						else {
							echo "<span>We use cookies to help make this website better. <a href=\"/cookie-statement-for-hope-for-justice/\">Here is how we use them</a>. You can change the cookie settings on your browser. Otherwise, we'll assume you're OK to continue. <a href=\"/privacy-policy/\">Here is our Privacy Policy</a>.</span>";
						}
						?>
						
					</small><!-- footer__cookies -->
					<small class="footer__site-info">
						<?php if($GLOBALS['userInfo'] && in_array($GLOBALS['userInfo'], $GLOBALS['norway'])){
							echo "<span>Norway, Hope for Justice AS er registrert under organisasjonsnummer 915 520 995. Hope for Justice is a 501(c)(3) not for profit organization in the USA, a registered charity in England &amp; Wales (no. 1126097) and in Scotland (no. SC045769), and a company limited by guarantee, registered in England and Wales, number 6563365.</span>";
						}
						else {
							echo "<span>Hope for Justice is a 501(c)(3) not for profit organization in the USA, a registered charity in England &amp; Wales (no. 1126097) and in Scotland (no. SC045769), and a company limited by guarantee, registered in England and Wales, number 6563365. In Norway, Hope for Justice AS is registered under Organisasjonsnummer 915 520 995.</span>";
						}
						?>
					</small><!-- .site-info -->
				</div><!--/.inner-->

			</div><!-- /.outer-dark -->

		</footer>
	
	</div>
	
</div> <!-- #page -->



	<?php wp_footer(); ?>
    <script>jQuery(function () {init.forEach(function (f) {f();});});</script>

</body>
</html>
