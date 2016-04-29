
$(document).ready(function(){
    $(".spoilerButton").click(function (e) {
        e.preventDefault();

        var elements = $(this).find('i');
        for(var i = 0; i < elements.length; i++) {
            var element = elements[i];
            // if (hasClass(element, 'fa-arrow-left')) {
            //     removeClass(element, 'fa-arrow-left');
            //     addClass(element, 'fa-arrow-down');
            // } else {
            //     removeClass(element, 'fa-arrow-down');
            //     addClass(element, 'fa-arrow-left');
            // }
            // console.log('Element', elements[i]);
            if (hasClass(element, 'fa-arrow-left')) {
                element.className = 'fa fa-arrow-down';
            } else {
                element.className = 'fa fa-arrow-left';
            }
        }

        var foo = $(this).attr('href');
        $('#'+foo).slideToggle(150);
    });
});

function hasClass(element, cls) {
    return (' ' + element.className + ' ').indexOf(' ' + cls + ' ') > -1;
}
function addClass(ele, cls) {
    if (!hasClass(ele, cls)) ele.className += " " + cls;
}
function removeClass(ele, cls) {
    if (hasClass(ele, cls)) {
        var reg = new RegExp('(\\s|^)' + cls + '(\\s|$)');
        ele.className = ele.className.replace(reg, ' ');
    }
}
