$(document).ready(function() {
    function applyFilter() {
        var cat_id = $('#mt-categories').val();
        $('span.issue').each(function() {
            var list = $(this).data('categories');
            if (list.toString().search(cat_id) == -1)
                $(this).hide();
            else $(this).show();            
        });
        
        $('.month').each(function(){
            var empty = true;
            $(this).children('.issue').each(function(){
                if ($(this).css('display')!='none') empty = false;
                if (!empty) return;                
            })
            
            if (empty) $(this).hide();
            else $(this).show();
        })
    }
    
    $('#year-picker li a').click(function() {
        $('#year-picker li a.active').removeClass('active');
        $(this).addClass('active');
        var year = $(this).data('year');
        var active_page = $('#pages .page.active').data('year');
        if (active_page !=year) {
            $('#pages .page.active').removeClass('active');
            $('#pages .page[data-year='+year+ ']').addClass('active');
        }
    })
    
    $('#mt-categories').change(function (){
        applyFilter();
    })
    
})