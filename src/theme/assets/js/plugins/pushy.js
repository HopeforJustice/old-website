/*! Pushy - v0.9.1 - 2013-9-16
* Pushy is a responsive off-canvas navigation menu using CSS transforms & transitions.
* https://github.com/christophery/pushy/
* by Christopher Yee */
jQuery(function(f){var e=f(".pushy"),h=f("body"),c=f("#content"),k=f(".pushy-container"),a=f(".site-overlay"),l="pushy-right pushy-open",g="pushy-active",q="container-push",n="push-push",d=f(".menu-btn"),j=200,i=e.width()+"px";function p(){h.toggleClass(g);e.toggleClass(l);c.toggleClass(q);k.toggleClass(n)}function m(){h.addClass(g);e.animate({right:"0px"},j);c.animate({right:i},j);k.animate({right:i},j)}function o(){h.removeClass(g);e.animate({right:"-"+i},j);c.animate({right:"0px"},j);k.animate({right:"0px"},j)}if(Modernizr.csstransforms3d){d.click(function(){p()});a.click(function(){p()})}else{e.css({right:"-"+i});c.css({"overflow-x":"hidden"});var b=true;d.click(function(){if(b){m();b=false}else{o();b=true}});a.click(function(){if(b){m();b=false}else{o();b=true}})}});
