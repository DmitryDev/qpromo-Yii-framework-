<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class QuoteCalculatorForm extends CFormModel
{    
    public $quantity; 
    public $unit_cost;
    public $capacity;
    public $unit_weight;
    public $price_discount;
    public $product_id;
    public $areas = array();
    
    public $result;
    
    /**
     * Declares the validation rules.     
     */
    public function rules()
    {
        return array(            
            array('quantity,unit_cost, unit_weight', 'required'),                                    
            array('quantity,unit_cost, unit_weight', 'numerical'),            
            array('capacity, product_id, areas', 'safe'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'quantity'=>'Quantity',
            'unit_cost'=>'Unit Cost',
            'unit_weight'=>'Unit Weight'
        );
    }

}
