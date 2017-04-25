<?php
/* @var $this AccessoryController */
/* @var $model Accessory */

$this->breadcrumbs=array(
	'Price Calculator'
);
?>

<h1>Calculate product quote price</h1>

<form method="post" action="<?php echo $this->createUrl('index')?>">
    <input type="text" value="<?=($model!==null)?$model->model_number : '' ?>"
           name="productModel" placeholder="Product Model Number...">
    <input type="submit" value="Load">
</form>

<div class="calculator form-section">
    <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'quote-calculator-form',
                'enableAjaxValidation'=>true,                
    )); ?>
    <?php echo $form->errorSummary($calculator); ?>
    <?php if($model !==null): ?>
    <?php echo $form->hiddenField($calculator,'product_id'); ?>
    <?php endif; ?>
    <div class="row">
        <?php echo $form->labelEx($calculator,'quantity', array('class'=>'caption')); ?>
        <?php echo $form->textField($calculator,'quantity',array('size'=>10,'maxlength'=>10)); ?>
        <?php echo $form->error($calculator,'quantity'); ?>
    </div>
    
    <?php if(count($model->capacitiesListBoxArray)):?>
        <?php echo $form->labelEx($calculator,'capacity', array('class'=>'caption')); ?>
        <?php echo $form->dropDownList($calculator,'capacity', $model->capacitiesListBoxArray); ?>
    <?php endif;?>
    
    <div class="row">
        <?php echo $form->labelEx($calculator,'unit_cost', array('class'=>'caption')); ?>
        <?php echo $form->textField($calculator,'unit_cost',array('size'=>10,'maxlength'=>10)); ?>
        <?php echo $form->error($calculator,'unit_cost'); ?>
    </div>
    
    <?php if(count($model->capacitiesListBoxArray)==0):?>
            <div class="row">
                <?php echo $form->labelEx($calculator,'price_discount', array('class'=>'caption')); ?>
                <?php echo $form->dropDownList($calculator,'price_discount', $model->discountsListBoxArray); ?>
            </div>
    
    <?php else:?>
            <div class="row">
            <table>
                <tr>
                    <td width="30%">
                        <?php echo $form->labelEx($calculator,'unit_weight', array('class'=>'caption')); ?>
                        <?php echo $form->textField($calculator,'unit_weight',array('size'=>10,'maxlength'=>10)); ?>
                        <?php if ($model) echo " (" .$model->weight_in . ")";?>
                        <?php echo $form->error($calculator,'unit_weight'); ?>
                    </td>
                    <td>
                        <lable class="caption">Total Weight</label><br/>
                        <input id="QuoteCalculatorForm_total_weight" type="text" readonly="readonly" size="10" maxlength="10" />
                        <?php if ($model) echo " (" .$model->weight_in . ")";?>
                    </td>
                </tr>
            </table>           
            </div>

            <?php if($model->imprint!==null && count($model->imprint->areasArray)>0):?>
            <div class="row">
                <span class="caption">Printing Options</span>
                <ul class="printing">
                    <?php $methods = $model->imprint->printingModels;?>
                    <?php foreach($model->imprint->areasArray as $area):?>
                    <li>                
                        <span class="area-name"><?=$area?></span>                        
                        <select name="QuoteCalculatorForm[areas][<?=$area?>]">
                            <option value="0"
                                <?php if($calculator->areas[$area]==0) echo 'selected="selected"'; ?>                            
                            >No Printing</option>
                            <?php
                            foreach($methods as $method) {
                                foreach($method->colors as $color) {
                                    if ($color->colors >0) {
                                        echo '<option value="'.$color->printing_id.'_'.$color->colors.'"';
                                        if($calculator->areas[$area]==$color->printing_id.'_'.$color->colors) echo 'selected="selected"';
                                        echo '>'.$color->colors.' color';
                                        if ($color->colors >1) echo 's';
                                        echo ' '.$method->name.'</option>';
                                    } else {
                                        echo '<option value="'.$color->printing_id.'_0"';
                                        if($calculator->areas[$area]==$color->printing_id.'_0') echo 'selected="selected"';
                                        echo '>'.$method->name.'</option>';
                                    }
                                }
                            } ?>                    
                        </select>                
                    </li>
                    <?php endforeach;?>
                </ul>
            </div>
            <?php endif;?>

            <div class="row">
                <span class="caption">Pay by</span><br/>
                <select name="QuoteCalculatorForm[paymentMethod]">
                    <option value="ccard">Credit Card</option>
                    <option value="check">Check</option>
                </select>
            </div>
    <?php endif;?>
    
    <div class="paragraph"></div>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Calculate'); ?>
    </div>
    <?php $this->endWidget(); ?>
    
    <div class="row results">
        <span class="caption">Calculation Results</span>
        <div class="results-output">
            <?=$calculator->result;?>
        </div>
    </div>
</div>