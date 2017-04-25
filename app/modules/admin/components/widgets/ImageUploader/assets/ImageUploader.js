jQuery(function($){
    $(document).ready(function(){
        
        $(".add-image").click(function(e){
            e.preventDefault();
            var input = $(this).parent().find('.hide input[type="file"]').clone();
            input.insertBefore($(this).parent().find('br'));
        });
                    
    });
        
});
