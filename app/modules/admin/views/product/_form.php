<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */
?>
<div class="product-tool">
    <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'product-form',
                'enableAjaxValidation'=>false,
                'htmlOptions'=>array('enctype'=>'multipart/form-data'),
    )); ?>
    
    <div class="product-section">
        <div class="form product-form form-section">           
            <p class="note">Fields with <span class="required">*</span> are required.</p>            
            <?php echo $form->errorSummary($model); ?>
            
            <div class="row">
                <?php echo $form->labelEx($model,'name'); ?>
                <?php echo $form->textField($model,'name',array('size'=>47,'maxlength'=>128)); ?>
                <?php echo $form->error($model,'name'); ?>
            </div>
            
            <div class="row">
                <?php echo $form->labelEx($model,'model_number'); ?>
                <?php echo $form->textField($model,'model_number',array('size'=>47,'maxlength'=>32)); ?>
                <?php echo $form->error($model,'model_number'); ?>
            </div>
            
            <div class="row">
                <?php echo $form->labelEx($model,'description'); ?>
                <?php echo $form->textArea($model,'description',array('rows'=>15, 'cols'=>65)); ?>
                <?php echo $form->error($model,'description'); ?>
            </div>
            
            <div class="row">
                <?php echo $form->labelEx($model,'tags', array('style'=>'display:inline;')); ?>
                <small><em>(Comma separated list of keywords)</em></small><br/>
                <?php echo $form->textArea($model,'tags',array('rows'=>2, 'cols'=>65)); ?>
                <?php echo $form->error($model,'tags'); ?>
            </div>
                        
        </div>    
        
        <div class="row" style="display: inline-block;">
                <div class="span-4">                    
                    <?php echo $form->labelEx($model,'is_published', array('class'=>'caption')); ?>
                    <?php echo $form->dropDownList($model,'is_published', array('no'=>'No', 'yes'=>'Yes')); ?>
                </div>
                
                <?php if(!$model->isNewRecord):?>
                <div class="span-4">
                	                    
                    <?php
                    if($model->is_new == 1){ 
                    	echo $form->checkBox($model, 'isNewRelease', array('class'=>'span-1', 'checked'=>'checked'));
                    } else{
                    	echo $form->checkBox($model, 'isNewRelease', array('class'=>'span-1'));
                    }?>
                    <?php echo $form->labelEx($model,'isNewRelease', array('class'=>'caption')); ?>
                    <?php echo $form->error($model,'is_NewRelease'); ?>
                </div>
                <?php endif; ?>
        </div>
        
        <div class="row form-section">
            <div class="row paragraph">
            	<span style="display:inline-block;">
                    <?php echo $form->labelEx($model,'length', array('class'=>'caption')); ?><br/>
                    <?php echo $form->textField($model,'length',array('size'=>9,'maxlength'=>9)); ?>                    
                </span>
                &times;
                <span style="display:inline-block;">
                    <?php echo $form->labelEx($model,'width', array('class'=>'caption')); ?><br/>
                    <?php echo $form->textField($model,'width',array('size'=>9,'maxlength'=>9)); ?>                    
                </span>
                &times;
                <span style="display:inline-block;">                    
                    <?php echo $form->labelEx($model,'height', array('class'=>'caption')); ?><br/>
                    <?php echo $form->textField($model,'height',array('size'=>9,'maxlength'=>9)); ?>                    
                </span>
                &times;
                <span style="display:inline-block;">
                    <?php echo $form->labelEx($model,'diameter', array('class'=>'caption')); ?><br/>
                    <?php echo $form->textField($model,'diameter',array('size'=>9,'maxlength'=>9)); ?>                    
                </span>
                <span style="display:inline-block;">
                    <?php echo $form->labelEx($model,'size_in', array('class'=>'caption')); ?><br/>
                    <?php echo $form->dropDownList($model,'size_in', $model->sizeUnits); ?>                    
                </span>                
                <?php if(count($model->errors)): ?>
                <div>
                    <br/>
                    <?php echo $form->error($model,'length'); ?>
                    <?php echo $form->error($model,'width'); ?>
                    <?php echo $form->error($model,'height'); ?>
                    <?php echo $form->error($model,'diameter'); ?>
                    <?php echo $form->error($model,'size_in'); ?>
                    <br/>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="row paragraph">
                <span style="display:inline-block;">
                    <?php echo $form->labelEx($model,'weight', array('class'=>'caption')); ?><br/>
                    <?php echo $form->textField($model,'weight',array('size'=>12,'maxlength'=>12)); ?>                                        
                </span>                
                <span style="display:inline-block;">
                    <?php echo $form->labelEx($model,'weight_in', array('class'=>'caption')); ?><br/>
                    <?php echo $form->dropDownList($model,'weight_in', $model->weightUnits); ?>                    
                </span>                                                
                <?php echo $form->error($model,'weight'); ?>
            </div>
        </div>
    
        <div class="row form-section paragraph">
            <?php echo $form->labelEx($model,'custom_color', array('class'=>'caption')); ?>
            <?php echo $form->dropDownList($model,'custom_color', array('no'=>'No', 'yes'=>'Yes')); ?>
            <?php echo $form->error($model,'custom_color'); ?>            
        </div>

        <div class="row product-colors">
            <?php if (count($colors)):?>            
            <?php echo $form->label($model,'colors', array('class'=>'caption')); ?>                            
            <?php endif; ?>
            
            <?php if(!$model->isNewRecord): ?>
            <div>
                <?php foreach($colors as $index=>$color):?>
                <?php if (empty($color)) continue;?>
                <div class="color-item">
                    <span class="color-marker" style="background-color: #<?=$color?>;">&nbsp</span>
                    <span class="delete-control"> 
                        <?php echo CHtml::hiddenField("Product[color][$index][value]", $color)?>
                        <?php echo CHtml::checkBox("Product[color][$index][delete]"); ?>
                        <?php echo CHtml::label('Delete', "Product[color][$index][delete]"); ?>
                    </span>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>            
            
        </div>
        
        <div class="row new-product-colors"></div>
        
        <div class="add-color">
                <?php echo CHtml::label('Add Color', "Product[newColor]", array('class'=>'caption')); ?><br/>                
                <input type="text" name="Product[newColor]" class="cp-basic"
                       value="" autocomplete="off" placeholder="Click here to pick up a color..." /><br/>
                <small><em>(Just clear the field if you don't want to add selected color)</em></small>
        </div>
       
        <!--div class="row form-section product-capacities paragraph">
            <?php if (count($model->capacities)):?>
            <?php echo CHtml::label('Capacities', "", array('class'=>'caption')); ?>  
            <div>
                <?php foreach($model->capacities as $index=>$productCapacity):?>                
                <div class="product-capacity">
                    <span class="capacity-value"><?=$this->translateCapacity($productCapacity->capacity)?></span>
                    <span class="delete-control">                    
                        <?php echo CHtml::hiddenField("Product[capacity][$index][value]", $productCapacity->capacity)?>
                        <?php echo CHtml::checkBox("Product[capacity][$index][delete]"); ?>
                        <?php echo CHtml::label('Delete', "Product[capacity][$index][delete]"); ?>
                    </span>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div-->
        
        <!--div class="row new-product-capacities"></div>
        
        <div class="add-capacity">
                <?php echo CHtml::label('Add Capacity', "newCapacity", array('class'=>'caption')); ?>
                <?php echo CHtml::dropDownList('newCapacity','', $capacities); ?>
        </div-->
        
        <div class="row form-section">
                <strong><?php echo $form->labelEx($model,'category');?></strong><br/>
                <em>(Multiple categories can be assigned to a product. Just click on a category name to assign/deassign it.)</em>                
                <?php $this->widget('CategoriesTree', array('model'=>$model, 'editable'=>true))?>
        </div>
            
        <div class="product-images form-section">
            <div class="row">
                <?php if (count($model->product_images)):?>
                <div style="margin-top: 15px;">
                    <?php echo  CHtml::label('Product Images', 'Product_images', array('style'=>'font-weight: bold;')); ?>         
                    <?php $this->widget('ImagesList', array('images' => $model->product_images, 'editable'=>true)); ?>                    
                </div>
                <?php endif;?>
            </div>

            <div class="row view-section">
                <?php echo $form->labelEx($model,'uploadedImages', array('style'=>'font-weight: bold;')); ?>
                <?php $this->widget('ImageUploader', array('model' => $model))?>            
            </div>
        </div>
        
        <div class="product-pricing form-section">
        	 <div class="row paragraph">
        	 	 <?php if(!$model->isNewRecord): ?>
        	 	 <span style="display:inline-block;">
                <?php echo CHtml::label('Sample Price', 'sample_price', array('class'=>'caption')); ?><br/>
                <?php echo CHtml::textField('sample_price', $model->sample_price, array('size'=>12,'maxlength'=>12)); ?>                                        
                </span>
                <?php else: ?>
        	 	<?php echo CHtml::label('Sample Price', 'sample_price', array('class'=>'caption')); ?><br/>
                <?php echo CHtml::textField('sample_price', '0.00', array('size'=>12,'maxlength'=>12)); ?>              
                <?php endif; ?>
            </div>
            <div class="row  paragraph">
                <?php echo CHtml::label('Price Code', "priceCode", array('class'=>'caption')); ?><br/>                
                <?php echo CHtml::dropDownList('priceCode',$model->price_code_id, $model->priceCodesArray); ?>                
            </div>            
            <div class="row paragraph">
                <?php echo CHtml::label('Prices Scale', "prices", array('class'=>'caption')); ?>                
                <?php $this->widget('ProductPrices', array('model'=>$model, 'editable'=>true))?>
            </div>
            <!--div class="row paragraph">                
                <?php echo CHtml::label('Prices Scale', "prices", array('class'=>'caption')); ?>
                <table class="existant-prices">
                    <tr>
                        <th  width="50px">Quantity</th>
                        <?php foreach($model->prices as $price):?>
                            <th class="centered"><?=$price->quantity?></br>
                                <?php echo CHtml::checkBox("price[$price->quantity][delete]"); ?>
                                <?php echo CHtml::label('Delete', "Product[$price->quantity][delete]"); ?>
                            </th>
                        <?php endforeach;?>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <?php foreach($model->prices as $price):?>
                            <td class="centered"><?=$price->price?></td>
                        <?php endforeach;?>
                    </tr>
                </table>
            </div-->
            <div class="row">
                <?php echo CHtml::label('Add Prices', "newPrices", array('class'=>'caption')); ?>
                <em>(Leave blank field quantity or price if you don't want to add the column)</me><br/>
                <?php echo CHtml::dropDownList('newCapacity[]','', $capacities,array('class'=>'newCapacity')); ?>
                <div id='capacities_table'>
                <table>
                    <tr>
                        <th>Quantity</th>
                        <td><?php echo CHtml::textField('newPrice[1][quantity][]', '1', array('size'=>4,'maxlength'=>5)); ?></td>
                        <td><?php echo CHtml::textField('newPrice[2][quantity][]', '50', array('size'=>4,'maxlength'=>5)); ?></td>
                        <td><?php echo CHtml::textField('newPrice[3][quantity][]', '100', array('size'=>4,'maxlength'=>5)); ?></td>
                        <td><?php echo CHtml::textField('newPrice[4][quantity][]', '250', array('size'=>4,'maxlength'=>5)); ?></td>
                        <td><?php echo CHtml::textField('newPrice[5][quantity][]', '500', array('size'=>4,'maxlength'=>5)); ?></td>
                        <td><?php echo CHtml::textField('newPrice[6][quantity][]', '1000', array('size'=>4,'maxlength'=>5)); ?></td>
                        <td><?php echo CHtml::textField('newPrice[7][quantity][]', '2500', array('size'=>4,'maxlength'=>5)); ?></td>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <td><?php echo CHtml::textField('newPrice[1][price][]', '', array('size'=>4,'maxlength'=>5)); ?></td>
                        <td><?php echo CHtml::textField('newPrice[2][price][]', '', array('size'=>4,'maxlength'=>5)); ?></td>
                        <td><?php echo CHtml::textField('newPrice[3][price][]', '', array('size'=>4,'maxlength'=>5)); ?></td>
                        <td><?php echo CHtml::textField('newPrice[4][price][]', '', array('size'=>4,'maxlength'=>5)); ?></td>
                        <td><?php echo CHtml::textField('newPrice[5][price][]', '', array('size'=>4,'maxlength'=>5)); ?></td>
                        <td><?php echo CHtml::textField('newPrice[6][price][]', '', array('size'=>4,'maxlength'=>5)); ?></td>
                        <td><?php echo CHtml::textField('newPrice[7][price][]', '', array('size'=>4,'maxlength'=>5)); ?></td>                        
                    </tr>
                </table>
                </div>
                <?php echo CHtml::button('Add Capacity', array('id'=>'product_add_capacity')); ?>
                <?php echo CHtml::button('Remove Capacity', array('id'=>'product_remove_capacity')); ?>
                <script type="text/javascript">
                $(document).ready(function() {
            		$('#product_add_capacity').click(function(){
                	$('#product_remove_capacity').css('display','block');
                	var add_capacity = '<div class="new_capacities"><select name="newCapacity[]" class="newCapacity">' + $('#newCapacity').html() + '</select>' + $('#capacities_table').html() +'</div>';
            		$('#capacities_table').after(add_capacity);
            		});
            		$('#product_remove_capacity').click(function(){
                		$('.new_capacities').last().remove();
            		});
            	});
                </script>
            </div>
        </div>
        
        <div class="product-imprint form-section">
            <div class="row paragraph">
                <?php echo CHtml::label('Imprint Available', 'imprintAvailable', array('class'=>'caption')) ?>
                <?php echo CHtml::checkBox('imprintAvailable', $model->imprint !== null); ?>
                <em><small>(Warning! Unchecked control clears imprinting information in case of saving.)</small></em>
            </div>
            <div class="row paragraph">
                <span style="display:inline-block;">                
                    <?php echo CHtml::label('Width (inch)', 'imprintWidth', array('class'=>'caption')); ?><br/>
                    <?php echo CHtml::textField('imprintWidth', $model->imprint->width, array('size'=>9,'maxlength'=>9)); ?>                    
                </span>
                &times;
                <span style="display:inline-block;">                    
                    <?php echo CHtml::label('Height (inch)', 'imprintHeight', array('class'=>'caption')); ?><br/>
                    <?php echo CHtml::textField('imprintHeight', $model->imprint->height, array('size'=>9,'maxlength'=>9)); ?>
                </span>
            </div>
            <div class="row paragraph">
                <?php echo CHtml::label('Areas (semicolon separated list)', 'imprintAreas', array('class'=>'caption')); ?><br/>
                <?php echo CHtml::textField('imprintAreas', $model->imprint->areas, array('size'=>64,'maxlength'=>128)); ?>
            </div>
            
            <div class="row"> 
                <?php foreach(Printing::model()->findAll() as $method): ?>
                <span class="printing-method">
                    <?php echo CHtml::label($method->name, 'imprintMethod['.$method->id. ']') ?>
                    <?php if(in_array($method->id, split(',', $model->imprint->printings))):?>
                    <?php echo CHtml::checkBox('imprintMethod['.$method->id. ']', true); ?>
                    <?php else: ?>
                    <?php echo CHtml::checkBox('imprintMethod['.$method->id. ']'); ?>
                    <?php endif; ?>
                </span>
                <?php endforeach; ?>
            </div>
        </div>
        
        <div class="product-accessories form-section">
            <div class="row"> 
                <div class="caption">Accessories</div>
                <?php foreach(Accessory::model()->findAll() as $accessory): ?>
                <span class="accessory" style="display: inline-block;margin: 0 50px 50px 0;">
                    <div><?php echo CHtml::image(Yii::app()->params['accessoriesImagePath']. $accessory->small) ?></div>
                    <div><?php echo CHtml::label($accessory->name, 'accessory['.$accessory->id. ']') ?>                    
                        <?php if(in_array($accessory->id, split(',', $model->productAccessories->accessories))):?>
                        <?php echo CHtml::checkBox('accessory['.$accessory->id. ']', true); ?>
                        <?php else: ?>
                        <?php echo CHtml::checkBox('accessory['.$accessory->id. ']'); ?>
                        <?php endif; ?>
                    </div>
                </span>
                <?php endforeach; ?>
            </div>
        </div>
        
        <div class="product-preloaded form-section">
            <div class="row"> 
                <div class="caption">Preloaded Data</div>
                <?php foreach(Preloaded::model()->findAll() as $preloaded): ?>
                <span class="preloaded" style="display: inline-block;margin: 0 50px 50px 0;">
                    <div><?php echo CHtml::image(Yii::app()->params['preloadedImagePath']. $preloaded->small) ?></div>
                    <div><?php echo CHtml::label($preloaded->name, 'preloaded['.$preloaded->id. ']') ?>                    
                        <?php if(in_array($preloaded->id, split(',', $model->productPreloaded->preloaded))):?>
                        <?php echo CHtml::checkBox('preloaded['.$preloaded->id. ']', true); ?>
                        <?php else: ?>
                        <?php echo CHtml::checkBox('preloaded['.$preloaded->id. ']'); ?>
                        <?php endif; ?>
                    </div>
                </span>
                <?php endforeach; ?>
            </div>
        </div>
        
        <div class="product-packaging form-section">
            <div class="row"> 
                <div class="caption">Packaging</div>
                <?php foreach(Packaging::model()->findAll() as $packaging): ?>
                <span class="packaging" style="display: inline-block;margin: 0 50px 50px 0;">
                    <div><?php echo CHtml::image(Yii::app()->params['packagingImagePath']. $packaging->small) ?></div>
                    <div><?php echo CHtml::label($packaging->name, 'packaging['.$packaging->id. ']') ?>                    
                        <?php if(in_array($accessory->id, split(',', $model->productAccessories->accessories))):?>
                        <?php echo CHtml::checkBox('packaging['.$packaging->id. ']', true); ?>
                        <?php else: ?>
                        <?php echo CHtml::checkBox('packaging['.$packaging->id. ']'); ?>
                        <?php endif; ?>
                    </div>
                </span>
                <?php endforeach; ?>
            </div>
        </div>
        

        <div class="row buttons form-section">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Add' : 'Save'); ?>
        </div>
        <?php $this->endWidget(); ?>
        
    </div><!-- class="product-section" -->
</div>


