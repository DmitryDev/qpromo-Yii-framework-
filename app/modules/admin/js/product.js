var colorsController = {
    init : function() {
        var colorInput = $('.add-color input');
        var addBtn = $('<button />').text('+').bind('click', function(e) {
            e.preventDefault();
            
            var colorValue = $(colorInput).val().trim();
            if (colorValue == '') return;
            
            var productColors = $('.product-colors');
            var newProductColors = $('.new-product-colors');
            
            var colorItem = $('<span/>', {'class':'color-item'});
            var colorMarker = $('<span/>', {'class':'color-marker'}).css('background-color', '#'+colorValue).appendTo(colorItem);
            var hiddenInput=$('<input/>', {'type':'hidden', 'name':'Product[newColors][]','value': colorValue}).appendTo(colorItem);
            var deleteColor = $('<span>', {'class':'delete-button'}).html('&times;').bind('click', function(e) {
                $(this).parent().remove();
            }).appendTo(colorItem);
            
            $(colorItem).appendTo(newProductColors);                       
            $(colorInput).val('');
        });
        $(addBtn).insertAfter(colorInput);        
    }
};

var catalogController = {
    init : function() {
        $('#product-grid input[type=checkbox]').live("change", function() {            
            var checked = $(this).attr('checked') == 'checked';
            var product_id = $(this).val();
            //console.log('changed status');
            
            $.ajax({
                url: '/admin/catalog/add',
                dataType: 'json',
                type: 'POST',
                cache: false,
                data: {
                    product_id: product_id,
                    include: checked
                }

                /*success: function(data){                
                    console.log(data);
                }*/
            });            
        })
        
        $("input.generate-catalog-btn").click(function() {
            location.href = "/admin/catalog/index";
        });
        
        $("input.export-btn").click(function() {
            location.href = "/admin/catalog/export";
        });
    }
};

jQuery(function($){
    $(document).ready(function() {
         $('.cp-basic').colorpicker();
         colorsController.init();
         catalogController.init();                  
    })
})