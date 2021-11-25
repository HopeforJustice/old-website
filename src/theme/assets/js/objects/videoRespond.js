// Video Init is a utility function that allows you to only load video content above a certain breakpoint
//
// @videosrc: URL of the video to be used in the iframe src attribute
// @el: id of the iframe element
// @size: minimum breakpoint when the video should be loaded (see _breakpoints.scss for values)
//

var hfj = (function (my) {
    my.objects = my.objects || {};
    my.objects.videoRespond = {};

    _setSrc = function(videosrc, el, size) {
            if((_BREAKPOINTS.indexOf(breakpoint.value) >= _BREAKPOINTS.indexOf(size)) && (jQuery('#' + el).attr('src') == "")) {
                jQuery('#' + el).attr('src', videosrc);
            } 
    }
    my.objects.videoRespond.init = function(videosrc, el, size) {
        jQuery(document).ready(function() {
            _setSrc(videosrc, el, size);
        });
        jQuery(window).smartresize(function(){
            _setSrc(videosrc, el, size);
        });
    }

    return my;
})(hfj || {});