
jQuery(document).ready(function($) {

    //expander
    $(".expander__accordian-header").on("click", function(e) {       
        if ($(this).siblings("p").hasClass("expander__accordian-text--active")) {
            $(this).siblings("p").removeClass("expander__accordian-text--active");
            $(this).find(".expander__triangle").removeClass("expander__triangle--active");
        }else {
            $(".expander__accordian-text--active").toggleClass("expander__accordian-text--active");
            $(this).siblings("p").toggleClass("expander__accordian-text--active");
            $(".expander__triangle--active").toggleClass("expander__triangle--active");
            $(this).find(".expander__triangle").toggleClass("expander__triangle--active");
        }
    });

    //remove active class for mobile
    $(window).resize(function(){
        if ($(window).width() <= 600){  
            $(".expander__accordian-text--active").removeClass("expander__accordian-text--active");
            $(".expander__triangle--active").removeClass("expander__triangle--active");
        }   
    });

    //use value of options  
    $('#giving-widget-30').on("click", function(event) {
        $('.giving-widget__options').siblings(".giving-widget__custom-amount").find("input").val('30.00');
        $('.giving-widget__options').siblings(".giving-widget__custom-amount").find("input").text('30.00');
        $(this).addClass('giving-widget__option--active');
        $(this).siblings('.giving-widget__option--active').removeClass('giving-widget__option--active');
    });

    $('#giving-widget-30-us').on("click", function(event) {
        $('.giving-widget__options').siblings(".giving-widget__custom-amount").find("input").val('30');
        $('.giving-widget__options').siblings(".giving-widget__custom-amount").find("input").text('30');
        $(this).addClass('giving-widget__option--active');
        $(this).siblings('.giving-widget__option--active').removeClass('giving-widget__option--active');
    });

    //use value of options  
    $('#giving-widget-50').on("click", function(event) {
        $('.giving-widget__options').siblings(".giving-widget__custom-amount").find("input").val('50.00');
        $('.giving-widget__options').siblings(".giving-widget__custom-amount").find("input").text('50.00');
        $(this).addClass('giving-widget__option--active');
        $(this).siblings('.giving-widget__option--active').removeClass('giving-widget__option--active');
    });

    //use value of options  
    $('#giving-widget-50-us').on("click", function(event) {
        $('.giving-widget__options').siblings(".giving-widget__custom-amount").find("input").val('50');
        $('.giving-widget__options').siblings(".giving-widget__custom-amount").find("input").text('50');
        $(this).addClass('giving-widget__option--active');
        $(this).siblings('.giving-widget__option--active').removeClass('giving-widget__option--active');
    });

    //use value of options
    $('#giving-widget-18-us').on("click", function(event) {
        $('.giving-widget__options').siblings(".giving-widget__custom-amount").find("input").val('18');
        $('.giving-widget__options').siblings(".giving-widget__custom-amount").find("input").text('18');
        $(this).addClass('giving-widget__option--active');
        $(this).siblings('.giving-widget__option--active').removeClass('giving-widget__option--active');
    });

    //use value of options
    $('#giving-widget-15').on("click", function(event) {
        $('.giving-widget__options').siblings(".giving-widget__custom-amount").find("input").val('15.00');
        $('.giving-widget__options').siblings(".giving-widget__custom-amount").find("input").text('15.00');
        $(this).addClass('giving-widget__option--active');
        $(this).siblings('.giving-widget__option--active').removeClass('giving-widget__option--active');
    });

    //Footer button //Scroll to top
    $('#footer-button-guardian').on("click", function(event) {
      $("html, body").animate({ scrollTop: 0 }, "slow");
      return false;
    });

    $('#guardian-iam').on("click", function(event) {
      $("#video").attr('src', 'https://www.youtube.com/embed/vQQS4riPc5I');
      $("#video")[0].src += "?autoplay=1";
      ev.preventDefault();
    });
    
    $('#guardian-thecla').on("click", function(event) {
      $("#video").attr('src', 'https://www.youtube.com/embed/8YWYlhmg5_M');
      $("#video")[0].src += "?autoplay=1";
    });

    //STOP VIDEO WHEN CLOSING VIDEO MODAL
    $(".video-modal__close, .video-modal__footer-close").on("click", function(event) {
        $(".video-modal iframe").attr("src", "");
    });



});