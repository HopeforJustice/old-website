<?php
/**
 * The template used for NO one off donation /norway-donate-once
 *
 * Root Donate page is a redirect which should point you to the correct page based on your location...
 * 
 * @package hopeforjustice-2014
 */

get_header();?>
<section class="site-main donate-uk donate-uk__secondimg" role="main">
    <div class="inner">
        <div class="donate-uk__wrapper">
                <div class="donate-uk__msgwrap">
                    <div class="donate-uk__message">
                            <h1 class="beta" id="donate-uk__msgheader">Gi <strong class="donate-uk__orange">frihet</strong></h1>
                            <p id="donate-uk__msgp">Gaven din kan endre liv og stoppe slaveriet.
                                <br><br><strong class="donate-uk__orange">200 kr</strong> – kan gi måltider i én uke til ett av barna ved våre Lighthouse-boligsentre, der de er trygge fra utnyttelse.
                                <br><br><strong class="donate-uk__orange">500 kr</strong> – kan gi akutt hjelp og losji for et sårbart barn i én måned
                                <br><br><strong class="donate-uk__orange">50 000 kr</strong> – kan gjøre det mulig for teamet vårt å gjennomføre en fullstendig etterforskning for å identifisere og redde et barn eller en voksen fra moderne slaveri.</p>
                    </div>
                </div>

                <div class="donate-uk__formwrap">
                        <ul class="donate-uk__options">        
                            <li>
                                <a href="https://www2.solidus.no/ASrd/RegistrerAvtale.aspx?ID=kClkmr6TI0FJWh425kpLtA==" class="button button--hollow button--orange button--lefthalf" id="donate-monthly-select">Fast giver</a>
                            </li>
                            <li>
                                <a class="button button--solid button--orange button--righthalf" id="donate-one-off-select">Enkeltgave</a>
                            </li>
                        </ul>
                        <div class="donate-uk__form">
                            <!--<div class="donate-uk__currency"><a id="currency">Change Currency</a></div>-->
                            <div class="donate-uk__amount__inner donate-uk__amount__inner--no">
                                <input type="text" name="Amount" class="required numberOnly form-control donate-uk__amount" id="Amount" maxlength="10" placeholder="50" value="200">
                            </div>
                            <div class="donate-uk__modal-trig"><a data-toggle="modal" data-target="#payment-modal" class="button button--solid button--orange">Gi gave</a>
                            <a data-toggle="modal" data-target="#vipps-modal" class="button button--solid button--vipps">
                                Gi gave <img class="vipps-button-logo" src="https://hopeforjustice.org/wp-content/uploads/2021/06/vipps-logo.png">
                            </a>
                            </div>

                        </div>
                </div>
        </div>
    </div>
</section>
                                            


<section class="guardian-slice">
    <div class="inner">
        <div class="guardian-slice__info">
            <img class="guardian-slice__logo" src="https://hopeforjustice.org/wp-content/uploads/2019/07/guardian-dark.svg">
            <h3 class="guardian-slice__header">Bli en VOKTER og invester i en<br> verden fri fra slaveri.</h3>
            <p class="guardian-slice__p">Ved å gi fast hver måned blir du en del av et felleskap av VOKTER. Deres lidenskap og økonomiske engasjement muliggjør og styrker Hope for Justice sine livsforvandlende anti-trafficking-prosjekter verden rundt.</p>
            <a class="button button--blue button--solid"href="https://www2.solidus.no/ASrd/RegistrerAvtale.aspx?ID=kClkmr6TI0FJWh425kpLtA==
            ">Bli en VOKTER</a>
        </div>
    </div>
</section>



<!-- Modal form -->
<div class="modal fade" data-backdrop="static" id="payment-modal" tabindex="-1" role="dialog" aria-hidden="false">
  <div class="modal__dialog">
    <div class="modal__content">
        <div style="margin-bottom: 20px; "><a style="font-size: 12px; font-weight: 300; text-decoration: underline; text-decoration: underline; cursor: pointer;" data-dismiss="modal">Gir <span id="textAmount"></span> Kr én gang (klikk for å endre beløp)</a></div>
        <?php echo do_shortcode("[gravityform id=\"71\" title=\"false\" description=\"false\" ajax=\"true\"]"); ?>
        <a href="#" data-dismiss="parfait-modal" class="gi-close modal__close"><span class="accessibility">Close</span></a>
    </div>
 </div>
</div>

<!-- Modal vipps -->
<div class="modal fade" id="vipps-modal" tabindex="-1" role="dialog" aria-hidden="false">
  <div class="modal__dialog">
    <div class="modal__content">
        
        <img class="vipps-logo-modal alignnone size-full wp-image-4859" src="https://hopeforjustice.org/wp-content/uploads/2019/09/vipps-logo.svg" alt="" />
        <p>Du er velkommen til å gi en gave ved å vippse til 586365 eller ved å overføre til kontonummer 8601.56.25793</p>
        <p>Husk at gaver over 500 kr kan du få skattefradrag på. Send oss din personinformasjon til info.norge@hopeforjustice.org, så fikser vi resten! Personinformasjon for skattefritak er fullt navn, adresse og personnummer på 11 siffer (eller organisasjonsnummer om du ønsker å føre det mot bedrift)</p>
        

        <a href="#" data-dismiss="parfait-modal" class="gi-close modal__close"><span class="accessibility">Close</span></a>
    </div>
 </div>
</div>






    
<?php get_footer(); ?>