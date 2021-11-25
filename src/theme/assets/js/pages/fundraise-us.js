Handlebars.registerHelper('thermometer_width', function() {
  var width = Handlebars.escapeExpression(this.total_raised)/Handlebars.escapeExpression(this.goal),
      percent = width * 100;

  return new Handlebars.SafeString(
    "style=\"width:" + percent + "%;\""
  );
});
Swag.registerHelpers(Handlebars);


var classyData ={
        loadTemplate : function(resJSON){
		    var source;
		    var template;
		 
		    jQuery.ajax({
		        url: theme_vars.template_directory_uri + '/assets/js/tmpl/fundraise-us.hbs',
	            cache: true,
	            success: function(data) {
	            	source    = data;
	                template  = Handlebars.compile(source);
	                output = template(resJSON);
	                jQuery('#fundraisers').html(output);
	            }
		    });
		},

        loadFundraisers : function(){
            jQuery.ajax({
                url:'http://www.stayclassy.org/api1/fundraisers?token=knaBrNbIXJrfIlyth2OF&cid=12400&near_goal=1&order=total_raised&limit=20',
                dataType: 'json',
                method:'get',
                success:this.loadTemplate,
                error: function() {
	                jQuery('#fundraisers').html('<p>Fundraisers list currently unavailable</p>');
                }
            })
        }
};
jQuery(function(){
    classyData.loadFundraisers();
    
});