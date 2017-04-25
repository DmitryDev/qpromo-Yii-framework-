var inputsController = {
    init : function() {
        var me = this;
        $('#QuoteCalculatorForm_quantity').change(function() {
            me.updateUnitCost();
        });
        $('#QuoteCalculatorForm_capacity').change(function() {
            me.updateUnitCost();
        });
    },
    
    updateUnitCost: function() {
        var product_id = $('#QuoteCalculatorForm_product_id').val();
        var quantity = $('#QuoteCalculatorForm_quantity').val();
        var capacity = 0;
        var capacity_input = $('#QuoteCalculatorForm_capacity').val();
        if (capacity_input !== undefined) {
            capacity = capacity_input;
        }
        
        $.ajax({
            url: '/admin/calculator/calculateUnitCost',
            dataType: 'json',
            type: 'POST',
            cache: false,
            data: {
                product_id: product_id,
                quantity: quantity,
                capacity: capacity
            },
            
            success: function(data){                
                var total_weight = $('#QuoteCalculatorForm_unit_weight').val() * quantity;
                $('#QuoteCalculatorForm_unit_cost').val(data['unitCost']);                
                $('#QuoteCalculatorForm_total_weight').val(total_weight);
            }
       });
    }
};


jQuery(function($){
    $(document).ready(function() {         
         inputsController.init();         
    })
})