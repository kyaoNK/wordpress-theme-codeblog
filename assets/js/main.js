jQuery(function($){
    $('.menu').on('click', function(){
        $('.menu_line').toggleClass('active');
        $('.full-nav').fadeToggle();
    });
});

