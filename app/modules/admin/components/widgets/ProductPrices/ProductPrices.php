<?php

class ProductPrices extends CWidget {
    public $editable = false;
    public $model = null;

    private $_matrix;

    public function init() {
        parent::init();
        
        $this->_buildMatrix();
    }
    
    public function run() {
        if ($this->editable)
            $this->render('_update', array('matrix'=>$this->_matrix));
        else
            $this->render('_view',   array('matrix'=>$this->_matrix));        
        
        parent::run();
    }
    
    public static function updatePrices($model, $post) {
        if ($model === null) return;
        
        foreach($post['Price'] as $capacity=>$prices) {
        	 foreach($prices as $quantity=>$value) {
                $productPrice = ProductPrice::model()->findByAttributes(array(
                    'product_id'=>$model->id,
                    'capacity'=>$capacity,
                    'quantity'=>$quantity
                ));
                
                if ($productPrice !== null ) {                                        
                    if (in_array($productPrice->capacity, array_keys($post['CapacityDelete']))) {
                        $productPrice->delete();
                        continue;
                    }                    
                    if (in_array($productPrice->quantity, array_keys($post['QuantityDelete']))) {
                        $productPrice->delete();
                        continue;
                    }
                    
                    $productPrice->price = $value;
                    $productPrice->save();
                } else {                    
                    if (in_array($capacity, array_keys($post['CapacityDelete']))) continue;
                    if (in_array($quantity, array_keys($post['QuantityDelete']))) continue;
                    if (!$value) continue;
                    $productPrice = new ProductPrice;
                    $productPrice->product_id = $model->id;
                    $productPrice->capacity = $capacity;
                    $productPrice->quantity = $quantity;
                    $productPrice->price = $value;
                    $productPrice->save();
                }
            }
        }        
    }

    private function _buildMatrix() {
        $productPrices = $this->model->prices;
        
        $this->_matrix = array();
        $this->_matrix['quantities'] = array();
        $this->_matrix['capacities'] = array();
        
        foreach($productPrices as $price) {
            if (!in_array($price->quantity, $this->_matrix['quantities']))
                $this->_matrix['quantities'][] = $price->quantity;
        }        
        sort($this->_matrix['quantities']);
        
        foreach($productPrices as $price) {            
            if (!isset($this->_matrix['capacities'][$price->capacity]))
                $this->_matrix['capacities'][$price->capacity] = array();

            $this->_matrix['capacities'][$price->capacity][$price->quantity] = $price->price;
            
        }
        
    }
       
}