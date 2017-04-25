$(document).ready(function(){
    $('.search-filter').css('display', 'block');
    
    var params = {
        changedEl: "#search-filter select"
        /*visRows: 5,
         scrollArrows: true*/
    }
    cuSel(params);

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
    
    $('#cats').bind('change', function(e) {
        var keyword = $('.search-stats .keyword').text();        
        $.ajax({
            url: '/site/search',
            dataType: 'json',
            data: {
                keyword: keyword,
                ajax: 'search-filter',
                category: $(this).val()
            },
            type: 'POST',
            cache: false,
            success: function(data){
                $('.search-stats .curent_cat').html(data.filter);
                $('.search-stats .res_count').html(data.amount);
                if (data.result=='ok') {
                    $('.thumb_list').html(data.products);
                } else {
                    $('.thumb_list').html('');
                }
            }
       });
   
   });

});
