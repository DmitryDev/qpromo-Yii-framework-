$(function () {
    $('.nav-tabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });
});
$(document).ready(function() {
    var windowHeight = $(window).height();

    var nav = $('#nav');
    $('#home_events .event:last').addClass('last');

    //nav.css({display: 'none', height: windowHeight+'px', left:-221});
    nav.css({display: 'none', left:-221});
    nav.find('ul:first').addClass('main_ul');
    nav.find('li').has('ul').addClass('wsub');

    var user_nav = $('#user_nav').html();
    nav.append('<ul id="user_nav">'+ user_nav +'</ul>');
    
    $("#search_mobile_input").keypress(function(event) {
        if (event.which == 13) {
            event.preventDefault();
            $("#mobile_form_search").submit();
        }
    });



    $('.wsub > a').click(function(){
        var link_sub = $('.wsub > a');
        var menu_main = $('.main_ul > li');
        var menu_sub = $('.wsub');

        if (link_sub.hasClass("selected")){
            menu_main.show();
            link_sub.removeClass('selected');
            $('.wsub > ul').hide().css({position:'absolute'});
        } else {
            menu_main.hide();
            menu_sub.show();
            link_sub.addClass('selected');
            $('.wsub > ul').show().css({position:'initial', border:'none'});
        }
    });

    $('#nav_mobile').click(function(){
        var link = $('#nav_mobile');
        var menu = $('#nav');
        var link2 = $('#search_mobile');
        var input = $('#search_mobile_input');

        if (link.hasClass("selected")){
            link.removeClass("selected");
            link2.removeClass("selected");
            link.animate({left:'-=221'}, "fast");
            menu.animate({left:'-=221'}, "fast");
            menu.fadeOut();
        } else {
            link.addClass("selected");
            link2.removeClass("selected");
            link.animate({left:'+=221'}, "fast");
            menu.show();
            menu.animate({left:'0'}, "fast");
            input.fadeOut();
            link2.animate({right:'10'}, "fast");
        }
    });
    $('#search_mobile').click(function(){
        var link = $('#nav_mobile');
        var menu = $('#nav');
        var link2 = $('#search_mobile');
        var input = $('#search_mobile_input');

        if (link2.hasClass("selected")){
        	input.css('display','none');
            link.removeClass("selected");
            link2.removeClass("selected");
            link2.animate({right:'-=221'}, "fast");
            input.animate({right:'-=221'}, "fast");
            input.fadeOut();
        } else {
            link2.addClass("selected");
            link.removeClass("selected");
            link2.animate({right:'+=221'}, "fast");
            input.css('display','block');
            input.show();
            input.animate({right:'10'}, "fast");
            link.animate({left:'10'}, "fast");
            menu.fadeOut();
        }
    });
    $('#loginout').click(function(){
        var link = $('#nav_mobile');
        var menu = $('#nav');
        if (link.hasClass("selected")){
            link.removeClass("selected");
            link.animate({left:'-=221'}, "fast");
            menu.animate({left:'-=221'}, "fast");
            menu.fadeOut();
        }
    });
    $('#login-link').click(function(){
        var link = $('#nav_mobile');
        var menu = $('#nav');
        if (link.hasClass("selected")){
            link.removeClass("selected");
            link.animate({left:'-=221'}, "fast");
            menu.animate({left:'-=221'}, "fast");
            menu.fadeOut();
        }
    });
/*
    $(window).one("resize", function(){
    });
*/
    $(window).resize(function(){
        var it_c = $('.thumb_list > li').length;
        var ul_width1 = it_c*194;
        var margin_left = "0px";
        $('.thumb_list').css({'width':ul_width1,'margin-left':margin_left});
    });
    $(window).resize();

    $('.slider_inner .flexslider').flexslider({
        namespace: "flex-",             //{NEW} String: Prefix string attached to the class of every element generated by the plugin
        selector: ".slides > li",       //{NEW} Selector: Must match a simple pattern. '{container} > {slide}' -- Ignore pattern at your own peril
        animation: "fade",              //String: Select your animation type, "fade" or "slide"
        easing: "swing",               //{NEW} String: Determines the easing method used in jQuery transitions. jQuery easing plugin is supported!
        direction: "horizontal",        //String: Select the sliding direction, "horizontal" or "vertical"
        reverse: false,                 //{NEW} Boolean: Reverse the animation direction
        animationLoop: true,             //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
        smoothHeight: false,            //{NEW} Boolean: Allow height of the slider to animate smoothly in horizontal mode
        startAt: 0,                     //Integer: The slide that the slider should start on. Array notation (0 = first slide)
        slideshow: true,                //Boolean: Animate slider automatically
        slideshowSpeed: 3000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
        animationSpeed: 600,            //Integer: Set the speed of animations, in milliseconds
        initDelay: 0,                   //{NEW} Integer: Set an initialization delay, in milliseconds
        randomize: false,               //Boolean: Randomize slide order

        // Usability features
        pauseOnAction: true,            //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
        pauseOnHover: false,            //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
        useCSS: false,                   //{NEW} Boolean: Slider will use CSS3 transitions if available
        touch: true,                    //{NEW} Boolean: Allow touch swipe navigation of the slider on touch-enabled devices
        video: true,                   //{NEW} Boolean: If using video in the slider, will prevent CSS3 3D Transforms to avoid graphical glitches

        // Primary Controls
        controlNav: true,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
        directionNav: false             //Boolean: Create navigation for previous/next navigation? (true/false)
    });

    $('.q_club_inner .flexslider').flexslider({
        namespace: "flex-",             //{NEW} String: Prefix string attached to the class of every element generated by the plugin
        selector: ".slides > li",       //{NEW} Selector: Must match a simple pattern. '{container} > {slide}' -- Ignore pattern at your own peril
        animation: "fade",              //String: Select your animation type, "fade" or "slide"
        easing: "swing",               //{NEW} String: Determines the easing method used in jQuery transitions. jQuery easing plugin is supported!
        direction: "horizontal",        //String: Select the sliding direction, "horizontal" or "vertical"
        reverse: false,                 //{NEW} Boolean: Reverse the animation direction
        animationLoop: true,             //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
        smoothHeight: false,            //{NEW} Boolean: Allow height of the slider to animate smoothly in horizontal mode
        startAt: 0,                     //Integer: The slide that the slider should start on. Array notation (0 = first slide)
        slideshow: true,                //Boolean: Animate slider automatically
        slideshowSpeed: 3000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
        animationSpeed: 600,            //Integer: Set the speed of animations, in milliseconds
        initDelay: 0,                   //{NEW} Integer: Set an initialization delay, in milliseconds
        randomize: false,               //Boolean: Randomize slide order

        // Usability features
        pauseOnAction: true,            //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
        pauseOnHover: false,            //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
        useCSS: false,                   //{NEW} Boolean: Slider will use CSS3 transitions if available
        touch: true,                    //{NEW} Boolean: Allow touch swipe navigation of the slider on touch-enabled devices
        video: true,                   //{NEW} Boolean: If using video in the slider, will prevent CSS3 3D Transforms to avoid graphical glitches

        // Primary Controls
        controlNav: true,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
        directionNav: false             //Boolean: Create navigation for previous/next navigation? (true/false)
    });


    Cufon.replace('#nav li a, .subnav .navbar a, .nav3 a, .cuselText, .cusel-scroll-pane span, .dinpro', {hover: true}); // Requires a selector engine for IE 6-7, see above
    Cufon.replace('#search-filter label, .page-title, .dinpro'); // Requires a selector engine for IE 6-7, see above
    Cufon.now();

    $("#search-filter .cufon, #search-filter .cusel span").click(function() {
        $(this).parent('span').click();
        Cufon.refresh();
    });

    $('.accordion-body').addClass('collapse');

    $(".accordion-heading").click(function() {
        // Reset them
        $(this).removeClass("active");
        $(".accordion-heading").removeClass("active");
        // Add to the clicked one only
        $(this).addClass("active");
        Cufon.refresh();
    });


});