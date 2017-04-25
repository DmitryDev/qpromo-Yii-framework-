<?php

class ProductController extends Controller
{   
    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
        
    public function actionView($id)
    {
        if (isset($_POST['User'])) {
            
            if ($this->_quote($_POST)) {
                $message = 'Thank you. Your request was sent successefuly. Our represantative will contact you soon.';
                $result = 'ok';
            } else {
                $message = 'Contact information provided is wrong. Quote was not sent.';
                $result = 'error';
            }
            Yii::app()->user->setFlash('quoteSent', $message);
            Yii::app()->user->setFlash('quoteSentResult', $result);
            //Yii::app()->end();
        }
        
        $quote = null;
        if (!Yii::app()->user->isGuest)
            $quote = User::model()->findByPk(Yii::app()->user->id);        
        if ($quote === null) {
            $quote = new User;
            $quote->username = 'quote'; //username is not used for quote
                                        //but it's required for User model validation
                                        //so we filled it with dummy value
        }
        
        if(isset($_POST['ajax']) && $_POST['ajax']==='quote-form') {
            echo CActiveForm::validate($quote);
            Yii::app()->end();
        }
                
        $cs = Yii::app()->getClientScript();

        // registering JavaScript file        
        $cs->registerScriptFile('/js/cusel/js/cusel.js', CClientScript::POS_END);
        $cs->registerScriptFile('/js/jquery.easing.1.3.js', CClientScript::POS_END);
        $cs->registerScriptFile('/js/product-page.js', CClientScript::POS_END);
       
        
        
        $model = Product::model()->findByPk($id);
        if ($model === null)
                throw new CHttpException(404,'The requested page does not exist.');
        
        $scaleWidth = 0;
        $cs->registerScript('pricesScale', $this->createPricesScale($model, $scaleWidth), CClientScript::POS_HEAD);
        $cs->registerScript('productId', 'var productId=' . $model->id, CClientScript::POS_HEAD);
        
        $model->viewed = $model->viewed +1;
        $model->save();
        
        $this->render('view', array('model'=>$model, 'quote'=>$quote, 'scaleWidth'=>$scaleWidth));
    }
    
    public function actionGetPriceScale() {
        if(Yii::app()->request->isAjaxRequest && isset($_POST['productId']) && isset($_POST['capacity'])) {
            $response = array();
            $response['result'] = 'error';
            $product = Product::model()->findByPk($_POST['productId']);
            if ($product !== null) {
                $prices = ProductPrice::model()->findAllByAttributes(array('product_id'=>$product->id, 'capacity'=>$_POST['capacity']));
                
                $scale = "pricesScale = [];\n";
                $scaleWidth = 0;
                $index = 0;
                $min = 1000000;
                foreach($prices as $price) {
                    if ($price->quantity>1) {
                        ++$scaleWidth;
                        if ($price->quantity < $min) $min = $price->quantity;
                        $discount = ($product->priceCode != null) ? $product->priceCode->discount : 0;
                        $cost = Calculator::targetPrice($price->price, $product->weight, $price->quantity, $discount,1, count($product->capacitiesArray)>0);
                        $scale .= "pricesScale['$index'] = {'quantity':'$price->quantity', 'price':'$cost'};\n";
                        ++$index;
                    }
                }
                
                $response['minimum']=$min;
                $response['result']='ok';
                $response['scale']=$scale;                
                
                $response['note']='';
                if (!Yii::app()->user->isGuest) $response['note']='Note: Net Price';
                else
                    if($product->priceCode !== null)
                            $response['note']='Note: '.$scaleWidth.$product->priceCode->code;
                            
            }
            
            header('Content-Type: application/json; charset="UTF-8"');
            echo CJSON::encode($response);
            Yii::app()->end();
        }
    }
       
    private function _quote($quote) {       
        $user = new User;
        $user->first_name = $quote['User']['first_name'];
        $user->last_name = $quote['User']['last_name'];
        $user->email = $quote['User']['email'];
        $user->username = $quote['User']['email'];
        $user->company = $quote['User']['company'];
        $user->phone = $quote['User']['phone'];
        if (!$user->validate()) return false;
        return Yii::app()->mailer->instantQuote($quote);        
    }    
    
    private function createPricesScale($model, &$scaleColumns)
    {                   
        $scale = "var pricesScale = [];\n";
        $scaleColumns = 0;
        
        if ($model->isMedia) {
            //First capacity is selected by default
            $capacity = $model->capacitiesArray[0];
            $prices = ProductPrice::model()->findAllByAttributes(array('product_id'=>$model->id, 'capacity'=>$capacity));
            $index = 0;
            foreach($prices as $price) {
                if ($price->quantity > 1) {
                    $discount = ($model->priceCode != null) ? $model->priceCode->discount : 0;
                    $cost = Calculator::targetPrice($price->price, $model->weight, $price->quantity, $discount,1, count($model->capacitiesArray)>0);
                    $scale .= "pricesScale['$index'] = {'quantity':'$price->quantity', 'price':'$cost'};\n";                                            
                    ++$index;
                    ++$scaleColumns;
                }
            }
            
            
        } else {               
            $index = 0;
            foreach($model->prices as $price) {
                if ($price->quantity>1) {
                    $discount = ($model->priceCode != null) ? $model->priceCode->discount : 0;
                    $cost = Calculator::targetPrice($price->price, $model->weight, $price->quantity, $discount,$model->priceCode->multiplier, count($model->capacitiesArray)>0);
                    $scale .= "pricesScale['$index'] = {'quantity':'$price->quantity', 'price':'$cost'};\n";                                            
                    ++$scaleColumns;
                    ++$index;
                }
            }            
        }
                
        return $scale;
    }
 	public function actionPrintfriendly ($id) {
 	$model = Product::model()->findByPk($id);
        if ($model === null)
                throw new CHttpException(404,'The requested page does not exist.');
        
        
        $this->render('_printerfriendly', array('model'=>$model));		
 		
 	}
 	public function actionEmailtoclient ($id) {
 	$model = Product::model()->findByPk($id);
        if ($model === null)
                throw new CHttpException(404,'The requested page does not exist.');

  
    $form = new Product();
    
    if(isset($_POST['Product'])){

   
    
   $form->name_from = $_POST['Product']['name_from'];
   $form->email_from = $_POST['Product']['email_from'];
   $form->name_to = $_POST['Product']['name_to'];
   $form->email_to = $_POST['Product']['email_to'];
  
   
   
  if($form->validate()) {

  	
   	$name = ucfirst($_POST['Product']['name_from']);
 	$frndname = ucfirst($_POST['Product']['name_to']);
 	$frndemail = $_POST['Product']['email_to'];
 	$email = $_POST['Product']['email_from'];
    $message = $_POST['email_message'];
 	 if (strtoupper(substr(PHP_OS,0,3)=='WIN')) { 
  		$eol="\r\n"; 
	  }
	  elseif (strtoupper(substr(PHP_OS,0,3)=='MAC')) { 
		$eol="\r"; 
	  }
	  else { 
	  	$eol="\n"; 
	  }

      $from .= "From: ".$name." <".$email.">\r\n";
	  $from .= 'Reply-To: '.$name.' <'.$email.'>'.$eol;
	  $from .= 'Return-Path: '.$name.' <'.$email.'>'.$eol; // set reply address
	  $from .= "Message-ID:<".$now." sales@".$_SERVER['SERVER_NAME'].">".$eol; 
	  $from .= "X-Mailer: PHP v".phpversion().$eol; // These two to help avoid spam-filters 
      $from .= 'MIME-Version: 1.0'.$eol; 
	  $from .= "Content-Type: text/html; charset=iso-8859-1".$eol;

 $subject = "Look what ".$name." found at Qpromo.com!";
 $features = $model;
 $modelImage = ProductImage::model()->findByPk($model->main_image_id);
$body = '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

</head>

<body bgcolor="#222222">
<table align="center" width="100%" height="100%" style="text-align: center; center: 0; margin: 20px 0; font-family: Arial, Helvetica, sans-serif; font-size: 12px;" cellpadding="0" cellspacing="0" bgcolor="#222222">    
	 <tr>
		<td valign="middle" align="center" bgcolor="#222222">
			<table width="600" bgcolor="#FFFFFF" style="margin: 10px 0; center: 0; padding: 0; padding-bottom: 8px; margin-bottom: 0;" align="center" cellpadding="0" cellspacing="0">
				<tr><td colspan="2"><a href="http://www.qpromo.com/" title="Qpromo Homepage" style="outline: none; border: none;"><img src="http://qpromo.com/images/header_popup_email.png" alt="Qpromo Header" border="0" /></a></td></tr>
				<tr><td colspan="2" valign="middle"><div style="padding: 5px 13px; text-align:left;">Greetings '.$frndname.',<br/><br/>'.$name.' has sent you the following product</span></td></tr>
				<tr><td colspan="2" valign="middle"><div style="padding: 5px 13px; text-align:left;">'.$name.' said "'.$message.'"</span></td></tr>				
				<tr><td colspan="2" valign="middle" align="left"><div style="padding: 5px 13px;">If you cannot see this product, please <a href="http://www.qpromo.com/product/'.$id.'" title="'.$features->name.'">click here</a></div></td></tr>
				<tr><div class="images" style="margin-top: 10px;">';
         $counter = 0;
        foreach($model->product_images as $image):
        	
             if ($image!== null):                 
                $body .='<img src="http://qpromo.com/images/product/'.$image->large.'" class="product-image" />';                
                 if (++$counter == 2) break; 
             endif; 
         endforeach;
	$body .='</div>
			    <tr><div style="padding: 5px 13px;"><h4 style="font-size: 16px; padding: 0 0 3px 0; margin: 0; ">'.$features->name.'</h4><div>'.$features->description.'</div></div></tr>
				<tr><td colspan="2" valign="middle" align="left"><div style="min-height: 130px; border: 1px solid #CFCFCF; border-bottom: 2px solid #CCC; -webkit-border-radius: 5px; -moz-border-radius: 5px;   border-radius: 5px; padding: 5px 10px; height:auto; margin: 5px;"><font style="font:Arial, Helvetica, sans-serif; font-size:14px; color:#06a4e0; font-weight:bold;">Specifications:</font>
					<table><tr>';
					
					$body .= '
	
    
    <table class="specification">
        <tr>
            <td style="width: 50%;vertical-align: text-top;">
            
                <h3>Product Specs:</h3>
    <div style="margin-left:10px;">Model #: '.$model->model_number.'</div>';
    if(count($model->capacities)>0 && ($model->capacities[0]->capacity>0)):
    $body .='<div style="margin-left:10px;">Capacities:';
            foreach($model->capacities as $key=>$capacity):
            $body .=($capacity->capacity>0)? Capacity::translateCapacity($capacity->capacity) : '';
             if(count($model->capacities) > ($key+1)) $body.= ', ';
             endforeach;
    $body .='</div>';
     endif;
    
     if (count($model->colorsArray)): 
    $body .='<div style="margin-left:10px;">Available Colors:'; 
     foreach($model->colorsArray as $color): 
    	 if (!empty($color)): 
                $body .='<div class="color" style="border: 1px solid black;border-radius: 2px;height: 10px;width: 10px;display: inline-block;margin-left: 10px;background-color: #'.$color.'"></div>';
         endif;
     endforeach;
    $body.='</div>';
     endif;    
    
     if($model->custom_color=='yes'): 
        $body .='<div style="margin-left:10px;">Custom Colors Available: yes</div>';
     endif;
        
     if($model->width>0 || $model->length>0 || $model->height>0 || $model->diameter>0):
     $body .='<div style="margin-left:10px;">Physical Size:';
        $size_in = ($model->size_in=='in')?'"':$model->size_in;
        if($model->width>0):
        $body .='<div class="size_spec" style="display:inline;margin-left: 10px;width: auto;"><'.number_format($model->width,2).' '.$size_in.'(w)</div>';
        if($model->length>0 || $model->height>0 || $model->diameter>0) $body.= '&times;';
        endif;
        if($model->length>0):
        $body .='<div class="size_spec" style="display:inline;margin-left: 10px;width: auto;">'.number_format($model->length,2).' '.$size_in.'(l)</div>';
        if($model->height>0 || $model->diameter>0) $body .= '&times;';
        endif;
        if($model->height>0):
        $body .='<div class="size_spec" style="display:inline;margin-left: 10px;width: auto;">'.number_format($model->height,2).' '.$size_in.'(h)</div>';
        if($model->diameter>0) $body .= '&times;';
        endif;
         if($model->diameter>0):
        $body .='<div class="size_spec" style="display:inline;margin-left: 10px;width: auto;">'.number_format($model->diameter,2).' '.$size_in.'(d)</div>';        
         endif;
    $body .='</div>';
     endif;
        
     if($model->weight>0):
        $body .'<div style="margin-left:10px;">Weight: '.number_format($model->weight,3).' '.$model->weight_in.'</div>';
     endif;    
           $body .=' </td>
            <td style="width: 50%;vertical-align: text-top;">';
            
             if($model->imprint !== null):

$body .='<h3>Customization Options:</h3>';
if (!empty($model->imprint->areas)):
$body .='<div style="padding-left:12px;">Printing Areas: '.$model->imprint->areas.'</div>';
endif;

if($model->imprint->width>0 || $model->imprint->height>0):
    $body .='<div style="padding-left:12px;">Area Size:';
        if($model->imprint->width>0):
        $body.='<div class="size_spec" style="display:inline;margin-left: 10px;width: auto;">'.number_format($model->imprint->width,2).'"' .'</div>';
        if($model->imprint->height>0) $body .= '&times;';
        endif;
        if($model->imprint->height>0):
        $body.='<div class="size_spec" style="display:inline;margin-left: 10px;width: auto;">'.number_format($model->imprint->height,2).'"' .'</div>';
        endif;
    $body .='</div>';
    
endif;

if(!empty($model->imprint->printings)):
$body .='<div style="padding-left:12px;">Printing Methods:';
    foreach($model->imprint->printingModels as $method):
    $body.='<div class="method-name" style="display: inline;margin-left: 5mm;">'.$method->name.'</div>';
    endforeach;
$body .='</div>';
endif;

endif;
$body.='            </td>
            
        </tr>
    </table>
	  
				
	</tr>
	<tr><td align="center" valign="middle" height="15" colspan="2"  bgcolor="#222222"><div style="background-color: #b4b4b4; margin: 0 auto; text-align: center; width: 600px;">'.CHtml::image("/images/header_new.png").'<img src="http://www.qpromo.com/email/images/footer.gif" width="600"></div></td></tr>
	<tr><td colspan="2" align="center" valign="middle"><div style=" width: 600px;font-family:Arial, Helvetica, sans-serif; line-height:12px; color:#333333; font-size:12px; background-color: #b4b4b4; "><br>
					<b>Email:</b> <a href="mailto:sales@qpromo.com" style="color:#333333;">sales@qpromo.com</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Telephone:</b> 888-805-9548<br><br>
					<span style="color:#666666;">Copyright &copy; 2013 | Qpromo.com | All rights reserved.</span><br><br></div>
	</td></tr>
  </table>
</body>
</html>';

mail($frndemail,$subject,$body,$from);
   
    	$this->render('_emailtoclient_result', array('model'=>$model));
   } 
   	else {   		   
        	$this->render('_emailtoclient', array('model'=>$model,'form'=>$form));
    	}   	
    	}
    	else {    
        	$this->render('_emailtoclient', array('model'=>$model,'form'=>$form));
    	}			
 		
 	}        
    
 	
	
}