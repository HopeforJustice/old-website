<?php
/**
 * The template used for /givefreedom
 *
 * This template is just a redirect - if you're from a specific
 * country in North or South America, Australia or Cambodia then
 * redirect to the US givefreedom page, if you'd from Norway
 * then go to the Nowegian page otherwise redirect to the UK one.
 * 
 * @package hopeforjustice-2014
 */
?>
<?php
	
	// Antigua and Barbuda(AG),Argentina(AR), Australia(AU),Bahamas(BS),Barbados(BB),Belize(BZ),Bolivia(BO),Brazil (BR),Cambodia(KH),Canada(CA),Chile(CL),Colombia(CO),Costa Rica(CR),Dominica(DM),Dominican Republic(DM),Ecuador(EC),El Salvador(SV),French Guiana(GF),Grenada(GD),Guadeloupe(GP),Guatamala(GT),Guyana(GY),Haiti(HT),Honduras(HN),Jamaica(JM),Martinique(MQ),Mexico(MX),Nicaragua(NI),Panama(PA),Paraguay(PY),Peru(PE),Puerto Rico(PR),Saint Lucia(LC),Saint Vincent and the Grenadines(VC),Suriname(SR),Trinidad & Tobago(TT),United States(US),Uruguay(UY),Venezuela (VE), Virgin Islands U.S.(VI)
	$us_donate = array('AG','AU', 'AR','BB','BS','BO','BR','BZ','CA','CL','CO','CR','DO','DM','EC','KH','LC','GD','GF','GP','GT','GY','HN','HT','JM','MQ','MX','NI','PA','PE','PR','PY','SR','SV','TT','US','UM','UY','VC','VE','VI');

	// Norwegian countries - I've put this into an array because we'll no doubt add other Scandinavian countries at some point
	$no_donate = array('NO');
	
	// lookup country code of IP
	$geo = Wpengine\Geoip::instance();
    $userInfo = $geo->country();

	$url = 'http://' . $_SERVER['HTTP_HOST']; // Get the server
	if($userInfo && in_array($userInfo, $us_donate)){
	    $url .= '/givefreedom/us/';
	} elseif ($userInfo && in_array($userInfo, $no_donate)) {
		$url .= '/donate/no/';
	} else {
		$url .= '/givefreedom/uk/';
	}
	//echo $url;
	wp_redirect($url);
	exit;
?>