/*!
 * Smartresize
 * http://www.paulirish.com/2009/throttled-smartresize-jquery-event-handler/
 *
 * Debouncing window resize triggers to prevent event handler overload
 */
!function($,n){var r=function(n,r,t){var e;return function i(){function i(){t||n.apply(u,a),e=null}var u=this,a=arguments;e?clearTimeout(e):t&&n.apply(u,a),e=setTimeout(i,r||100)}};jQuery.fn[n]=function(t){return t?this.bind("resize",r(t)):this.trigger(n)}}(jQuery,"smartresize");
