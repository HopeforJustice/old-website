(function(){function r(e,n,t){function o(i,f){if(!n[i]){if(!e[i]){var c="function"==typeof require&&require;if(!f&&c)return c(i,!0);if(u)return u(i,!0);var a=new Error("Cannot find module '"+i+"'");throw a.code="MODULE_NOT_FOUND",a}var p=n[i]={exports:{}};e[i][0].call(p.exports,function(r){var n=e[i][1][r];return o(n||r)},p,p.exports,r,e,n,t)}return n[i].exports}for(var u="function"==typeof require&&require,i=0;i<t.length;i++)o(t[i]);return o}return r})()({1:[function(require,module,exports){
// Globals
_BREAKPOINTS = [  
    "mobile",
    "mobileLandscape",
    "tablet",
    "desktop",
    "desktopLarge"
];
/*
/*
 * keep height of parallax in sync with top content element
*/
function syncParallax() {
	if (jQuery(".parfait__parallax").length === 1){
		var rowTopHeight = jQuery(".parfait__row__top").outerHeight();
		jQuery(".parfait__parallax").height(rowTopHeight);
	}
}

/*
 * Skip link focus fix (included by _s)
*/
(function(){var b=navigator.userAgent.toLowerCase().indexOf("webkit")>-1,c=navigator.userAgent.toLowerCase().indexOf("opera")>-1,a=navigator.userAgent.toLowerCase().indexOf("msie")>-1;if((b||c||a)&&"undefined"!==typeof(document.getElementById)){var d=(window.addEventListener)?"addEventListener":"attachEvent";window[d]("hashchange",function(){var e=document.getElementById(location.hash.substring(1));if(e){if(!/^(?:a|select|input|button|textarea)$/i.test(e.tagName)){e.tabIndex=-1}e.focus()}},false)}})();

/*
 * Grab current breakpoint from :before pseudo-element on the body added by css
*/
var breakpoint = {};
breakpoint.refreshValue = function () {
  this.value = window.getComputedStyle(document.querySelector('body'), ':before').getPropertyValue('content').replace(/\"/g, '');
};

/* gravity forms rendered */

jQuery(document).on('gform_post_render', function(event, form_id, current_page){

    //modify field name on gravity forms if class exists
    jQuery(".address-search input").attr("name","search");

    //modify ID of firstname to stop conflict with postcode anywhere address regex
    jQuery("#input_70_54_3").attr("id","firstName");

    //remove text value on click 
    jQuery('input[name="search"]').focus(function() {
        if(this.value == 'Search address here') {
        this.value = ''; 
        }
        else if(this.value == 'Søk etter adresse') {
        this.value = ''; 
        } 
    });

    //add day of the month to field
    var d = new Date();
    var n = d.getDate()
    jQuery(".day-of-the-month input").val(n);
    

    //Change address text on gravity forms if in Norway. Done this way only
    //for address to allow Loqate to work on just one set of address fields
    var submit = jQuery('.gform_footer span').text();
    var donorfy = jQuery('.donorfy input').val();

    if(donorfy == 'NO') {
     jQuery('.gform_footer span').text('Send in');
     jQuery('.address_line_1 input').attr("placeholder", "Adresselinje 1");
     jQuery('.address_line_2 input').attr("placeholder", "Adresselinje 2");
     jQuery('.address_city input').attr("placeholder", "Sted");
     jQuery('.address_state input').hide();
     jQuery('.address_zip input').attr("placeholder", "Postnummer");
    }


    jQuery('.gform_previous_button').addClass('button--solid button--blue');
    jQuery('.gform_next_button').addClass('button--solid button--blue');
    jQuery('.gform_footer button').removeClass('button--gray');
    jQuery('.gform_footer button').addClass('button--solid button--blue');

 
    //global postcode anywhere with regex matching
    var e = {
        key: "DN97-JG93-ZJ46-EW48"
    },
    d = [{
        element: "search",
        field: "",
        mode: pca.fieldMode.SEARCH
    }, {
        element: "^input_[0-9]{1,}_[0-9]{1,}_1$",
        field: "Line1",
        mode: pca.fieldMode.POPULATE
    }, {
        element: "^input_[0-9]{1,}_[0-9]{1,}_2$",
        field: "Line2",
        mode: pca.fieldMode.POPULATE
    }, {
        element: "^input_[0-9]{1,}_[0-9]{1,}_3$",
        field: "City",
        mode: pca.fieldMode.POPULATE
    }, {
        element: "^input_[0-9]{1,}_[0-9]{1,}_4$",
        field: "Province",
        mode: pca.fieldMode.POPULATE
    }, {
        element: "^input_[0-9]{1,}_[0-9]{1,}_5$",
        field: "PostalCode",
        mode: pca.fieldMode.POPULATE
    }],
    o = new pca.Address(d, e);
    o.listen("populate", function() {
    document.getElementByClassName("address-search").value = ""
    }), o.load()
 
});


/* Page load scripts */
jQuery(document).ready(function($) {

    //if retrak modal exists show it
    $('#retrak-modal').modal('show');

    //if retrak donate modal exists show it
    $('#retrak-modal-donate').modal('show');

    //Drop down questions
    $('.dropdown').click(function() {
        $(this).find(".answer").slideDown();
        $(".dropdown").not(this).find(".answer").slideUp();
    });

    //preheader close
    $('.preheader__close').click(function() {
        $('.preheader').hide();
        $('.site-content').removeClass('site-content--pushed');
        syncParallax();
    });

    // copy amount value into Gravity Form
    $(".donate-uk__modal-trig").click(function(){
        $(".ginput_amount").val($("#Amount").val());
        $("#textAmount").html($("#Amount").val());
    });

    // copy amount value into Gravity Form
    $("#modalTrigger").click(function(){
        $(".ginput_amount").val($("#Amount").val());
        $("#textAmount").html($("#Amount").val());
    });

    // redirect to go cardless form with amount
    $("#goCardless").click(function(){
        window.location.href='https://hopeforjustice.org/go-cardless/' + '?Amount=' + $("#Amount").val();
    });

    /* Gravity Forms compare selected day of the month to
    current and output a new date */
    $('.selected-payment-date select').on('change', function() {
        var date = new Date();
        var currentDate = parseInt($(".day-of-the-month input").val());
        var selectedDate = parseInt($(".selected-payment-date select").val());
        var month = date.getMonth() + 1;
        var year = date.getFullYear();
        var nextYear = date.getFullYear() + 1;
        var nextMonth = date.getMonth() + 2;

        if (currentDate > selectedDate && nextMonth < 13) {
            $(".amended-date input").val(nextMonth + "/" + selectedDate + "/" + year);
        } else if (currentDate > selectedDate && nextMonth > 12) {
            $(".amended-date input").val("01" + "/" + selectedDate + "/" + nextYear);
        } else {
            $(".amended-date input").val(month + "/" + selectedDate + "/" + year);
        }
    });

    //fit homepage video
    $("#heroVid").fitVids();

    //news tickers
    $(function () {
        $("#Ticker").newsTicker();
    });

    $('#HCV-ticker').webTicker({
        height:'auto',
        startEmpty: false,
        duplicate:true
    });


    //video autoplay
    var url;
    $(".video-trig").on("click", function() {
        url =  $("#video")[0].src;
        $("#video")[0].src += "?autoplay=1";
    });

    //video close
    $(".video-modal__close").on("click", function(event) {
        $('#video').attr('src', url);
    });
    $(".video-modal__footer-close").on("click", function(event) {
        $('#video').attr('src', url);
    });

    // video overlay on click
    $("#play-button").on("click", function(e) {
        $('body, html').toggleClass("video-overlay--no-scroll");
        $('.video-overlay').toggleClass("video-overlay--hidden");
        window.location.hash = "modal";
    }); 

    // close video overlay on click
    $("#exit-video").on("click", function(event) {
            $('.video-overlay').toggleClass("video-overlay--hidden");
            $('body, html').toggleClass("video-overlay--no-scroll");
            $(".video-overlay iframe").attr("src", $(".video-overlay iframe").attr("src"));
    });

    //close video model on back button 
    $(window).on('hashchange', function (event) {
        if(window.location.hash != "#modal") {
            $('#video-overlay').addClass("video-overlay--hidden");
            $('body, html').removeClass("video-overlay--no-scroll");
            $(".video-overlay iframe").attr("src", $(".video-overlay iframe").attr("src"));
        }
    });

     $(".modal").on("shown.bs.modal", function()  { // any time a modal is shown
        var urlReplace = "#" + $(this).attr('id'); // make the hash the id of the modal shown
        history.pushState(null, null, urlReplace); // push state that hash into the url
    });

    // If a pushstate has previously happened and the back button is clicked, hide any modals.
     $(window).on('popstate', function() { 
        $(".modal").modal('hide');
     });


	// dropdown menus on main navigation

	var $dropdowns = $('li.menu-item-has-children'); // Specifying the element is faster for older browsers

    /**
     * Mouse events
     *
     * @description Mimic hoverIntent plugin by waiting for the mouse to 'settle' within the target before triggering
     */
    $dropdowns
        .on('mouseover', function() // Mouseenter (used with .hover()) does not trigger when user enters from outside document window
        {
            var $this = $(this);
            if ($this.prop('hoverTimeout')) {
                $this.prop('hoverTimeout', clearTimeout($this.prop('hoverTimeout')));
            }
            $this.prop('hoverIntent', setTimeout(function() {
                $this.addClass('menu-item-expanded');
            }, 250));
        })
        .on('mouseleave', function()
        {
            var $this = $(this);
            if ($this.prop('hoverIntent')) {
                $this.prop('hoverIntent', clearTimeout($this.prop('hoverIntent')));
            }
            $this.prop('hoverTimeout', setTimeout(function() {
                $this.removeClass('menu-item-expanded');
            }, 250));
        });

    /**
     * Touch events
     *
     * @description Support click to open if we're dealing with a touchscreen
     */
    if ('ontouchstart' in document.documentElement) {
        $dropdowns.each(function() {
            var $this = $(this);
            this.addEventListener('touchstart', function(e) {
                if (e.touches.length === 1) {
                    // Prevent touch events within dropdown bubbling down to document
                    e.stopPropagation();
                    // Toggle hover
                    if (!$this.hasClass('menu-item-expanded')) {
                        // Prevent link on first touch
                        if (e.target === this || e.target.parentNode === this) {
                            e.preventDefault();
                        }
                        // Hide other open dropdowns
                        $dropdowns.removeClass('menu-item-expanded');
                        $this.addClass('menu-item-expanded');
                        // Hide dropdown on touch outside
                        document.addEventListener('touchstart', closeDropdown = function(e) {
                            e.stopPropagation();
                            $this.removeClass('menu-item-expanded');
                            document.removeEventListener('touchstart', closeDropdown);
                        });
                    }
                }
            }, false);
        });
    }

    // off canvas navigation
	$("#mobile-navigation .menu-item-link").on("click", function(e) {
		$(document).trigger("pushyClick");
	});	



    // sub-menu expander

    $(".sub-menu-toggle").click(function(e) {
      $(this).siblings('.sub-menu').toggle();
      $(this).parent().toggleClass("open");
      e.preventDefault();    	
    });

	// responsive resizing videos

    $(".page").fitVids();
    $(".single").fitVids();

    // flexslider init
    $(window).load(function() {
    	$('.flexslider').flexslider({
            animation: "slide",
            slideshow: true,
    		animationLoop: true,
            directionNav: false,
            controlNav: false,
            video: false,
            pauseOnHover: false,
            slideshowSpeed: 2000,
            animationSpeed: 600, 
    	});
    });        

    // headroom init

    $(".site-header").headroom({
        tolerance: {
          down : 10,
          up : 20
        },
        offset : 205,
        classes: {
			initial: "headroom",
			pinned: "headroom--pinned",
			unpinned: "headroom--unpinned",
			top : "headroom--top",
			notTop : "headroom--not-top"          
        }    	
    });

    if(window.location.hash) {
      $(".site-header").addClass("headroom--unpinned");
    }

    // make sure that parllax sections stay the same height as the foreground content
    syncParallax();

    // grab current breakpoint from pseudo on body
    breakpoint.refreshValue();    

    // Its a hack - oh my, a horrible hack- but the modal content is stymied by other stacking contexts on iPhone. This hack moves it outside that stack to fix modals for iphone.
    $('.modal').appendTo('body');



	// tab controls
	var tabs = $('ul.tabs');
	tabs.each(function(i) {
		var tab = $(this).find('> li > a');
		tab.click(function(e) {
			var contentLocation = $(this).attr('href');
			if(contentLocation.charAt(0)=="#") {
				e.preventDefault();
				tab.removeClass('tab__active');
				$(this).addClass('tab__active');
				$(contentLocation).removeClass('tab-content__inactive').addClass('tab-content__active').siblings().addClass('tab-content__inactive').removeClass('tab-content__active');
			}
		});
	});

	if(!Modernizr.touch){ 
    	// stellar init (but only on non-touchscreen devices)
	    $.stellar({
	        horizontalScrolling: false,
	        positionProperty: 'position',
	        hideDistantElements: true,
	        responsive: true
	    });
	}


	/* Window re-size scripts */
	$(window).smartresize(function(){
		syncParallax();
	});

    // refreshing the breakpoint has to be outide the smartresize because responsive are too late in the race otherwise.
    $(window).resize(function () {
      breakpoint.refreshValue();
    }).resize();    
    
    //UTM tracking
    var UtmCookie;UtmCookie=function(){function UtmCookie(options){null==options&&(options={}),this._domain=options.domain,this._sessionLength=options.sessionLength||1,this._cookieExpiryDays=options.cookieExpiryDays||365,this._additionalParams=options.additionalParams||[],this._utmParams=["utm_source","utm_medium","utm_campaign","utm_term","utm_content"],this.writeInitialReferrer(),this.writeLastReferrer(),this.writeInitialLandingPageUrl(),this.setCurrentSession(),this.additionalParamsPresentInUrl()&&this.writeAdditionalParams(),this.utmPresentInUrl()&&this.writeUtmCookieFromParams()}return UtmCookie.prototype.createCookie=function(name,value,days,path,domain,secure){var cookieDomain,cookieExpire,cookiePath,cookieSecure,date,expireDate;expireDate=null,days&&(date=new Date,date.setTime(date.getTime()+24*days*60*60*1e3),expireDate=date),cookieExpire=null!=expireDate?"; expires="+expireDate.toGMTString():"",cookiePath=null!=path?"; path="+path:"; path=/",cookieDomain=null!=domain?"; domain="+domain:"",cookieSecure=null!=secure?"; secure":"",document.cookie=this._cookieNamePrefix+name+"="+escape(value)+cookieExpire+cookiePath+cookieDomain+cookieSecure},UtmCookie.prototype.readCookie=function(name){var c,ca,i,nameEQ;for(nameEQ=this._cookieNamePrefix+name+"=",ca=document.cookie.split(";"),i=0;i<ca.length;){for(c=ca[i];" "===c.charAt(0);)c=c.substring(1,c.length);if(0===c.indexOf(nameEQ))return c.substring(nameEQ.length,c.length);i++}return null},UtmCookie.prototype.eraseCookie=function(name){this.createCookie(name,"",-1,null,this._domain)},UtmCookie.prototype.getParameterByName=function(name){var regex,regexS,results;return name=name.replace(/[\[]/,"\\[").replace(/[\]]/,"\\]"),regexS="[\\?&]"+name+"=([^&#]*)",regex=new RegExp(regexS),results=regex.exec(window.location.search),results?decodeURIComponent(results[1].replace(/\+/g," ")):""},UtmCookie.prototype.additionalParamsPresentInUrl=function(){var j,len,param,ref;for(ref=this._additionalParams,j=0,len=ref.length;len>j;j++)if(param=ref[j],this.getParameterByName(param))return!0;return!1},UtmCookie.prototype.utmPresentInUrl=function(){var j,len,param,ref;for(ref=this._utmParams,j=0,len=ref.length;len>j;j++)if(param=ref[j],this.getParameterByName(param))return!0;return!1},UtmCookie.prototype.writeCookie=function(name,value){this.createCookie(name,value,this._cookieExpiryDays,null,this._domain)},UtmCookie.prototype.writeAdditionalParams=function(){var j,len,param,ref,value;for(ref=this._additionalParams,j=0,len=ref.length;len>j;j++)param=ref[j],value=this.getParameterByName(param),this.writeCookie(param,value)},UtmCookie.prototype.writeUtmCookieFromParams=function(){var j,len,param,ref,value;for(ref=this._utmParams,j=0,len=ref.length;len>j;j++)param=ref[j],value=this.getParameterByName(param),this.writeCookie(param,value)},UtmCookie.prototype.writeCookieOnce=function(name,value){var existingValue;existingValue=this.readCookie(name),existingValue||this.writeCookie(name,value)},UtmCookie.prototype._sameDomainReferrer=function(referrer){var hostname;return hostname=document.location.hostname,referrer.indexOf(this._domain)>-1||referrer.indexOf(hostname)>-1},UtmCookie.prototype._isInvalidReferrer=function(referrer){return""===referrer||void 0===referrer},UtmCookie.prototype.writeInitialReferrer=function(){var value;value=document.referrer,this._isInvalidReferrer(value)&&(value="direct"),this.writeCookieOnce("referrer",value)},UtmCookie.prototype.writeLastReferrer=function(){var value;value=document.referrer,this._sameDomainReferrer(value)||(this._isInvalidReferrer(value)&&(value="direct"),this.writeCookie("last_referrer",value))},UtmCookie.prototype.writeInitialLandingPageUrl=function(){var value;value=this.cleanUrl(),value&&this.writeCookieOnce("initial_landing_page",value)},UtmCookie.prototype.initialReferrer=function(){return this.readCookie("referrer")},UtmCookie.prototype.lastReferrer=function(){return this.readCookie("last_referrer")},UtmCookie.prototype.initialLandingPageUrl=function(){return this.readCookie("initial_landing_page")},UtmCookie.prototype.incrementVisitCount=function(){var cookieName,existingValue,newValue;cookieName="visits",existingValue=parseInt(this.readCookie(cookieName),10),newValue=1,newValue=isNaN(existingValue)?1:existingValue+1,this.writeCookie(cookieName,newValue)},UtmCookie.prototype.visits=function(){return this.readCookie("visits")},UtmCookie.prototype.setCurrentSession=function(){var cookieName,existingValue;cookieName="current_session",existingValue=this.readCookie(cookieName),existingValue||(this.createCookie(cookieName,"true",this._sessionLength/24,null,this._domain),this.incrementVisitCount())},UtmCookie.prototype.cleanUrl=function(){var cleanSearch;return cleanSearch=window.location.search.replace(/utm_[^&]+&?/g,"").replace(/&$/,"").replace(/^\?$/,""),window.location.origin+window.location.pathname+cleanSearch+window.location.hash},UtmCookie}();var UtmForm,_uf;UtmForm=function(){function UtmForm(options){null==options&&(options={}),this._utmParamsMap={},this._utmParamsMap.utm_source=options.utm_source_field||"USOURCE",this._utmParamsMap.utm_medium=options.utm_medium_field||"UMEDIUM",this._utmParamsMap.utm_campaign=options.utm_campaign_field||"UCAMPAIGN",this._utmParamsMap.utm_content=options.utm_content_field||"UCONTENT",this._utmParamsMap.utm_term=options.utm_term_field||"UTERM",this._additionalParamsMap=options.additional_params_map||{},this._initialReferrerField=options.initial_referrer_field||"IREFERRER",this._lastReferrerField=options.last_referrer_field||"LREFERRER",this._initialLandingPageField=options.initial_landing_page_field||"ILANDPAGE",this._visitsField=options.visits_field||"VISITS",this._addToForm=options.add_to_form||"all",this._formQuerySelector=options.form_query_selector||"form",this.utmCookie=new UtmCookie({domain:options.domain,sessionLength:options.sessionLength,cookieExpiryDays:options.cookieExpiryDays,additionalParams:Object.getOwnPropertyNames(this._additionalParamsMap)}),"none"!==this._addToForm&&this.addAllFields()}return UtmForm.prototype.addAllFields=function(){var fieldName,param,ref,ref1;ref=this._utmParamsMap;for(param in ref)fieldName=ref[param],this.addFormElem(fieldName,this.utmCookie.readCookie(param));ref1=this._additionalParamsMap;for(param in ref1)fieldName=ref1[param],this.addFormElem(fieldName,this.utmCookie.readCookie(param));this.addFormElem(this._initialReferrerField,this.utmCookie.initialReferrer()),this.addFormElem(this._lastReferrerField,this.utmCookie.lastReferrer()),this.addFormElem(this._initialLandingPageField,this.utmCookie.initialLandingPageUrl()),this.addFormElem(this._visitsField,this.utmCookie.visits())},UtmForm.prototype.addFormElem=function(fieldName,fieldValue){var allForms,firstForm,form,i,len;if(fieldValue&&(allForms=document.querySelectorAll(this._formQuerySelector),allForms.length>0))if("first"===this._addToForm)firstForm=allForms[0],this.insertAfter(this.getFieldEl(fieldName,fieldValue),firstForm.lastChild);else for(i=0,len=allForms.length;len>i;i++)form=allForms[i],this.insertAfter(this.getFieldEl(fieldName,fieldValue),form.lastChild)},UtmForm.prototype.getFieldEl=function(fieldName,fieldValue){var fieldEl;return fieldEl=document.createElement("input"),fieldEl.type="hidden",fieldEl.name=fieldName,fieldEl.value=fieldValue,fieldEl},UtmForm.prototype.insertAfter=function(newNode,referenceNode){return referenceNode.parentNode.insertBefore(newNode,referenceNode.nextSibling)},UtmForm}(),_uf=window._uf||{},window.UtmForm=new UtmForm(_uf);

}); /* end of as page load scripts */

/* Window load scripts */
(function($) {

	jQuery(window).load(function() {

	}); /* end of as page load scripts */

})(jQuery);


},{}]},{},[1]);
