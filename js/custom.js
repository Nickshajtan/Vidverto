jQuery(document).ready(function($) {
    width = $(window).width();
    height = $(window).height();
    //Links
    $(document).on('click', 'article', function(){
        var href = $(this).attr('data-href');
        window.location.href = href;
    });
    //Menu
    $('.burger').on('click',function(){
       $(this).toggleClass('open');
       $('.mobile-menu').toggleClass('d-none');
    });
    $(document).mouseup(function (e){ 
                        var div = $('.mobile');
                        if (!div.is(e.target)&& div.has(e.target).length === 0) {
                            $('.burger').removeClass('open');
                            $('.mobile-menu').addClass('d-none');
                        }
    });
    //Search
    $('.search_icon').on('click',function(){
        if( $(this).hasClass('s_open') && !($('.search-form').hasClass('d-none')) ){
            $('.search-form').submit();
        }
        else{
            $('.search-form').removeClass('d-none');
            $('.search-form').animate({opacity: 1,}, 700);
            $(this).addClass('s_open');
        }
    });
     $(document).mouseup(function (e){ 
                        var div = $('.search_form');
                        if (!div.is(e.target)&& div.has(e.target).length === 0) {
                            $('.search-form').animate({opacity: 0,}, 700);
                            $('.search-form').addClass('d-none');
                            $('.search_icon').removeClass('s_open');
                        }
    });
    //Switch
    var dat = [];
        $(document).find('.post').each(function(Array, index){
                var data = $(this).attr('class');
                dat.push(data);
                return dat;
        });
    $(document).on('click','.switch', function(e){
        var name = $(document).find('a[data-class=post], article[data-class=post]');
        $('.switch').removeClass('active');
        $(this).addClass('active');
        if( $(this).hasClass('right') ){
            name.removeClass();
            name.addClass('post post-line col-12');
            name.find('.content-wrapper.white__bottom').addClass('changed').removeClass('white__bottom');
            name.find('.content-wrapper.changed .white__block.d-flex').addClass('changed block').removeClass('white__block d-flex flex-column justify-content-between align-items-center');
            name.find('.content-wrapper.changed .content').addClass('changed').removeClass('d-flex flex-column justify-content-between align-items-center');
            name.find('.block .title').addClass('changed').removeClass('text-center');
        }
        if( $(this).hasClass('left') ){
            name.removeClass();
            name.find('.block .title.changed').addClass('text-center');
            name.find('.content-wrapper.changed').addClass('white__bottom');
            name.find('.content-wrapper.changed .content.changed').addClass('d-flex flex-column justify-content-between align-items-center');
            name.find('.block.changed').addClass('white__block');
            $.each(dat, function( key, value ){
                name.eq(key).addClass(value);
                console.log(key + ':' + value);
                return ;
            });
      }
    });
    var name = $(document).find('a[data-class=post] .content-wrapper, article[data-class=post] .content-wrapper');
    if( name.hasClass('post-line') ){
        $(document).find(name).css({'background': 'none!important'});
    }    
});