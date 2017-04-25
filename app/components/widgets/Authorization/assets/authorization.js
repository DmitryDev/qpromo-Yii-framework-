
jQuery(function($){
    $(document).ready(function() {
        $('.nav-tabs a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
        
        $('#login-link').attr('href', '#myModal');
        
        $('#forgot_user, #forgot_pass').click(function(){
            $('#myModal').modal('hide');
            $('#myModal2').modal('show');
        });

        $('#cancel_reset_top, #cancel_reset').click(function(e){
            $('#myModal2').modal('hide');
            $('#myModal').modal('show');
            e.preventDefault();
        });
    });
});