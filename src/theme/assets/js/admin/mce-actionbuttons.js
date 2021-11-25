(function() {
   tinymce.create('tinymce.plugins.actionbuttons', {
      init : function(ed, url) {
         ed.addButton('actionbuttons', {
            title : 'Action buttons',
            image : url+'../../../../inc/admin/actionbuttons.png',
            onclick : function() {
                  var width = jQuery(window).width(), H = jQuery(window).height(),  W = ( 720 < width ) ? 720 : width;
                        W = W - 80;
                        H = H - 124;               
                  jQuery("#hfj_shortcode_form_wrapper").remove();
         
                  jQuery.get(url + "../../../../inc/admin/shortcode_actionbutton.php", function(data){
                     var form = jQuery(data);
                     form.appendTo('body').hide();
                     tb_show( 'Action Buttons shortcode', '#TB_inline?height=' + H + '&width=' + W + '&inlineId=hfj_shortcode_form_wrapper' );
                     jQuery('#TB_window #hfj_insert_shortcode_button').click(function(){
                        var btn_align = jQuery('#TB_window #button_alignment').val();
                        var btn_1_lbl = jQuery('#TB_window #button_1_label').val();
                        var btn_1_style = jQuery('#TB_window #button_1_style option:selected').val();
                        var btn_1_color = jQuery('#TB_window #button_1_color option:selected').val();
                        var btn_1_size = jQuery('#TB_window #button_1_size option:selected').val();
                        var btn_1_url = jQuery('#TB_window #button_1_url').val();
                        var btn_1_target = jQuery('#TB_window #button_1_target option:selected').val();
                        var btn_2_lbl = jQuery('#TB_window #button_2_label').val();
                        var btn_2_style = jQuery('#TB_window #button_2_style option:selected').val();
                        var btn_2_color = jQuery('#TB_window #button_2_color option:selected').val();
                        var btn_2_size = jQuery('#TB_window #button_2_size option:selected').val();
                        var btn_2_url = jQuery('#TB_window #button_2_url').val();
                        var btn_2_target = jQuery('#TB_window #button_2_target option:selected').val();
                        if ((btn_1_lbl != null) || (btn_2_lbl != null)) {
                           var shortcode = "[action_buttons alignment='" + btn_align + "']";
                        }
                        if (btn_1_lbl != '') {
                           shortcode += "[button label='" + btn_1_lbl +"' url='" + btn_1_url + "'  target='" + btn_1_target + "' style='" + btn_1_style + "' size='" + btn_1_size + "' color='" + btn_1_color + "']";  
                        }
                        if (btn_2_lbl != '') {
                           shortcode += "[button label='" + btn_2_lbl +"' url='" + btn_2_url +"'  target='" + btn_2_target + "' style='" + btn_2_style + "' size='" + btn_2_size + "' color='" + btn_2_color + "']";   
                        }
                        if ((btn_1_lbl != null) || (btn_2_lbl != null)) {
                           shortcode += "[/action_buttons]"
                        }
                        
                        ed.execCommand('mceInsertContent', false, shortcode);                                 
                        tb_remove();
                        return false;
                     });
            
                  });

               }
            })

      },
      createControl : function(n, cm) {
         return null;
      },
      getInfo : function() {
         return {
            longname : "Buttons shortcde",
            author : 'Andrew Parker',
            authorurl : 'http://parkersweb.net',
            infourl : 'http://this.isfluent.com',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('actionbuttons', tinymce.plugins.actionbuttons);
})();