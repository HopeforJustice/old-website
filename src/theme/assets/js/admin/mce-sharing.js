(function() {
   tinymce.create('tinymce.plugins.sharing', {
      init : function(ed, url) {
         ed.addButton('sharing', {
            title : 'Social sharing',
            image : url+'../../../../inc/admin/sharing.png',
            onclick : function() {
               var text = prompt("Sharing text", "Currently reading about how @hopeforjustice are working to beat Modern Slavery");
               if (text != ''){
                  ed.execCommand('mceInsertContent', false, '[sharing text="'+text+'"]');
               }
               else{
                  ed.execCommand('mceInsertContent', false, '[sharing]');
               }
            }
         });
      },
      createControl : function(n, cm) {
         return null;
      },
      getInfo : function() {
         return {
            longname : "Sharing shortcde",
            author : 'Andrew Parker',
            authorurl : 'http://parkersweb.net',
            infourl : 'http://this.isfluent.com',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('sharing', tinymce.plugins.sharing);
})();