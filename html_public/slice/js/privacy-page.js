$(document).ready(function() {

    $.each({"data-spy":"scroll","data-target":".bs-docs-sidebar","data-offset":"60"}, function(key, value) {
        $("body").attr(key,value);
    });

});