Swag.registerHelpers(Handlebars);
var senatorData ={
        handlerData : function(resJSON){
            var source;
            var template;
            jQuery.ajax({
                url: theme_vars.template_directory_uri + '/assets/js/tmpl/emsi.hbs',
                cache: true,
                success: function(data) {
                    source    = data;
                    template  = Handlebars.compile(source);
                    output = template(resJSON);
                    jQuery('#senatordata').html(output);
                }
            });
        },
        lookup : function(zip){
            jQuery.ajax({
                url:'https://congress.api.sunlightfoundation.com/legislators/locate?zip=' + zip + '&apikey=d8576385dbec428cb18b388e4fbe78d6',
                dataType: 'json',
                method:'get',
                success:this.handlerData,
                error: function() {
                    $('#senatordata').html('<p>Senator information is current unavailable</p>');
                }
            })
        }
};
jQuery(function(){
    jQuery('#zipsubmit').on('click', function(e){
        e.preventDefault();
        jQuery('.senator-search').removeClass('gfield_error');
        if( !jQuery('#zip').val() ) {
          jQuery('.senator-search').addClass('gfield_error');
        } else {
            var zipdata = jQuery('#zip').val();
            senatorData.lookup(zipdata);
            jQuery('.senator-search').addClass('senator-search__complete');
            jQuery('.sample-letter').addClass('sample-letter__visible');
        }
    });
});