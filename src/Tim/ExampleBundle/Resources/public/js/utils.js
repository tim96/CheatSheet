/**
 * Created by tim on 7/4/2016.
 */

// 1. Add function to onload event
function onloadEvent(functionForOnload) {
    if(window.attachEvent) {
        window.attachEvent('onload', functionForOnload);
    } else {
        if(window.onload) {
            var curronload = window.onload;
            window.onload = function(evt) {
                curronload(evt);
                functionForOnload(evt);
            };
        } else {
            window.onload = functionForOnload;
        }
    }
}