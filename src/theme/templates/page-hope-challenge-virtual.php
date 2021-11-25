<?php
/**
 * Template Name: Hope challenge virtual
 * 
 * @package hopeforjustice-2014
 */

get_header(); ?>

<?php
	
	// Antigua and Barbuda(AG),Argentina(AR), Australia(AU),Bahamas(BS),Barbados(BB),Belize(BZ),Bolivia(BO),Brazil (BR),Cambodia(KH),Canada(CA),Chile(CL),Colombia(CO),Costa Rica(CR),Dominica(DM),Dominican Republic(DM),Ecuador(EC),El Salvador(SV),French Guiana(GF),Grenada(GD),Guadeloupe(GP),Guatamala(GT),Guyana(GY),Haiti(HT),Honduras(HN),Jamaica(JM),Martinique(MQ),Mexico(MX),Nicaragua(NI),Panama(PA),Paraguay(PY),Peru(PE),Puerto Rico(PR),Saint Lucia(LC),Saint Vincent and the Grenadines(VC),Suriname(SR),Trinidad & Tobago(TT),United States(US),Uruguay(UY),Venezuela (VE), Virgin Islands U.S.(VI)
	$us = array('AG','AU', 'AR','BB','BS','BO','BR','BZ','CA','CL','CO','CR','DO','DM','EC','KH','LC','GD','GF','GP','GT','GY','HN','HT','JM','MQ','MX','NI','PA','PE','PR','PY','SR','SV','TT','US','UM','UY','VC','VE','VI');

	// Norwegian countries - I've put this into an array because we'll no doubt add other Scandinavian countries at some point
	$no = array('NO');
	$es = array('ES');
	$de = array('DE');
	$fr = array('FR');
	$it = array('IT');
	// lookup country code of IP
	$geo = Wpengine\Geoip::instance();
    $userInfo = $geo->country();
?>

<main style="background-color: #ffffff;" id="main" class="site-main HCV__main" role="main">
	<div class="HCV__header">
		<img class="HCV__logo" src="https://hopeforjustice.org/wp-content/uploads/2020/04/logo.svg">
	</div>

	<div class="HCV__Ticker" >
	      <ul id="HCV-ticker">
		        <li><img src="https://hopeforjustice.org/wp-content/uploads/2020/04/EFCT_Vertical_PL-scaled.jpg" class="HCV__ti-image"></li>
		        <li><img src="https://hopeforjustice.org/wp-content/uploads/2020/04/elkjop.png" class="HCV__ti-image"></li>
		        <li><img src="https://hopeforjustice.org/wp-content/uploads/2020/04/hells500.png" class="HCV__ti-image"></li>
		        <li><img src="https://hopeforjustice.org/wp-content/uploads/2020/04/kalas.png" class="HCV__ti-image"></li>
		        <li><img src="https://hopeforjustice.org/wp-content/uploads/2020/04/PI-Logo_rgb_undertekst-scaled.jpg" class="HCV__ti-image"></li>
		        <li><img src="https://hopeforjustice.org/wp-content/uploads/2020/04/rema2.png" class="HCV__ti-image"></li>
		        <li><img src="https://hopeforjustice.org/wp-content/uploads/2020/04/wahoo.jpeg" class="HCV__ti-image"></li>
		        <li><img src="https://hopeforjustice.org/wp-content/uploads/2020/04/EFCT_Vertical_PL-scaled.jpg" class="HCV__ti-image"></li>
		        <li><img src="https://hopeforjustice.org/wp-content/uploads/2020/04/elkjop.png" class="HCV__ti-image"></li>
		        <li><img src="https://hopeforjustice.org/wp-content/uploads/2020/04/hells500.png" class="HCV__ti-image"></li>
		        <li><img src="https://hopeforjustice.org/wp-content/uploads/2020/04/kalas.png" class="HCV__ti-image"></li>
		        <li><img src="https://hopeforjustice.org/wp-content/uploads/2020/04/PI-Logo_rgb_undertekst-scaled.jpg" class="HCV__ti-image"></li>
		        <li><img src="https://hopeforjustice.org/wp-content/uploads/2020/04/rema2.png" class="HCV__ti-image"></li>
		        <li><img src="https://hopeforjustice.org/wp-content/uploads/2020/04/wahoo.jpeg" class="HCV__ti-image"></li>
		        <li><img src="https://hopeforjustice.org/wp-content/uploads/2020/04/EFCT_Vertical_PL-scaled.jpg" class="HCV__ti-image"></li>
		        <li><img src="https://hopeforjustice.org/wp-content/uploads/2020/04/elkjop.png" class="HCV__ti-image"></li>
		        <li><img src="https://hopeforjustice.org/wp-content/uploads/2020/04/hells500.png" class="HCV__ti-image"></li>
		        <li><img src="https://hopeforjustice.org/wp-content/uploads/2020/04/kalas.png" class="HCV__ti-image"></li>
		        <li><img src="https://hopeforjustice.org/wp-content/uploads/2020/04/PI-Logo_rgb_undertekst-scaled.jpg" class="HCV__ti-image"></li>
		        <li><img src="https://hopeforjustice.org/wp-content/uploads/2020/04/rema2.png" class="HCV__ti-image"></li>
		        <li><img src="https://hopeforjustice.org/wp-content/uploads/2020/04/wahoo.jpeg" class="HCV__ti-image"></li>
		   </ul>
	</div>

	<div class="HCV__hero"></div>

	<div class="HCV__content">
		<div class="HCV__inner">
				<div class="HCV__center">
					<p>Choose your language:</p>
					<div class="HCV__flags">
						<a href="/virtualhopechallenge/" class="HCV__flag" style="background-image: url(https://hopeforjustice.org/wp-content/uploads/2020/05/usauk.jpg);"></a>
						<a href="/virtualhopechallenge/?geoip&country=FR" class="HCV__flag" style="background-image: url(https://hopeforjustice.org/wp-content/uploads/2020/04/france.jpg);"></a>
						<a href="/virtualhopechallenge/?geoip&country=DE" class="HCV__flag" style="background-image: url(https://hopeforjustice.org/wp-content/uploads/2020/04/germany.jpg);"></a>
						<a href="/virtualhopechallenge/?geoip&country=ES" class="HCV__flag" style="background-image: url(https://hopeforjustice.org/wp-content/uploads/2020/04/spain.jpg);"></a>
						<a href="/virtualhopechallenge/?geoip&country=IT" class="HCV__flag" style="background-image: url(https://hopeforjustice.org/wp-content/uploads/2020/05/italy.jpg);"></a>
					</div>
					<h2 class="HCV__title HCV__title--blue">
					<?php if($userInfo && in_array($userInfo, $es)){ ?>
					Únete a nosotros en el evento vEveresting más grande del mundo, the Hope Challenge 
					<?php } else if($userInfo && in_array($userInfo, $de)){ ?>
					Nimm mit uns an der weltgrößten vEveresting teil, der Hope Challenge. 
					<?php } else if($userInfo && in_array($userInfo, $fr)){ ?>
					Rejoignez-nous pour le plus grand évènement mondial « Veveresting the hope Challenge »
					<?php } else if($userInfo && in_array($userInfo, $it)){ ?> 
					Unisciti a noi nel vEveresting più grande del mondo, la Hope Challenge.
					<?php } else { ?>
					Take on the Hope Challenge - the world's largest virtual Everesting event
					<?php } ?>
					</h2>
				</div>

			<div class="HCV__white">
				<div class="HCV__part">
					<p>
					<?php if($userInfo && in_array($userInfo, $es)){ ?>
					El desafío vEveresting Hope Challenge es un evento de caridad como nunca has visto. El evento esta organizado en Zwift, donde podras esperar el apoyo de compañeros ciclistas de todo el mundo. A través de una transmisión en vivo te seguiremos durante todo el evento para asegurar que conquistes tu montaña. 
					<?php } else if($userInfo && in_array($userInfo, $de)){ ?>
					Die vEveresting Hope Challenge ist eine Spendensammelaktion, wie Du sie noch nie zuvor erlebt hast. Die Veranstaltung wird in Zwift stattfinden, wo Du die Unterstützung von Radsportkollegen aus der ganzen Welt erwarten kannst. Über einen Live-Stream werden wir dir während der gesamten Veranstaltung folgen und dafür sorgen, dass Du den Berg bezwingst, den Du dir vorgenommen hast. 
					<?php } else if($userInfo && in_array($userInfo, $fr)){ ?>
					Le Veveresting Hope Challenge est un événement caritatif exceptionnel qui se déroulera sur le logiciel Zwift  accessible uniquement sur invitation où vous trouverez  l’aide et les encouragements de cyclistes du monde entier. Grace à une diffusion internet en live nous vous suivrons pendant l’évènement, afin de nous assurer de votre succès dans  la conquête de la montagne de votre choix.
					<?php } else if($userInfo && in_array($userInfo, $it)){ ?>
					Il vEveresting Hope Challenge è un evento di raccolta fondi come non hai mai visto prima. L’evento si terrà su Zwift dove puoi aspettarti il supporto di altri ciclisti di tutto il mondo. Attraverso un live streaming ti seguiremo durante tutto l'evento assicurandoti di conquistare la montagna per cui sei partito.
					<?php } else { ?>
					The vEveresting Hope Challenge is a fundraiser event like you have never experienced before.
					Ride alongside fellow cyclists from all over the world on virtual roads through Zwift and conquer your mountain. With expert commentators, guests and live feeds from cyclists attending, be a part of the Ride for Freedom and help put an end to modern day slavery.
					<?php } ?>
					</p>
					<a data-toggle="modal" data-target="#payment-modal" class="button button--blue button--solid">Sign up and donate</a>
					<a data-toggle="modal" data-target="#payment-modal-no-donation" class="button button--blue button--solid">Just sign up</a>
					<a data-toggle="modal" data-target="#contact-modal" class="button button--blue button--hollow">Contact us</a>
				</div>
				

				<div class="HCV__part">
					<h2 class="HCV__title">
					<?php if($userInfo && in_array($userInfo, $es)){ ?>
					Conquista tu montaña 
					<?php } else if($userInfo && in_array($userInfo, $de)){ ?>
					Erobere deinen Berg
					<?php } else if($userInfo && in_array($userInfo, $fr)){ ?>
					Partez à l’assaut de votre montagne
					<?php } else if($userInfo && in_array($userInfo, $it)){ ?>
					Conquista la tua montagna
					<?php } else { ?>
					Conquer your Mountain
					<?php } ?>
					</h2>
					<img class="HCV__img" src="https://hopeforjustice.org/wp-content/uploads/2020/04/fbbanner.jpg">
					<p>
					<?php if($userInfo && in_array($userInfo, $es)){ ?>
						Hay cuatro categorías de elegir:  
						<br><br>
						A.	10K+ (10 000 metros de elevación)<br>
						B.	Mount Everest (8848 metros de elevación)<br>
						C.	Base Camp (4434 metros de elevación)<br>
						D.	El Capitán (2307 metros de elevación)<br>
						<br><br>
						Tu categoría se elije despues de haber recibido los detalles de como entrar al evento. 
					<?php } else if($userInfo && in_array($userInfo, $de)){ ?>
						Es stehen 4 Kategorien zur Auswahl:
						<br><br>
						A. 10K+ (10.000 Höhenmeter)  
						<br>
						B. Mount Everest (8.848 Höhenmeter) 
						<br>
						C. Basislager (4.424 Höhenmeter)  
						<br>
						D. El Capitan (2.307 Höhenmeter)
						<br><br>
						Deine Kategorie wird ausgewählt, nachdem Du Informationen zur Teilnahme an der Veranstaltung erhalten hast.
					<?php } else if($userInfo && in_array($userInfo, $fr)){ ?>
						Vous pourrez choisir parmi 4 catégories :
						<br>A : 10k (10 000m de dénivelé positif)
						<br>B : mont everest (8848m de dénivelé positif)
						<br>C : Camps de base ( 4424 m de dénivelé positif)
						<br>D : el capitan (2307m de dénivelé positif) <br>
						<br>Vous choisirez votre catégorie lors de votre entrée dans l’événement à l’aide d’un lien d’invitation. 
					<?php } else if($userInfo && in_array($userInfo, $it)){ ?>
						Ci sono 4 categorie tra cui scegliere:
						<br>A : 10K + (10.000 metri di altitudine)
						<br>B : Monte Everest (8848 metri di altitudine)
						<br>C : Campo base  (4424 metri di altitudine)
						<br>D : El Capitan (2307 metri di altitudine) <br>
						<br>La tua categoria viene scelta dopo aver ricevuto i dettagli su come partecipare all'evento.
					<?php } else { ?>
						There are 4 categories to choose from: 
						<br><br>
						A.	10K+ (10.000 metres of elevation)<br>
						B.	Mount Everest (8848 metres of elevation)<br>
						C.	Base Camp (4424 metre of elevation)<br>
						D.	El Capitan (2307 metres of elevation)<br>
						<br>
						Your category is chosen after you have received the details of how to enter the event. 
					<?php } ?>
					</p>

				</div>

				<div class="HCV__part">
					<h2 class="HCV__title HCV__title--red">
					<?php if($userInfo && in_array($userInfo, $es)){ ?>
					Anda en bicicleta por libertad  
					<?php } else if($userInfo && in_array($userInfo, $de)){ ?>
					Fahr für die Freiheit  
					<?php } else if($userInfo && in_array($userInfo, $fr)){ ?>
					Why should I Ride for Freedom?
					<?php } else { ?>
					Why should I Ride for Freedom?
					<?php } ?>
					</h2>
					<img class="video-trig" style="cursor: pointer;" data-toggle="modal" data-target="#video-modal" class="HCV__img" src="https://hopeforjustice.org/wp-content/uploads/2020/04/abernashcover@2x.png">
					<p>
					<?php if($userInfo && in_array($userInfo, $es)){ ?>
					Este es un evento de caridad para beneficiar el trabajo de la organicacion Hope for Justice (Esperanza por Justicia) que quieren acabar con la esclavitud moderna.
					<br><br> 
					Traficó humano y esclavitud moderna es un desafio masivo. Se estima que hay cerca de 40 millones de personas que son victimas de esclavitud moderna cada año. Hope for Justice desea un mundo libre de esclavitud y trabaja para protejer y rescatar a los seres humanos mas vulnerable en todo el mundo. Con este evento de caridad, podemos asegurar que este trabajo sigua cambiando vidas, y que se pueda seguir liberando a miles de víctimas durante y después de la pandemia. #keephopealive 
					<?php } else if($userInfo && in_array($userInfo, $de)){ ?>
					Dies ist eine Spendensammelaktion, die die Arbeit der Organisation Hope for Justice unterstützt, um moderne Sklaverei zu beenden. 
					<br><br>
					Menschenhandel und moderne Sklaverei stellen eine massive Herausforderung dar. Schätzungen zufolge werden jedes Jahr 40 Millionen Menschen Opfer von Sklaverei. Hope for Justice möchte in einer Welt frei von Sklaverei leben und sich für den Schutz und die Rettung einiger der verletzlichsten Männer, Frauen und Kinder auf der Welt einsetzen. Mit dieser Spendenaktion wollen wir sicherstellen, dass diese lebensverändernde Arbeit (Link) Tausenden von Opfern während und nach der Covid-19-Krise Freiheit und Gerechtigkeit bringt. #keephopealive
					<?php } else if($userInfo && in_array($userInfo, $fr)){ ?>
					Cet événement caritatif sera au bénéfice de Hope for Justice pour mettre fin à l’esclavage moderne. Le trafic d’êtres humains et l’esclavage moderne est encore trop présent. 
					<br><br>
					On estime encore à 40 millions de personnes le nombre de victimes d’esclavage moderne chaque année. Hope for Justice a pour vocation de libérer le monde de toute forme d’esclavage et travaille pour protéger et aider les hommes femmes et enfants les plus vulnérables. Grace à cette collecte, nous voulons également nous assurer que des changements dans la vie de milliers de victimes durement touchées par la crise du Covid 19, auront bien lieu. Ceci afin de leur garantir une bonne reconstruction et le maintient de leur libertés. 
					<?php } else if($userInfo && in_array($userInfo, $it)){ ?>
					Questo è un evento di raccolta fondi a scopo benefico di Hope for Justice per porre fine alla schiavitù moderna. 
					<br><br>
					La tratta di esseri umani e la schiavitù moderna sono una sfida enorme. Si stima che ogni anno 40 milioni di persone siano vittime della schiavitù moderna. Hope for Justice vuole vivere nel mondo libero dalla schiavitù e lavorare per proteggere e salvare alcuni degli uomini, donne e bambini più vulnerabili del mondo. Attraverso questo evento di raccolta fondi garantiremo che questo lavoro che cambia la vita (link), offrirà libertà e ristabilimento a migliaia di vittime durante e dopo la crisi di Covid-19.  #KeepHopeAlive   
					<?php } else { ?>
					This is a fundraising event to benefit the work of Hope for Justice to bring an end to modern slavery. 
						<br><br>
						Human trafficking and modern slavery is a massive challenge. It is estimated that 40 million people are victims of modern slavery every year. Hope for Justice wants to live in world free from slavery and work to protect and rescue some of the most vulnerable men, women and children around the world. Through this fundraising event we will ensure that this <a href="https://hopeforjustice.org">life changing work</a>, will be providing freedom and restoration to thousands of victims throughout and after the COVID-19 crisis. #keephopealive
					<?php } ?>	
					</p>
				</div>

				<div class="HCV__part">
					<?php if($userInfo && in_array($userInfo, $es)){ ?>
 					<h2 class="HCV__title HCV__title--blue">Transmisión en vivo en Youtube y Twitch </h2>
					<p>
						Con comentaristas expertos, invitados y transmisiones en directo de ciclistas en el evento, queremos dar apoyo y asegurar que sea un evento memorable, y también darle propósito a tu sufrimiento. 
					</p>
					<?php } else if($userInfo && in_array($userInfo, $de)){ ?>
					<h2 class="HCV__title HCV__title--blue">Livestream durch YouTube und Twitch</h2>
					<p>
						Mit fachkundigen Kommentatoren, Gästen und Live-Feeds von teilnehmenden Radfahrern wird der Live-Stream Gemeinschaft und Unterstützung bieten, um ein unvergessliches Event zu gestalten und deinen Qualen einen Sinn zu geben.  
					</p>
					<?php } else if($userInfo && in_array($userInfo, $fr)){ ?>
					<h2 class="HCV__title HCV__title--blue">Diffusion en live sur Youtube et Twich</h2>
					<p>
						Avec la présence de commentateurs confirmés, d’invités, et grâce aux discussions entre cyclistes présents, la diffusion en direct permettra d’assurer entraide et encouragements, garantissant un événement inoubliable à la hauteur de vos difficiles efforts.  
					</p>
				<?php } else if($userInfo && in_array($userInfo, $it)){ ?>
					<h2 class="HCV__title HCV__title--blue">Live Streaming su YouTube e Twitch</h2>
					<p>
						Con commentatori esperti, ospiti e feed dal vivo dei ciclisti presenti, il livestream fornirà una comunità e supporto garantendo un evento memorabile e lo scopo della tua sofferenza. 
					</p>
					<?php } else { ?>
					<h2 class="HCV__title HCV__title--blue">Livestream through YouTube and Twitch</h2>
					<p>
						With expert commentators, guests and live feed from cyclists attending, the livestream will provide a community and support ensuring a memorable event, and purpose to your suffering! 
					</p>
					<?php } ?>
				</div>

				<div class="HCV__part">
					<?php if($userInfo && in_array($userInfo, $es)){ ?>
					<h2 class="HCV__title">Como puedo ser invitado al evento?</h2>
					<p>
						<br><br>
						Por favor asegure que su correo electrónico es correcto ya que esta es la única manera que tenemos para tomar contacto con ustedes y dejaros entrar al evento. 
	 					<br><br>
						Todos los participantes tienen que tener su propia cuenta en <a target="_blank" href="http://zwift.com/">Zwift</a>, y un <a target="_blank" href="https://support.zwift.com/en_us/supported-trainers-BkPlq7gr">rodillo compatible.</a> 
						<br><br>
						<strong>El evento es el 27 de junio 2020.</strong><br><br> 
					<?php } else if($userInfo && in_array($userInfo, $de)){ ?>
					<h2 class="HCV__title">Wie kann ich zu der Veranstaltung eingeladen werden?</h2>
					<p>
						<br><br>
						Bitte überprüfe, dass deine E-Mail-Adresse korrekt ausgefüllt ist, da dies unsere einzige Möglichkeit ist, mit dir in Kontakt zu treten und dich an der Veranstaltung teilnehmen zu lassen.  
	 					<br><br>
						Alle Teilnehmer müssen über ein eigenes <a target="_blank" href="http://zwift.com/">Zwift</a>-Konto und einen <a target="_blank" href="https://support.zwift.com/en_us/supported-trainers-BkPlq7gr">kompatiblen Indoor-Trainer verfügen.</a>  
						<br><br>
						<strong>Die Veranstaltung findet am 27. Juni 2020 statt.</strong><br><br>
					<?php } else if($userInfo && in_array($userInfo, $fr)){ ?>
					<h2 class="HCV__title">Comment puis-je être invité à l’événement ?</h2>
					<p>
						<br><br>
						Assurez-vous de remplir correctement votre email car ce sera notre seul moyen de vous contacter et de vous permettre de participer. 
	 					<br><br>
						Tous les participants devront avoir leur propre compte <a target="_blank" href="http://zwift.com/">Zwift</a> et un <a target="_blank" href="https://support.zwift.com/en_us/supported-trainers-BkPlq7gr">home trainer compatible.</a>
						<br><br>
						<strong>L’événement démarrera à 11 :00 GMT (12 :00 Paris) le 27 juin 2020</strong><br><br> 
					<?php } else if($userInfo && in_array($userInfo, $it)){ ?>
					<h2 class="HCV__title">Come posso essere invitato all'evento?</h2>
					<p>
						<br><br>
						Assicurati di compilare correttamente la tua e-mail poiché questo è il nostro unico modo di contattarti e farti partecipare all'evento. 
	 					<br><br>
						Tutti i partecipanti devono avere il proprio account <a target="_blank" href="http://zwift.com/">Zwift</a> ed uno <a target="_blank" href="https://support.zwift.com/en_us/supported-trainers-BkPlq7gr">smart trainer compatibile</a>
						<br><br>
						<strong>L'evento si svolgerà il 27 Giugno 2020.</strong><br><br> 
					<?php } else { ?>
					<h2 class="HCV__title">How do I sign up to ride?</h2>
					<p>
						All participants are encouraged to donate to Hope for Justice upon sign up.
						<br><br>
						Please ensure that you fill out your email correctly as this would be our only way of contacting you and letting you into the event. 
	 					<br><br>
						All participants are required to have their own <a target="_blank" href="http://zwift.com/">Zwift account</a> and a <a target="_blank" href="https://support.zwift.com/en_us/supported-trainers-BkPlq7gr">compatible indoor trainer</a>
						<br><br>
						<strong>The event is happening on the 27th of June 2020.</strong><br><br>
					<?php } ?>

						<a data-toggle="modal" data-target="#payment-modal" class="button button--blue button--solid">Sign up and donate</a>
						<a data-toggle="modal" data-target="#payment-modal-no-donation" class="button button--blue button--solid">Just sign up</a>
						<a data-toggle="modal" data-target="#contact-modal" class="button button--blue button--hollow">Contact us</a>
					</p>
				</div>
			</div>
		</div>
	</div>

	<div class="HCV__content HCV__faq">
		<div class="HCV__inner">
			<div class="HCV__faq-content">
				<h2>FAQ</h2>
				<p>We apologise that our FAQ and answers are only available in English. Please get in touch with us if these answers are not sufficient.</p>
				<div style="cursor: pointer;" class="dropdown">
		            <p style="text-decoration: underline;">What is the Everesting challenge? </p>
		            <p style="display: none;"class="answer">The concept of Everesting is fiendishly simple: Pick any hill, anywhere in the world and complete repeats of it in a single activity until you climb 8,848m – the equivalent height of Mt Everest. Complete the challenge on a bike, on foot, or online, and you’ll find your name in the Hall of Fame, alongside the best climbers in the world. For full details on specific rules related to virtual Everesting see: <a href="https://everesting.cc/virtual-everesting-rules/">https://everesting.cc/virtual-everesting-rules/</a>  <a href="https://everesting.cc/">https://everesting.cc/</a></p>
	            </div>
	            <div style="cursor: pointer;" class="dropdown">
		            <p style="text-decoration: underline;">What is Hope Challenge and who is Hope for Justice?</p>
		            <p style="display: none;"class="answer">Hope for Justice is a global organisation that exists to bring an end to modern slavery by preventing exploitation, rescuing victims, restoring lives and reforming society. Last year Hope for Justice succeeded in bringing over 2,000 victims out of exploitation. For more information, please see:<a href="http://www.hopeforjustice.review"> www.hopeforjustice.review</a>
		            <br><br>
		            Hope Challenge is an annual fundraising campaign to support the work of Hope for Justice.
		        	</p>
	            </div>
	            <div style="cursor: pointer;" class="dropdown">
		            <p style="text-decoration: underline;">What is Zwift and how can I join?</p>
		            <p style="display: none;"class="answer">Zwift is an online training platform. To use Zwift you will need an account, a device to run Zwift on (work with mac/pc/tablets), a compatible indoor smart trainer and a bike. For more details please see: <a href="https://zwift.com/eu/video/how-to-cycling">https://zwift.com/eu/video/how-to-cycling</a></p>
	            </div>
	            <div style="cursor: pointer;" class="dropdown">
		            <p style="text-decoration: underline;">What hill on Zwift will be used?</p>
		            <p style="display: none;"class="answer">Actually, there are two hills that will be used. Both from Watopia: The mighty “Alpe d’ Zwift” and feared “Reverse KOM”. We highly recommend that you try the two different hills in advance to find the better fit for you before you enter the event. You cannot change the hill during the event.</p>
	            </div>
	            <div style="cursor: pointer;" class="dropdown">
		            <p style="text-decoration: underline;">Direct drive or wheel-on trainer?</p>
		            <p style="display: none;"class="answer">Both trainers would be an excellent instrument of torture for this challenge. The difference is that with a wheel-on trainer you would have to go for the Revers KOM route. This is to avoid your back wheel spinning and losing grip from the step gradient at the Alpe d’ Zwift route.</p>
	            </div>
	            <div style="cursor: pointer;" class="dropdown">
		            <p style="text-decoration: underline;">What if I choose the wrong category?  </p>
		            <p style="display: none;"class="answer">Don’t worry! This race is not based on w/kg like normal race categories on Zwift. Categories in the challenge is based on you elevation target. Everybody will be riding their own pace.</p>
	            </div>
	            <div style="cursor: pointer;" class="dropdown">
		            <p style="text-decoration: underline;">When do I start?</p>
		            <p style="display: none;"class="answer">We would recommend that you start 9 AM (your local time). This would allow you to get a full night sleep and be ready for your challenge ahead. Everyone who have signed up will receive instructions as to how you join in with the rest of the group.  We will ensure that our live stream crew are ready to pull some long hours to give you the support you need to finish.  </p>
	            </div>
	            <div style="cursor: pointer;" class="dropdown">
		            <p style="text-decoration: underline;">I can’t get the page to process my donation, what do I do? </p>
		            <p style="display: none;"class="answer">If, you for some reason can’t get the page to accept your VISA card details please get in touch with us on <a href="mailto: smo@efct.no">smo@efct.no</a></p>
	            </div>
	            <div style="cursor: pointer;" class="dropdown">
		            <p style="text-decoration: underline;">I’ve donated but I did not get a receipt?</p>
		            <p style="display: none;"class="answer">Have you checked your spam folder? Or, perhaps your email address was not correctly entered. Please do get in touch with <a href="mailto: info.uk@hopeforjustice.org">info.uk@hopeforjustice.org</a> and give your name and amount donated and will find your donation and provide you with your receipt.</p>
	            </div>
	            <div style="cursor: pointer;" class="dropdown">
		            <p style="text-decoration: underline;">Why should I donate to Hope for Justice?</p>
		            <p style="display: none;"class="answer">All donations to Hope for Justice will go towards keeping their <a href="https://hopeforjustice.org">life changing work</a> running. So that even more people can live free from slavery.</p>
	            </div>
	            <div style="cursor: pointer;" class="dropdown">
		            <p style="text-decoration: underline;">Can I fundraise beyond what I’ve already donated?</p>
		            <p style="display: none;"class="answer">Yes, you certainly can. Everesting, being a time consuming activity, is perfect for sending out some updates on social media, or setting up a fundraising page to help raise more funds. Channels like Facebook or Justgiving would work brilliantly to help you fundraise. Don’t be shy, go all in, let’s see you conquer that mountain as well.</p>
	            </div>
	            <div style="cursor: pointer;" class="dropdown">
		            <p style="text-decoration: underline;">How much of the donation goes towards Hope for Justice?</p>
		            <p style="display: none;"class="answer">Everything! You are donating directly to Hope for Justice, not via a third party. The expenses related to the event will all be covered by our amazing partners; <a href="https://www.elkjop.no/">Elkjøp</a>, <a href="https://uk.wahoofitness.com/">Wahoo</a>, <a href="https://www.printinform.no/">Printinform</a>, <a href="https://www.kalas.co.uk/">Kalas</a>, <a href="https://hells500.com/">Hells500</a>, <a href="https://www.efct.no/">EFCT!</a> 
		            <br><br>
					And in case you wondered, Hope for Justice publish their financial statements. For more information please see: <a href="https://hopeforjustice.org/financials/">https://hopeforjustice.org/financials/</a></p>
	            </div>
	            <div style="cursor: pointer;"  class="dropdown">
		            <p style="text-decoration: underline;">Who is the organiser of this event?</p>
		            <p style="display: none;"class="answer">EFCT! is the main driver behind this event. A passionate/crazy Norwegian called SMO (Stein Magnus Olafsrud) is the owner of EFCT! and through his company he sells training equipment from Wahoo and organises fundraising events like this Hope Challenge. Together with the other amazing partners; <a href="https://www.elkjop.no/">Elkjøp</a>,  <a href="https://uk.wahoofitness.com/">Wahoo</a>, <a href="https://www.printinform.no/">Printinform</a>, <a href="https://hells500.com/">Hells500</a>, <a href="https://www.kalas.co.uk/">Kalas</a>, <a href="https://www.efct.no/">EFCT!</a> we will provide you with a tough and meaningful challenge this June. </p>
	            </div>
	            <div style="cursor: pointer;" class="dropdown">
		            <p style="text-decoration: underline;">How can I get involved in the fight against human trafficking and modern slavery?</p>
		            <p style="display: none;"class="answer">So glad you asked! Do get in touch with Hope for Justice. Their page “take action” gives you plenty of opportunity. Find what suits you and join the fight against modern slavery! You think your effort is too small? Not true, remember; No raindrop ever felt responsible for the flood. Let’s do this. #keephopealive </p>
	            </div>
        	</div>
		</div>
	</div>


    <!-- Modal video -->
    <div class="modal fade video-modal" id="video-modal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="video-modal__dialog">
        <div class="video-modal__content">
          <div class="video-modal__header">
            <a href="#" data-dismiss="modal" class="gi-close video-modal__close"><span class="accessibility">Close</span></a>
          </div>
          <div class="video-modal__body">
            <iframe id="video" width="560" height="315" src="https://www.youtube.com/embed/Ryk-NUZFWlU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>
          <div class="video-modal__footer">
            <button type="button" class="video-modal__footer-close button button--solid button--blue" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal form -->
    <div class="modal fade payment-modal" id="payment-modal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="payment-modal__dialog">
        <div class="payment-modal__content">
          
          <div class="video-modal__header">
            <a href="#" data-dismiss="modal" class="gi-close video-modal__close campaign__video-modal__close"><span class="accessibility">Close</span></a>
          </div>
          
            <div class="payment-modal__body">
                <div class="payment-modal__payment">
                    <?php the_field('form'); ?>    
                </div>
            </div>
        
        </div>
      </div>
    </div>

    <!-- Modal form (no donation)-->
    <div class="modal fade payment-modal" id="payment-modal-no-donation" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="payment-modal__dialog">
        <div class="payment-modal__content">
          
          <div class="video-modal__header">
            <a href="#" data-dismiss="modal" class="gi-close video-modal__close campaign__video-modal__close"><span class="accessibility">Close</span></a>
          </div>
          
            <div class="payment-modal__body">
                <div class="payment-modal__payment">
                    <?php the_field('form_no_donation'); ?>    
                </div>
            </div>
        
        </div>
      </div>
    </div>

    <!-- Modal contact -->
    <div class="modal fade payment-modal" id="contact-modal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="payment-modal__dialog">
        <div class="payment-modal__content">
          
          <div class="video-modal__header">
            <a href="#" data-dismiss="modal" class="gi-close video-modal__close campaign__video-modal__close"><span class="accessibility">Close</span></a>
          </div>
          
            <div class="payment-modal__body">
                <div class="payment-modal__payment">
                	<?php if($userInfo && in_array($userInfo, $es)){ ?>
					<h2>Información de contacto</h2>
                    <p style="font-size: 18px;">
                    	EFTC! (Organizador de evento)<br> 
						Stein Magnus Olafsrud<br> 
						mobile: + 47 924 52 003<br>
						email: smo@efct.no<br>
					</p> 
					<?php } else if($userInfo && in_array($userInfo, $de)){ ?>
					<h2>Kontakt</h2>
                    <p style="font-size: 18px;">
                    	Ansprechpartner EFTC! (Veranstalter)<br> 
						Stein Magnus Olafsrud<br> 
						Tel. 0047 924 52 003<br>
						E-Mail: smo@efct.no<br>
					</p> 
					<?php } else if($userInfo && in_array($userInfo, $fr)){ ?>
                    <h2>Contact information</h2>
                    <p style="font-size: 18px;">
                    	Contact person EFTC! (Event organiser)<br> 
						Stein Magnus Olafsrud<br> 
						mobile: + 47 924 52 003<br>
						email: smo@efct.no<br>
					</p>
					<?php } else if($userInfo && in_array($userInfo, $it)){ ?>
                    <h2>Informazioni sui contatti</h2>
                    <p style="font-size: 18px;">
                    	Persona di contatto EFTC! (Organizzatore dell’evento) <br> 
						Stein Magnus Olafsrud<br> 
						cellulare: + 47924 52003<br>
						e-mail: smo@efct.no<br>
					</p>
					<?php } else { ?>
                    <h2>Contact information</h2>
                    <p style="font-size: 18px;">
                    	Contact person EFTC! (Event organiser)<br> 
						Stein Magnus Olafsrud<br> 
						mobile: + 47 924 52 003<br>
						email: smo@efct.no<br>
					</p> 
					<?php } ?>
                </div>
            </div>
        
        </div>
      </div>
    </div>

</main><!-- /#main -->


<?php get_footer(); ?>