
$(document).ready(function(){
    $(".spoilerButton").click(function (e) {
        e.preventDefault();
        var foo = $(this).attr('href');
        $('#'+foo).slideToggle(250);
    });
});

