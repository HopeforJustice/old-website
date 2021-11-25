<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package hopeforjustice-2014
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

<link rel="shortcut icon" href="https://hopeforjustice.org/wp-content/uploads/2021/07/logo-favicon.png?">
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-T7PSM4L');</script>
<!-- End Google Tag Manager -->

<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php // excludes parfait sub-sections from being indexed by Google - so we don't get penalised for duplicate content
if(is_page_template('templates/page-parfait.php') && !get_field('stack_pages')):
	echo '<meta name="robots" content="noindex"/>';
endif;?>

<script src="https://cezanneondemand.intervieweb.it/integration/announces_js.php?&h=400&w=800&lang=en&utype=0&k=1408e0edd8768dfa3e838b0059df4899&LAC=hopeforjustice&d=hopeforjustice.org&view=list&defgroup=name&gnavenable=1&desc=1&typeView=small&CodP=&separateP=" type="text/javascript"></script>

<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link href="https://fonts.googleapis.com/css?family=Playfair+Display:900&display=swap" rel="stylesheet">
<script type="text/javascript" src="//use.typekit.net/ajn5pcp.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T7PSM4L"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<script>var init = [];</script>

<div id="page" class="hfeed site wrapper">

<!--the news ticker-->
<?php if (get_field('news1_link','option')) : ?>
<div class="ti_title">TOP NEWS</div>
	<div class="TickerNews" id="Ticker">
	  <div class="ti_wrapper">
	    <div class="ti_slide">
	      <div class="ti_content">
	        <div class="ti_news"><a href="<?php the_field('news1_link','option'); ?>"><?php the_field('news1','option'); ?></a></div>
	        <div class="ti_news"><a href="<?php the_field('news2_link','option'); ?>"><?php the_field('news2','option'); ?></a></div>
	        <div class="ti_news"><a href="<?php the_field('news3_link','option'); ?>"><?php the_field('news3','option'); ?></a></div>
	        <div class="ti_news"><a href="<?php the_field('news4_link','option'); ?>"><?php the_field('news4','option'); ?></a></div>
	        <div class="ti_news"><a href="<?php the_field('news5_link','option'); ?>"><?php the_field('news5','option'); ?></a></div>
	      </div>
	    </div>
	  </div>
	</div>
<?php endif; ?>

<!-- Global GeoIP lookup -->
<?php
	// Antigua and Barbuda(AG),Argentina(AR),Bahamas(BS),Barbados(BB),Belize(BZ),Bolivia(BO),Brazil (BR),Cambodia(KH),Canada(CA),Chile(CL),Colombia(CO),Costa Rica(CR),Dominica(DM),Dominican Republic(DM),Ecuador(EC),El Salvador(SV),French Guiana(GF),Grenada(GD),Guadeloupe(GP),Guatamala(GT),Guyana(GY),Haiti(HT),Honduras(HN),Jamaica(JM),Martinique(MQ),Mexico(MX),Nicaragua(NI),Panama(PA),Paraguay(PY),Peru(PE),Puerto Rico(PR),Saint Lucia(LC),Saint Vincent and the Grenadines(VC),Suriname(SR),Trinidad & Tobago(TT),United States(US),Uruguay(UY),Venezuela (VE), Virgin Islands U.S.(VI)
	$GLOBALS['usa'] = array('AG','AR','BB','BS','BO','BR','BZ','CA','CL','CO','CR','DO','DM','EC','KH','LC','GD','GF','GP','GT','GY','HN','HT','JM','MQ','MX','NI','PA','PE','PR','PY','SR','SV','TT','US','UM','UY','VC','VE','VI');

	// Norwegian countries - I've put this into an array because we'll no doubt add other Scandinavian countries at some point
	$GLOBALS['norway'] = array('NO');

	$GLOBALS['uk'] = array('GB','AU');
	
	// lookup country code of IP
	$GLOBALS['geo'] = Wpengine\Geoip::instance();
    $GLOBALS['userInfo'] = $GLOBALS['geo']->country(); 
?>



	<header id="masthead" class="animated site-header pushy-container" role="banner">
		<!--<div class="preheader">
			<div class="inner">
				<div class="preheader__content">

					Content goes here. Geo located with global PHP country look up. 

					<a href="#" class="gi-close preheader__close"><span class="accessibility">Close</span></a>
				</div>
			</div>
		</div>-->
		<div class="inner">
			<a class="branding" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<!--[if gte IE 9]><!-->
				<svg id="logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 173.806 52.08">
				  <g id="Group_6902" data-name="Group 6902" transform="translate(-131.194 -13.459)">
				    <g class="branding__text" id="Group_4" data-name="Group 4" transform="translate(184.492 30.51)" fill="#ffffff">
				      <path id="Path_32" data-name="Path 32" d="M344.869,566.7v7.213h-1.421V566.7h-3.17v17.487h3.17v-7.432h1.421v7.432h3.17V566.7Z" transform="translate(-340.278 -566.429)"/>
				      <path id="Path_20" data-name="Path 20" d="M387.724,573.842c0-6.011,1.64-8.306,4.482-8.306s4.482,2.295,4.482,8.306v1.311c0,6.011-1.639,8.306-4.482,8.306s-4.482-2.295-4.482-8.306Zm3.608,5.77c0,.721.35,1.115.874,1.115s.875-.393.875-1.115V569.274c0-.722-.35-1.115-.875-1.115s-.874.393-.874,1.115Z" transform="translate(-378.83 -565.482)"/>
				      <path id="Path_21" data-name="Path 21" d="M444.819,566.7c2.667,0,4.962,1.749,4.962,5.464v.438c0,3.716-2.3,5.464-4.919,5.464v6.121h-3.279V566.7Zm.044,8.743h.219c.874,0,1.421-.5,1.421-1.748v-2.623c0-1.246-.547-1.748-1.421-1.748h-.219Z" transform="translate(-422.59 -566.427)"/>
				      <path id="Path_22" data-name="Path 22" d="M495.519,566.7v2.842H492.9v4.371h2.3v2.842h-2.3v4.59h2.624v2.842h-5.9V566.7Z" transform="translate(-461.62 -566.426)"/>
				      <path id="Path_23" data-name="Path 23" d="M548.064,566.41h5.9v2.841h-2.624v4.372h2.186v2.842h-2.186V583.9h-3.279Z" transform="translate(-509.109 -566.189)"/>
				      <path id="Path_24" data-name="Path 24" d="M581.524,573.55c0-6.011,1.64-8.306,4.482-8.306s4.482,2.295,4.482,8.306v1.311c0,6.011-1.64,8.306-4.482,8.306s-4.482-2.295-4.482-8.306Zm3.608,5.77c0,.721.35,1.115.874,1.115s.875-.393.875-1.115V568.982c0-.722-.349-1.115-.875-1.115s-.874.393-.874,1.115Z" transform="translate(-536.297 -565.244)"/>
				      <path id="Path_25" data-name="Path 25" d="M638.1,566.411c2.755,0,4.854,1.924,4.854,5.311a5.734,5.734,0,0,1-1.858,4.59l1.64,7.367v.218h-3.17l-1.246-6.645h-.328l.153,6.645h-3.279V566.411Zm.044,8.525h.109c.766,0,1.422-.591,1.422-1.749v-2.4c0-1.158-.656-1.748-1.422-1.748h-.109Z" transform="translate(-579.64 -566.192)"/>
				      <path id="Path_26" data-name="Path 26" d="M707.844,566.41v13.88c0,2.186-.984,3.716-3.279,3.716a15.992,15.992,0,0,1-2.624-.219l.219-2.732h1.618c.634,0,.9-.284.9-.9V569.251H702.16V566.41Z" transform="translate(-634.139 -566.189)"/>
				      <path id="Path_27" data-name="Path 27" d="M747.225,566.41v13.115c0,2.841-1.531,4.59-4.045,4.59s-4.045-1.749-4.045-4.59V566.41h3.279v13.968c0,.721.241,1.115.766,1.115s.765-.394.765-1.115V566.41Z" transform="translate(-664.362 -566.189)"/>
				      <path id="Path_28" data-name="Path 28" d="M789.638,576.937a2.548,2.548,0,0,1,.131.984v1.618c0,.678.306,1.115.809,1.115.525,0,.831-.437.831-1.2,0-1.4-.918-2.688-1.88-3.956l-.634-.831c-1.486-1.946-2.1-3.235-2.1-5.159,0-2.513,1.508-4.263,3.979-4.263,2.514,0,3.891,1.749,3.891,4.525a4.266,4.266,0,0,0,.131,1.268v.218h-2.951a2.957,2.957,0,0,1-.131-.983v-1.465c0-.7-.328-1.049-.787-1.049-.481,0-.853.35-.853,1.224,0,1.29.677,2.208,1.639,3.432l.656.831c1.509,1.9,2.318,3.41,2.318,5.552,0,2.667-1.509,4.372-3.891,4.372-2.667,0-4.023-1.727-4.023-4.787a3.885,3.885,0,0,0-.131-1.224v-.219Z" transform="translate(-702.963 -565.242)"/>
				      <path id="Path_29" data-name="Path 29" d="M839.707,566.41v2.841H837.52V583.9h-3.279V569.251h-2.186V566.41Z" transform="translate(-739.863 -566.189)"/>
				      <rect id="Rectangle_707" data-name="Rectangle 707" width="3.279" height="17.487" transform="translate(100.798 0.218)"/>
				      <path id="Path_30" data-name="Path 30" d="M905.215,565.244c2.624,0,4.023,2.077,4.023,5.355a5.379,5.379,0,0,0,.109,1.2v.218h-3.279a3.574,3.574,0,0,1-.109-.983v-2.164c0-.612-.262-1.005-.787-1.005s-.852.393-.852,1.115v10.339c0,.721.328,1.115.852,1.115s.787-.393.787-1.005v-2.164a3.578,3.578,0,0,1,.109-.984h3.279v.219a4.932,4.932,0,0,0-.109,1.312c0,3.279-1.4,5.355-4.023,5.355-2.842,0-4.5-2.295-4.5-8.306V573.55c0-6.011,1.662-8.306,4.5-8.306" transform="translate(-795.648 -565.244)"/>
				      <path id="Path_31" data-name="Path 31" d="M957.506,566.41v2.841h-2.624v4.372h2.3v2.842h-2.3v4.59h2.624V583.9h-5.9V566.41Z" transform="translate(-836.998 -566.189)"/>
				    </g>
				    <g id="Group_6754" data-name="Group 6754" transform="translate(131.194 13.459)">
				      <path id="Path_17052" data-name="Path 17052" d="M53.584,24.112a.04.04,0,0,0-.04-.017c-1.011.119-2.2.25-2.2.25a5.573,5.573,0,0,0-4.389-.259,5.945,5.945,0,0,0-3.193,2.647l-.532-.179.376-3.11a5.494,5.494,0,0,0-2.481-5.155L27.94,9.9c-.28.634-1.958,8.555,5.541,12.248a51.314,51.314,0,0,1,4.731,2.4.672.672,0,0,1,.265.409s-6.942-2.3-8.834-2.958C23.4,19.851,12.487,16.12,7.316,14.4c0,0,1.8,13.942,18.34,19.674,5.226,1.853,9.47,3.35,9.47,3.35a2.41,2.41,0,0,1,1.346,1,2.2,2.2,0,0,1,.038,2.035c-2.436,4.612-10.9,20.649-11.36,21.515a9.288,9.288,0,0,0,3.489-2.432c1.141-1.31,2.02-2.39,4.058-4.758,2.493-2.9,5.168-6,5.168-6l.684,6.786a5.945,5.945,0,0,0,1.592-3.506c.209-1.775.836-6.894.836-6.894s4.526-5.307,8.37-9.778a10.464,10.464,0,0,0,2.628-9.06s1.286-1.732,1.606-2.173A.045.045,0,0,0,53.584,24.112Zm-4.211,2.9a.926.926,0,1,1,.225-1.292A.924.924,0,0,1,49.373,27.008Z" transform="translate(-7.316 -9.896)" fill="#d6001c"/>
				    </g>
				  </g>
				</svg>

			
				<!--<![endif]-->
				<div class="branding__logo-fallback">
					<h1 class="branding__title"><?php bloginfo( 'name' ); ?></h1>
				</div>
			</a>

			<nav id="site-navigation" class="site-navigation" role="navigation">
				<div class="mobile-options">
					<a class="gi-menu menu-btn" href="#nav">
						<?php if($GLOBALS['userInfo'] && in_array($GLOBALS['userInfo'], $GLOBALS['norway'])){
							echo "<span class=\"screen-reader-text\">meny</span>";
						}
						else {
							echo "<span class=\"screen-reader-text\">menu</span>";
						}
						?>
					</a> 
					<a class="mobile-donate" href="/donate">
						<?php if($GLOBALS['userInfo'] && in_array($GLOBALS['userInfo'], $GLOBALS['norway'])){
							echo "Gi gave";
						}
						else {
							echo "Donate";
						}
						?>
					</a>
				</div>
				<!-- Geo IP Menu -->
				<?php if($GLOBALS['userInfo'] && in_array($GLOBALS['userInfo'], $GLOBALS['norway'])){
					wp_nav_menu( array( 'theme_location' => 'norway-primary', 'container' => false, 'menu_class' => 'menu horizontal' ) ); 
				}
				else 
					wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'menu horizontal' ) );  
				?>
			</nav><!-- .site-header__navigation -->
		</div>

		<a class="screen-reader-text skip-link" tabindex="1" href="#content"><?php _e( 'Skip to content', 'hopeforjustice-2014' ); ?></a>

	</header><!-- .site-header -->

	<nav id="mobile-navigation" class="pushy pushy-right" role="navigation">
			<!-- Geo IP Menu -->
			<?php if($GLOBALS['userInfo'] && in_array($GLOBALS['userInfo'], $GLOBALS['norway'])){
				wp_nav_menu( array( 'theme_location' => 'norway-mobile', 'container' => false, 'menu_class' => 'menu vertical', 'walker' => new MobileNav() ) ); 
			}
			else 
				wp_nav_menu( array( 'theme_location' => 'mobile', 'container' => false, 'menu_class' => 'menu vertical', 'walker' => new MobileNav() ) );
			?>
	</nav>	

	<!-- Mobile menu site overlay -->
	<div class="site-overlay"></div>

	<!-- class="site-content--pushed" -- use this if banner exists -->

	<div id="content" class="site-content ">
