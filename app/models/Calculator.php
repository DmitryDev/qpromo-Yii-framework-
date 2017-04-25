<?php


class Calculator {
    const SOLID_COLOR_PRINTING = 1; //1 is the ID of Solid Color Printing method;
    
    
    public static function freightPricePerLb($weight) {
        $freights = FreightFee::model()->findAll();
        $a = $b = 0;
        $price_a = $price_b = 0;
        foreach($freights as $freight) {
            if ($freight->weight >=$a && $freight->weight<=$weight) {
                $a = $freight->weight;
                $price_a = $freight->value;
            }
            if ($freight->weight >$weight) {
                if ($b==0) {
                    $b = $freight->weight;
                    $price_b = $freight->value;
                }
                elseif ($freight->weight<$b) {
                    $b = $freight->weight;
                    $price_b = $freight->weight;
                }

            }
        }

        return $price_a;            
    }
    
    public static function marginPrice($quantity) {
        $margins = Margin::model()->findAll();
        $a = $b = 0;
        $price_a = $price_b = 0;
        foreach($margins as $margin) {
            if ($margin->quantity >=$a && $margin->quantity<=$quantity) {
                $a = $margin->quantity;
                $price_a = $margin->value;
            }
            if ($margin->quantity >$quantity) {
                if ($b==0) {
                    $b = $margin->quantity;
                    $price_b = $margin->value;
                }
                elseif ($margin->quantity<$b) {
                    $b = $margin->quantity;
                    $price_b = $margin->value;
                }

            }
        }

        return $price_a;            
    }
    
    public static function ccardPrice($quantity) {
        $prices = CardFee::model()->findAll();
        $a = $b = 0;
        $price_a = $price_b = 0;
        foreach($prices as $price) {
            if ($price->quantity >=$a && $price->quantity<=$quantity) {
                $a = $price->quantity;
                $price_a = $price->value;
            }
            if ($price->quantity >$quantity) {
                if ($b==0) {
                    $b = $price->quantity;
                    $price_b = $price->value;
                }
                elseif ($price->quantity<$b) {
                    $b = $price->quantity;
                    $price_b = $price->value;
                }

            }
        }

        return $price_a;            
    }
    
    /**
     * Calculates target price that is shown in FRONT END
     * The price includes one area one color solid printing
     * 
     * @param type $unit_price
     * @param type $unit_weight
     * @param type $quantity
     * @param int $discount
     * @param boolean $isMedia Is this product is a flash drive?
     * @return type
     */
    public static function targetPrice($unit_price, $unit_weight, $quantity, $discount,$multiplier, $isMedia) {        
        if (!$isMedia) {            
            if (!Yii::app()->user->isGuest) $discount = 0;
            if(Yii::app()->user->isGuest) $targetPrice = $unit_price + $unit_price*$discount*$multiplier/100;
            else   $targetPrice = $unit_price + $unit_price*$discount/100;
        } else {                        
            $ccard = Calculator::ccardPrice($quantity);
            $pricePerLb = Calculator::freightPricePerLb($unit_weight * $quantity);
            $margin = Calculator::marginPrice($quantity);
                        
            $printing=self::SOLID_COLOR_PRINTING . '_1'; // '_1' means 1 color printing                                    
            $printings = Calculator::calculatePrintings(array('front'=>$printing), $quantity);            
            $printingCost = !empty($printings) ? $printings[0]['price']/$quantity : 0;            
            
            $bargainPrice = ($unit_price + $unit_weight * $pricePerLb + $printingCost) / $margin;
            $initialPrice = $bargainPrice + $bargainPrice*$ccard;
            $targetPrice = ($bargainPrice + $initialPrice) /2;
            
            if (Yii::app()->user->isGuest) $targetPrice *= (1 + $discount/100);
        }
        
        return number_format($targetPrice, 2);        
    }
    
    public static function calculatePrintings($areas, $quantity) {        
        $printings = array();
        foreach ($areas as $name=>$printingCode) {            
            if ($printingCode == 0) continue;
            $matches = array();
            if (preg_match('/^(\d+)_(\d+)$/', $printingCode, $matches)) {
                $printingId = $matches[1];
                $colors = $matches[2];
                
                $printingMethod = Printing::model()->findByPk($printingId);
                if ($printingMethod === null) continue;
                
                
                $printing = array(
                    'areaName'=>$name,
                    'methodName'=>$printingMethod->name,
                    'colors'=>$colors,                    
                );
                                
                $printing['price'] = self::printingPrice($printingId, $colors, $quantity);
                
                
                $printings[] = $printing;
            }
        }
        
        return $printings;
    }
    
    public static function printingPrice($methodId, $colors, $quantity) {
        $printingPrices = PrintingPrice::model()->findAllByAttributes(array('printing_id'=>$methodId, 'colors'=>$colors));
        
        $a = $b = 0;
        $price_a = $price_b = 0;
        foreach($printingPrices as $price) {
            if ($price->quantity >=$a && $price->quantity<=$quantity) {
                $a = $price->quantity;
                $price_a = $price->price;
            }
            if ($price->quantity >$quantity) {
                if ($b==0) {
                    $b = $price->quantity;
                    $price_b = $price->price;
                }
                elseif ($price->quantity<$b) {
                    $b = $price->quantity;
                    $price_b = $price->price;
                }

            }
        }
        
        return $price_a;
    }
    
   
}