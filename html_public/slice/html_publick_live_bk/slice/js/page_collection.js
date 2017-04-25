jQuery(function($) {

	var slideSelector = {
		container : $('.slide_selector ul'),
		tabs : $('.slide_selector ul li a'),
		panels : $('.slide_selector .panel'),
		activeSlide : -1,
		offsets : [],
		win: $(window),
		winWidth : $(window).width(),
		sliderWidth : 0,

		init: function() {
			slideSelector.recalculate();
			slideSelector.bindActions();
			slideSelector.container.find('li a.active').click();
		},

		bindActions : function() {
			slideSelector.tabs.on('click', function(){
				slideSelector.activate( slideSelector.tabs.index($(this)) );
				return false;
			});
			slideSelector.win.on('resize', function() {
				slideSelector.recalculate();
			})
		},

		recalculate : function() {
			slideSelector.win = $(window);
			slideSelector.offsets = [];
			for (var i = 0; i <= slideSelector.tabs.length - 1; i++) {
				var thisOffset = slideSelector.tabs.eq(i).offset();
				slideSelector.offsets.push(thisOffset.left);
			};

		},

		activate: function(newIndex) {
			if (newIndex !== slideSelector.activeSlide) {
				slideSelector.tabs.removeClass('active');
				slideSelector.panels.removeClass('active');
				var newLeft = slideSelector.offsets[newIndex];
				var middle = Math.floor(slideSelector.winWidth / 2);
				var thisWidth = Math.floor(slideSelector.tabs.eq(newIndex).outerWidth(true) / 2) - 8;

				$('.slide_selector ul')
					.stop()
					.animate(
						{'margin-left' : middle - newLeft - thisWidth}, 
						240, 
						function() {
							slideSelector.activeSlide = newIndex;
							slideSelector.tabs.eq(newIndex).addClass('active');
							slideSelector.panels.eq(newIndex).addClass('active');
						}
					);
			}
		}
	}

	slideSelector.init();

    $('.slide_selector ul').each(function(){
        var liItems = $(this);
        var Sum = 0;
        if(liItems.children('li').length >= 1){
            $(this).children('li').each(function(i, e){
                Sum += $(e).outerWidth(true);
            });
            $(this).width(Sum+10);
        }
    });

    $("#scroll_right").hover(
        function () {
            var tabs_list = $(".slide_selector ul");
            var win_width = $(window).width();
            var tabs_width = tabs_list.width();
            var currentMargin = tabs_list.css('margin-left');
            var count_res = win_width/2 - tabs_width;
            var test = win_width/2 + count_res;
            var offwidth = parseInt(currentMargin)+tabs_width;
            if(offwidth > win_width){
                $('.slide_selector ul')
                    .animate(
                    {'margin-left' : test},
                    800,
                    function() {
                    }
                );
            }
        },
        function () {}
    );

    $("#scroll_left").hover(
        function () {
            var tabs_list = $(".slide_selector ul");
            var win_width = $(window).width();
            var tabs_width = tabs_list.width();
            var currentMargin = tabs_list.css('margin-left');
            var count_res = win_width/2 - tabs_width;
            var test = win_width/2 - count_res;
            var offwidth = parseInt(currentMargin)-parseInt(currentMargin);
            if(parseInt(currentMargin) < 0){
                $('.slide_selector ul')
                    .animate(
                    {'margin-left' : offwidth},
                    800,
                    function() {
                    }
                );
            }
        },
        function () {}
    );

    $(window).resize(function(){
        var w_width = $(window).width();
        var items_count = Math.floor(w_width/194);
        var it_c = $('.thumb_list > li').length;

        var ul_width1 = items_count*194;
        var ul_width2 = it_c*194;

        if(ul_width1>ul_width2){
            var ul_width = ul_width2;
        } else {
            var ul_width = ul_width1;
        }

        var margin_left = (w_width - ul_width)/2;

        $('.thumb_list').css({'width':w_width-margin_left,'margin-left':margin_left});
    });
    $(window).resize();

});