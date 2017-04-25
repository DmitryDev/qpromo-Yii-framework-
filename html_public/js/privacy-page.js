$(document).ready(function() {

    $.each({"data-spy":"scroll","data-target":".bs-docs-sidebar","data-offset":"60"}, function(key, value) {
        $("body").attr(key,value);
    });

    $('.product_nav li:first').addClass('first');
    $('.product_nav li:last').addClass('last');

    console.log('test');

    $('.privacy-page section:odd').each(function(){
        $(this).addClass("odd");
        $(this).wrap('<div class="bottom_section" />');
        $(this).wrap('<div class="top_section" />');
    });

});