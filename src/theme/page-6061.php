<?php
/**
 * The template used for /Christmas2019popup (country redirect for campaign pop up)
 *
 * This template is just a redirect - if you're from a specific
 * country in North or South America, Australia or Cambodia then
 * redirect to the US donate page, otherwise redirect to the UK one.
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
	    $url .= '/christmas-2019-us?utm_source=popupUS&utm_medium=web&utm_campaign=christmas_19';
	} elseif ($userInfo && in_array($userInfo, $no_donate)) {
		$url .= '/christmas-appeal-no?utm_source=popupNO&utm_medium=web&utm_campaign=christmas_19';
	} else {
		$url .= '/christmas-2019-uk?utm_source=popupUK&utm_medium=web&utm_campaign=christmas_19';
	}
	//echo $url;
	wp_redirect($url);
	exit;
?>


