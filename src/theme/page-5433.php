<?php
/**
 * The template used for /trekagainsttrafficking/- Extreme Challenge '19 fundraising campaign
 *
 * This template is just a redirect
 * 
 * @package hopeforjustice-2014
 */
?>
<?php
	
	// Antigua and Barbuda(AG),Argentina(AR), Australia(AU),Bahamas(BS),Barbados(BB),Belize(BZ),Bolivia(BO),Brazil (BR),Cambodia(KH),Canada(CA),Chile(CL),Colombia(CO),Costa Rica(CR),Dominica(DM),Dominican Republic(DM),Ecuador(EC),El Salvador(SV),French Guiana(GF),Grenada(GD),Guadeloupe(GP),Guatamala(GT),Guyana(GY),Haiti(HT),Honduras(HN),Jamaica(JM),Martinique(MQ),Mexico(MX),Nicaragua(NI),Panama(PA),Paraguay(PY),Peru(PE),Puerto Rico(PR),Saint Lucia(LC),Saint Vincent and the Grenadines(VC),Suriname(SR),Trinidad & Tobago(TT),United States(US),Uruguay(UY),Venezuela (VE), Virgin Islands U.S.(VI)
	$us_donate = array('AG','AU', 'AR','BB','BS','BO','BR','BZ','CA','CL','CO','CR','DO','DM','EC','KH','LC','GD','GF','GP','GT','GY','HN','HT','JM','MQ','MX','NI','PA','PE','PR','PY','SR','SV','TT','US','UM','UY','VC','VE','VI');

	
	// lookup country code of IP
	$geo = Wpengine\Geoip::instance();
    $userInfo = $geo->country();


	if($userInfo && in_array($userInfo, $us_donate)){
	    $url .= 'https://www.classy.org/campaign/extreme-challenge-kilimanjaro/c235180';
	}else {
		$url .= 'https://www.justgiving.com/campaign/kilimanjaro2019';
	}
	//echo $url;
	wp_redirect($url);
	exit;
?>

