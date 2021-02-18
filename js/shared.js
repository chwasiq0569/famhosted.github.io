//Click item and disappear hamburger

$('.navbar-nav>li>a').on('click', function(){
    $('.navbar-collapse').collapse('hide');
});

$('.navbar-nav>li>button').on('click', function(){
    $('.navbar-collapse').collapse('hide');
});

//Click outside of hamburger background 

$(document).ready(function(){
    $('body').click(function(){
        $('.navbar-collapse').collapse('hide');
    });
});


