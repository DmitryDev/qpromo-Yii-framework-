$(document).ready(function() {

    $.each({"data-spy":"scroll","data-target":".bs-docs-sidebar","data-offset":"60"}, function(key, value) {
        $("body").attr(key,value);
    });

    /*
    $("body").attr("data-spy","scroll");
    $("body").attr("data-target",".bs-docs-sidebar");
    $("body").attr("data-offset","60");
*/
    var params = {
        changedEl: "#rush"
        /*visRows: 5,
         scrollArrows: true*/
    }
    cuSel(params);


    $('ul.product_nav li:first').addClass('first');
    $('ul.product_nav li:last').addClass('last');

    $('ul.preload_opts li:even, ul.packaging_opts li:even, ul.accessories_opts li:even').addClass('even');

    $('.preload_checkbox').click(
        function(){
            $(this).toggleClass('checked');

        var $checkbox = $(this).find(':checkbox');
        $checkbox.attr('checked', !$checkbox.attr('checked'));
    });

    $('#product_nav a[href*=#]:not([href=#])').click(function() {
        /* if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
         || location.hostname == this.hostname) {*/

        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
        var cur_item = $(this);
        if (target.length) {
            $('html,body').animate({
                scrollTop: target.offset().top - 60
            }, 600,'jswing', function() {
                $('.sector_tit').not(this).hide();
                cur_item.parent().find('.sector_tit').fadeIn(200);
                $('ul.nav a').not(this).removeClass('active');
                cur_item.addClass('active');
            });
            return false;
        }
        //}
    });




    function countPrice() {

        var quantity = parseInt($('#quantity').val());
        /*var price1 = $('.q_price.price1 .price cufontext').html();
        var price2 = $('.q_price.price2 .price cufontext').html();
        var price3 = $('.q_price.price3 .price cufontext').html();
        var price4 = $('.q_price.price4 .price cufontext').html();
        var price5 = $('.q_price.price5 .price cufontext').html();*/
        if(quantity){
            var qprice = 1;
            var newprice = 0;
            var prev = 0;
            var first = true;
            jQuery.each(pricesScale, function() {
                var price = this;
                if(!first){
                    if(quantity >= parseInt(prev.quantity) && quantity < parseInt(price.quantity)){
                        newprice = quantity * prev.price;
                        $('.q_price span').css('color','#D3D3D3');
                        $('.q_price.price'+prev.quantity+' .price').css('color','#404041');
                        $('.q_price.price'+prev.quantity+' .currency').css('color','#404041');
                    } else if(pricesScale[pricesScale.length-1].quantity <= quantity){
                        console.log('test');
                        newprice = quantity * pricesScale[pricesScale.length-1].price;
                        $('.q_price span').css('color','#D3D3D3');
                        $('.q_price.price'+pricesScale[pricesScale.length-1].quantity+' .price').css('color','#404041');
                        $('.q_price.price'+pricesScale[pricesScale.length-1].quantity+' .currency').css('color','#404041');
                    }
                }
                first = false;
                prev = price;
                qprice++;
            });
            var result =  newprice.toFixed(2);
            $("#price .dinpro").html(result);

            /*if(quantity){
            if(quantity >= 100 && quantity < 250){
                var newprice = quantity * price1;
                $('.q_price span').css('color','#D3D3D3');
                $('.q_price.price1 .price, .q_price.price1 .currency').css('color','#404041');
            } else if(quantity >= 250 && quantity < 500){
                var newprice = quantity * price2;
                $('.q_price span').css('color','#D3D3D3');
                $('.q_price.price2 .price, .q_price.price2 .currency').css('color','#404041');
            } else if(quantity >= 500 && quantity < 1000){
                var newprice = quantity * price3;
                $('.q_price span').css('color','#D3D3D3');
                $('.q_price.price3 .price, .q_price.price3 .currency').css('color','#404041');
            } else if(quantity >= 1000 && quantity < 2500){
                var newprice = quantity * price4;
                $('.q_price span').css('color','#D3D3D3');
                $('.q_price.price4 .price, .q_price.price4 .currency').css('color','#404041');
            } else if(quantity >= 2500){
                var newprice = quantity * price5;
                $('.q_price span').css('color','#D3D3D3');
                $('.q_price.price5 .price, .q_price.price5 .currency').css('color','#404041');
            } else {
                $('.q_price span').css('color','#D3D3D3');
            }
            if(newprice){
                var result =  newprice.toFixed(2);
                $("#price .dinpro").html(result);
            } else {
                $("#price .dinpro").html("0.00");
            }*/
        } else {
            $('.q_price span').css('color','#404041');
        }
        Cufon.replace('.dinpro');
        Cufon.refresh();
    }

    $("#quantity").keyup(countPrice);

    countPrice();

    var qprice = 1;
    jQuery.each(pricesScale, function() {
        var price = this;
        $(".q_line").append('<div class="q_price price'+price.quantity+'"><span class="currency">$</span><span class="dinpro price">'+price.price+'</span><span class="dinpro units">'+price.quantity+'</span></div>');
        qprice++;
    });

    $('.flexslider').flexslider({
        namespace: "flex-",             //{NEW} String: Prefix string attached to the class of every element generated by the plugin
        selector: ".slides > li",       //{NEW} Selector: Must match a simple pattern. '{container} > {slide}' -- Ignore pattern at your own peril
        animation: "fade",              //String: Select your animation type, "fade" or "slide"
        easing: "swing",               //{NEW} String: Determines the easing method used in jQuery transitions. jQuery easing plugin is supported!
        direction: "horizontal",        //String: Select the sliding direction, "horizontal" or "vertical"
        reverse: false,                 //{NEW} Boolean: Reverse the animation direction
        animationLoop: true,             //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
        smoothHeight: true,            //{NEW} Boolean: Allow height of the slider to animate smoothly in horizontal mode
        startAt: 0,                     //Integer: The slide that the slider should start on. Array notation (0 = first slide)
        slideshow: false,                //Boolean: Animate slider automatically
        slideshowSpeed: 3000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
        animationSpeed: 600,            //Integer: Set the speed of animations, in milliseconds
        initDelay: 0,                   //{NEW} Integer: Set an initialization delay, in milliseconds
        randomize: false,               //Boolean: Randomize slide order
        // Usability features
        pauseOnAction: true,            //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
        pauseOnHover: false,            //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
        useCSS: true,                   //{NEW} Boolean: Slider will use CSS3 transitions if available
        touch: true,                    //{NEW} Boolean: Allow touch swipe navigation of the slider on touch-enabled devices
        video: true,                   //{NEW} Boolean: If using video in the slider, will prevent CSS3 3D Transforms to avoid graphical glitches
        // Primary Controls
        controlNav: true,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
        directionNav: false             //Boolean: Create navigation for previous/next navigation? (true/false)
    });
    
    $('#submit').click(function(e){        
        var quantity = $('<input>', {'name':'quantity', 'type':'hidden'}).val($('#quantity').val());
        $('#quote-form').append(quantity);           
        
        $('#imprint input.printing:checked').each(function() {            
            var printingOption = $('<input>', {'name':'printing[]', 'type':'hidden'}).val($(this).data('method'));
            $('#quote-form').append(printingOption);           
  
        });
        $('#preload input.preloaded:checked').each(function() {            
            var preloadedOption = $('<input>', {'name':'preloaded[]', 'type':'hidden'}).val($(this).data('preloaded'));
            $('#quote-form').append(preloadedOption);           
        });        
        $('#accessories input.accessory:checked').each(function() {            
            var accessoryOption = $('<input>', {'name':'accessory[]', 'type':'hidden'}).val($(this).data('accessory'));
            $('#quote-form').append(accessoryOption);           
        });
        $('#packaging input.packaging:checked').each(function() {            
            var packagingOption = $('<input>', {'name':'packaging[]', 'type':'hidden'}).val($(this).data('packaging'));
            $('#quote-form').append(packagingOption);           
        });
        //e.preventDefault();
        //return false;
    });
    
    $('#pricing .price-capacity input[type=radio]').change(function() {
        var capacity = $(this).val();
        $.ajax({
            url: '/product/getPriceScale',
            dataType: 'json',
            data: {
                productId: productId,
                capacity: capacity                
            },
            type: 'POST',
            cache: false,
            
            success: function(data){                
                if (data['result']='ok') {
                    $('#price span.note').text(data['note']);
                    $('.qty-minimum').text(data['minimum']);
                    $(".q_line").html('');
                    eval(data['scale']);
                    var qprice = 1;
                    jQuery.each(pricesScale, function() {
                        var price = this;
                        $(".q_line").append('<div class="q_price price'+price.quantity+'"><span class="currency">$</span><span class="dinpro price">'+price.price+'</span><span class="dinpro units">'+price.quantity+'</span></div>');
                        qprice++;
                    });
                    countPrice();
                }
                /*$('.search-stats .curent_cat').html(data.filter);
                $('.search-stats .res_count').html(data.amount);
                if (data.result=='ok') {
                    $('.thumb_list').html(data.products);
                } else {
                    $('.thumb_list').html('');
                }*/
            }
       });
    });

    $('#print').click(function() {
    	var id =  $('#print').attr('attr');
    	window.open('/product/printfriendly/'+id,'','width=720,height=490');	
    });
    $('#email').click(function() {
    	var id =  $('#email').attr('attr');
    	window.open('/product/emailtoclient/'+id,'','width=755,height=490');	
    });
    
});