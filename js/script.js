$(function(){
    $(window)
    .on('swipeleft', randomQ)
    .on('swiperight', function(){window.history.back();})
    .on('resize', center)
    .on('popstate', function(e){quoteChange(e.originalEvent.state);})
    .on('keyup', function(e){
        if(e.keyCode == 32){
            e.preventDefault();
            playClip();     
        }else if (e.keyCode == 39) {
            randomQ();
        }else if (e.keyCode == 37) {
            window.history.back();
        }
    });
    $('.random').on('click', randomQ);
    $('.pp').on('click', playClip);
    sunnyday();
});
var currQ, isPlaying;
quoteChange = function(d){
    if(!d.by) { d.by = "Charlie Kelly"; }
    $('.snap').fadeOut('fast',function(){
        $(this).css('background-image',"url("+d.slug+'.jpg)').fadeIn('fast');
    });
    var qhtml = '<blockquote class="quo"><p>'+d.quote+'</p><div>&mdash; '+d.by+', '+d.season+'</div></blockquote>';
    $('.clip').html('<source src="/'+d.slug+'.ogg" type="audio/ogg"><source src="/'+d.slug+'.mp3" type="audio/mpeg">');
    $('.quoteBox').fadeOut('fast',function(){
        $(this).html(qhtml).fadeIn('fast');
        center();
    });
    $('title').html(d.title);
    $('.clip')[0].load();
    $('.clip')[0].play();
}
randomQ = function(){   
    var prevQ = currQ;
    do{ currQ = randomGen(1, quotes.length) - 1; }while(currQ == prevQ);
    quoteChange(quotes[currQ]);
    history.pushState(quotes[currQ],"",quotes[currQ].slug);
}
randomGen = function(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}
playState = function(s){
    if(s == 1){
        isPlaying = true;
        $('.pp').removeClass('play').addClass('pause');
        $('.ring').fadeIn('fast');
    }else if(s == 2){
        isPlaying = false;
        $('.pp').removeClass('pause').addClass('play');
        $('.ring').fadeOut('fast');

    }else if(s == 3){
        $('.clip')[0].load();
        $('.ring').fadeOut('fast');
    }
}
playClip = function(){
    if(isPlaying){
        $('.clip')[0].pause();
    }else{
        $('.clip')[0].play();
    }
}
center = function(){
    var cHeight = $('.quoteBox').height();
    var wHeight = $(window).height();
    if(cHeight >  wHeight){
        $('.quoteBox').removeClass('center');
    }else{
        $('.quoteBox').addClass('center');
    }
}
sunnyday = function(){
    if(window.location.pathname != '/' && window.location.pathname != '/index.php'){
        var slug = window.location.pathname.slice(1)
        var checkSlug = $.grep(quotes, function(e){ return e.slug == slug; });
        if(checkSlug.length){
            quoteChange(checkSlug[0]);
            history.replaceState(checkSlug[0],"",slug);
        }else{
            $('.clip').html('<source src="/so-stupid.ogg" type="audio/ogg"><source src="/so-stupid.mp3" type="audio/mpeg">');
            $('.quoteBox').html('<blockquote><p>'+slug+' not found...</p></blockquote>');
            $('title').html(slug+" not found");
            $('.clip')[0].load();
            $('.clip')[0].play();
        }
    }else{
        randomQ();
    }
}