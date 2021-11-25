
jQuery(document).ready(function($) {

    $("#twentyone-other").click(function(e) {
      // show the tab options
      $(".twentyone").toggleClass('twentyone--tabs');

      $("#twentyone-other").addClass('twentyone__other--hidden');

      $(".twentyone__content .donation-form__button").removeClass('button--hollow').addClass('button--solid');
      
      $(".donation-form__button").text('Donate');

      // tab controls

        $('.twentyone__tab').click(function(e) {
          var contentLocation = $(this).attr('href');
          if(contentLocation.charAt(0)=="#") {
            e.preventDefault();
            $('.twentyone__tab').removeClass('twentyone__tab--active button--solid');
            $(this).addClass('twentyone__tab--active button--solid');
            $(contentLocation).addClass('twentyone__content--active').siblings().removeClass('twentyone__content--active');
          }
        });
      
      // make the appropripate form visible

      //

      e.preventDefault();

    });
    
});