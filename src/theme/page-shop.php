<?php
/**
 * The template used for /shop
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

	// lookup country code of IP
	$geo = Wpengine\Geoip::instance();
    $userInfo = $geo->country();
    
	if($userInfo && in_array($userInfo, $us_donate)){
	    $url = 'http://hopeforjusticeus.bigcartel.com/';
	} else {
		$url = 'http://hopeforjustice.bigcartel.com/';
	}
	wp_redirect($url);
	exit;
?>