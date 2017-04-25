<?php

class CalculatorController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='admin_main';

    public function __construct($id, $module = null) {
        parent::__construct($id, $module);        
        $this->layout = 'admin_column2';
        
        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript("jquery");
        $cs->registerCoreScript("jquery.ui");                
               
        $cs->registerCssFile(Yii::app()->assetManager->publish($this->module->basePath . '/css/admin.css'));
        $cs->registerCssFile(Yii::app()->assetManager->publish($this->module->basePath . '/css/calculator.css'));
        $cs->registerScriptFile(Yii::app()->assetManager->publish($this->module->basePath . '/js/calculator.js'), CClientScript::POS_END );
    }
    
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
            array('allow', // allow admin user to perform 'admin' and 'delete' actions                                                            
                    'roles'=>array('admin')),
            array('deny',  // deny all users
                    'users'=>array('*'))									
		);
	}
    
    public function actionIndex($id = null) {
        $model = null;
        if (isset($_POST['productModel'])) {
            $model = Product::model()->findByAttributes (array('model_number'=>$_POST['productModel']));
        }
        if ($model===null && isset($_POST['QuoteCalculatorForm']['product_id']))
            $model = Product::model()->findByPk($_POST['QuoteCalculatorForm']['product_id']);
            
        if ($model === null && $id !==null)
            $model = Product::model()->findByPk($id);
        
        $calculator = new QuoteCalculatorForm;
        if ($model !== null) {
            $calculator->product_id = $model->id;
            $calculator->unit_weight = $model->weight;
            $calculator->price_discount = $model->price_code_id;
        }
        if (isset($_POST['QuoteCalculatorForm'])) {
            $calculator->attributes=$_POST['QuoteCalculatorForm'];
            $calculator->result = $this->calculate($_POST['QuoteCalculatorForm']);            
        }
        
        $this->performAjaxValidation($calculator);
        
        $cs = Yii::app()->getClientScript();                                
        
        // Registering CSS file        
        //$css = $this->module->basePath . '/css/calculator.css';        
        //$cs->registerCssFile(Yii::app()->assetManager->publish($css));
        
        $this->render('index',array('model'=>$model, 'calculator'=>$calculator));
    }
    
    public function actionCalculateUnitCost() {
        if (Yii::app()->request->isAjaxRequest)
        {
            $response = array();
            $response['unitCost'] = 0;
            $response['result']='error';
                        
            if (!isset($_POST['product_id'])) {
                header('Content-Type: application/json; charset="UTF-8"');            
                echo CJSON::encode($response);  
                Yii::app()->end();
            }
            $productPrices = ProductPrice::model()->findAllByAttributes(array(
                'product_id'=>$_POST['product_id'],
                'capacity'=>$_POST['capacity'],
            ));
            
            
            $a = $b = 0;
            $price_a = $price_b = 0;
            foreach($productPrices as $price) {
                if ($price->quantity >=$a && $price->quantity<=$_POST['quantity']) {
                    $a = $price->quantity;
                    $price_a = $price->price;
                }
                if ($price->quantity >$_POST['quantity']) {
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
            
            
            $response['a'] = $a;
            $response['b'] = $b;
            $response['price_a'] = $price_a;
            $response['price_b'] = $price_b;
            
            $response['unitCost'] = $price_a;
            
            $response['result']='ok';
            
            header('Content-Type: application/json; charset="UTF-8"');            
            echo CJSON::encode($response);
            Yii::app()->end();
        }
        return null;
    }
    
    /**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='quote-calculator-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    private function calculate($data) {
        $html = '';
        
        $unit_cost = $data['unit_cost'];
        $quantity = $data['quantity'];
        $unit_weight = $data['unit_weight'];
        $freightPricePerLb = Calculator::freightPricePerLb($unit_weight * $quantity);//self::freightPricePerLb($quantity);
        $total_weight = $unit_weight * $quantity;
        $unit_freight = $freightPricePerLb*$total_weight/$quantity;
        
        $model = Product::model()->findByPk($data['product_id']);
        if ($model !== null) {
            $html .= "<strong>Product: </strong>".$model->name;
            $html .= "<br/><strong>Model Number: </strong>".$model->model_number;
            if (count($model->capacitiesArray)) {
                $html .= "<br/><strong>Capacity: </strong> ". Capacity::translateCapacity($data['capacity']);
            }
            $html .= "<br/><strong>Unit Cost (Net Price): </strong> $".$unit_cost;
            $html .= "<br/><strong>Quantity: </strong> ".$quantity;
            
            if (!count($model->capacitiesArray)) {
                
                $discount = PriceCode::model()->findByPk($data['price_discount']);
                $html .= "<br/>";
                $ratio = 1;
                if ($discount!== null) {
                    $ratio = 100 / (100 - $discount->discount);
                    $html .= "<br/><strong>Price Discount: </strong>{$discount->code} (".
                            number_format($discount->discount)."%, ratio = ". number_format($ratio, 3).") ";
                }
                $unit_list_price = $unit_cost * $ratio;
                $html .= "<br/><strong>Unit List Price: </strong>" . number_format($unit_cost, 3)
                        . "&times;" . number_format($ratio, 3) ." = $" . number_format($unit_list_price, 2);
                $html .= "<br/><strong>Total List Price: </strong>" . number_format($unit_list_price, 3)
                        . "&times;" . number_format($quantity) ." = $" . number_format($unit_list_price*$quantity, 2);                
            } else {
                $html .= "<br/><strong>Unit Weight (lbs): </strong> ".number_format($unit_weight, 5);
                $html .= "<br/><strong>Total Weight (lbs): </strong> ".number_format($total_weight, 5);
                $html .= "<br/><strong>Freight Cost/Lb: </strong> $".number_format($freightPricePerLb, 2);
                $html .= "<br/><strong>Freight Per Unit: </strong> $".number_format($unit_freight, 2);
                                
                $printings = Calculator::calculatePrintings($data['areas'], $quantity);
                $printingCost = 0;
                if (count($printings)) {
                    $html .= "<br/><br/><strong>Printings: </strong>";
                    $html .= "<div class='printing-results'>";
                    foreach($printings as $printing) {
                        $html .= "<div class='printing-result'><i>Area:</i> {$printing['areaName']}</i>";
                        $html .= "<br/><i>Method:</i> {$printing['methodName']}";
                        if ($printing['colors']) $html .= "<br/><i>Colors:</i> {$printing['colors']}";
                        $html .= "<br/><i>Printing Cost:</i> $" . number_format($printing['price'], 2);
                        $html .= "<br/><i>Cost Per Unit:</i> $" . number_format($printing['price']/$quantity, 2);
                        if (isset($printing['notes'])) $html .= "<br/><i>Note:</i> {$printing['notes']}";
                        $html .= "</div>";
                        $printingCost += $printing['price'];
                    }
                    $html .= "</div>";
                }
                $html .= "<br/><strong>Total Printing Cost: </strong> $".number_format($printingCost, 2);
                $html .= "<br/><strong>Unit Printing Cost: </strong> $".number_format($printingCost/$quantity, 2);
                
                $margin = Calculator::marginPrice($quantity);//self::marginPrice($quantity);
                $html .= "<br/><br/><strong>Margin Value: </strong> ".number_format(1-$margin, 2);
                $html .= "<div class='totals'>";

                $bargainPrice = ($unit_cost + $unit_freight + $printingCost/$quantity)/$margin;
                if($data['paymentMethod']=='ccard') {
                    $ccardFee = Calculator::ccardPrice($quantity);//self::ccardPrice($quantity);
                    $initialPrice = $bargainPrice + $bargainPrice*$ccardFee;
                    $targetPrice = ($bargainPrice + $initialPrice) /2;
                } else {
                    $initialPrice = $targetPrice = $bargainPrice;
                }
                $html .= "<strong>Bargain Price: </strong> $".number_format($bargainPrice, 2);
                $html .= "<br/><strong>Initial Price: </strong> $".number_format($initialPrice, 2);
                $html .= "<br/><strong>Target Price: </strong> $".number_format($targetPrice, 2);
                $html .= "</div>";
                
            }
        }             
        
        return $html;
    }
    
    /*public static function freightPricePerLb($quantity) {
        $freights = FreightFee::model()->findAll();
        $a = $b = 0;
        $price_a = $price_b = 0;
        foreach($freights as $freight) {
            if ($freight->quantity >=$a && $freight->quantity<=$quantity) {
                $a = $freight->quantity;
                $price_a = $freight->value;
            }
            if ($freight->quantity >$quantity) {
                if ($b==0) {
                    $b = $freight->quantity;
                    $price_b = $freight->value;
                }
                elseif ($freight->quantity<$b) {
                    $b = $freight->quantity;
                    $price_b = $freight->value;
                }

            }
        }

        return $price_a;            
    }*/
    
    /*private function printingPrice($methodId, $colors, $quantity) {
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
    }*/
       
    /*public static function marginPrice($quantity) {
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
    }*/
}
?>
