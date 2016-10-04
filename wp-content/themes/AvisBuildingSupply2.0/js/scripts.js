//On Page Ready Scripts To Execute

$(document).ready(function() {
    scrolling();
    goTo();
    $('#map-btn').click(function(e){
        e.preventDefault();
        if($(this).hasClass('active')){
            $(this).removeClass('active');
            $('#map-iframe').stop().slideUp();
        } else {
            $(this).addClass('active');
            $('#map-iframe').stop().slideDown();
        }
    });
    $('#toggle-overlay').click(function(e){
        e.preventDefault();
        if($(this).text() == 'Remove Overlay'){
            $(this).text('Add Overlay');
            $('#map-overlay').fadeOut();
        } else {
            $(this).text('Remove Overlay');
            $('#map-overlay').fadeIn();
        }
    })
});

function scrolling(){
    $(window).scroll(function(){
        var top = $(window).scrollTop();
        if(top > 10){
            $('.logo').addClass('scroll');
        }
        if(top < 50) {
            $('.logo').removeClass('scroll');
        }
    });
}

function goTo(){
    $('a.goto').click(function(){
       if($(this).attr('href').indexOf('#') >= 0){
            var id = $(this).attr('href');
            $('html, body').animate({
              scrollTop: $(id).offset().top
            }, 1000);
            return false;
       } 
    });
}


function cookieMonster(){
    var skip = Cookies.get('skip'),
        name = Cookies.get('name'),
        occupation = Cookies.get('occupation');
    if(skip != 'yes'){
        $('.step-one').fadeIn();
        $('#hp-continue').click(function(e){
            e.preventDefault();
            if($('#user-name').val() == ''){
                name = 'Guest';
                $('.step-two .user-name, .step-three .user-name').html(name);
            } else {
                name = $('#user-name').val();
                $('.step-two .user-name, .step-three .user-name').html(name);
            }
            $('.step-one').css('position', 'absolute').fadeOut();
            $('.step-two').fadeIn();
        });
        $('.occupation').click(function(e){
            e.preventDefault();
            $('.step-three .occupation').html($(this).data('occupation'));
            $('.step-two').css('position', 'absolute').fadeOut();
            $('.step-three').fadeIn();
        });
        $('.confirm-cookie').click(function(e){
            e.preventDefault();
            if($(this).data('confirm') == 'yes') {
                name = $('#user-name').val(),
                occupation = $('.step-three .occupation').text();
                Cookies.set('skip', 'yes', { expires: 365 });
                Cookies.set('name', name, { expires: 365 });
                Cookies.set('occupation', occupation, { expires: 365 });
            } else {
                console.log('Move on');
            }
        });
    } else {
        $('.head-welcome').fadeIn();
        $('#head-username').html(Cookies.get('name'));
    }
}