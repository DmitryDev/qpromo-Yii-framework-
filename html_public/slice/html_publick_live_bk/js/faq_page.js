$(document).ready(function(){
    $('.accordion-body').addClass('collapse');

    $(".accordion-heading").click(function() {
        // Reset them
        $(this).removeClass("active");
        $(".accordion-heading").removeClass("active");
        // Add to the clicked one only
        $(this).addClass("active");
    });
});
