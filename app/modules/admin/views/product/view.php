<h1>View product "<?php echo $model->name; ?>"</h1>

<?php $this->widget('zii.widgets.CDetailView', array('data'=>$model, 'attributes'=>$viewAttributes)); ?>

<div class="row paragraph">
</div>

<div class="product-pricing form-section">
			 <div class="row  paragraph">
                <?php echo CHtml::label('Sample Price', "sample_price", array('class'=>'caption')); ?><br/>
                <?php if ($model->sample_price !== null):?>
                <?php echo $modelsample_price .  $model->sample_price ; ?>                
                <?php else: ?>
                N/A
                <?php endif; ?>
            </div>    
            <div class="row  paragraph">
                <?php echo CHtml::label('Price Code', "priceCode", array('class'=>'caption')); ?><br/>
                <?php if ($model->priceCode !== null):?>
                <?php echo $model->priceCode->code . " (" . $model->priceCode->discount . ")"; ?>                
                <?php else: ?>
                N/A
                <?php endif; ?>
            </div>     
            <div class="row paragraph">
            	<?php echo CHtml::label('Prices Scale', "prices", array('class'=>'caption')); ?>                
                <?php $this->widget('ProductPrices', array('model'=>$model, 'editable'=>false))?>
            </div>
            <!--div class="row paragraph">                
                <?php echo CHtml::label('Prices Scale', "prices", array('class'=>'caption')); ?>
                <table class="existant-prices">
                    <tr>
                        <th width="158px">Quantity</th>
                        <?php foreach($model->prices as $price):?>
                            <th class="centered"><?=$price->quantity?></th>
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
</div>

<?php if($model->imprint !== null):?>
<div class="row caption product-imprint  form-section">Imprint Options</div>
<?php $this->widget('zii.widgets.CDetailView', array('data'=>$imprint, 'attributes'=>$imprintAttributes)); ?>
<?php endif; ?>

<div class="row paragraph">
</div>

<?php if($model->productAccessories !== null && !empty($model->productAccessories->accessories)):?>
<div class="row caption product-accessories  form-section">Accessories</div>
<?php foreach($model->productAccessories->accessoryModels as $accessory):?>
<span class="accessory" style="display: inline-block;margin: 0 50px 50px 0;">
    <div><?= CHtml::image(Yii::app()->params['accessoriesImagePath']. $accessory->small) ?></div>
    <div><?=$accessory->name ?>
    </div>
</span>
<?php endforeach;?>
<?php endif; ?>

<div class="row paragraph">
</div>

<?php if($model->productPreloaded !== null && !empty($model->productPreloaded->preloaded)):?>
<div class="row caption product-preloaded  form-section">Preloaded Data</div>
<?php foreach($model->productPreloaded->preloadedModels as $preloaded):?>
<span class="preloaded" style="display: inline-block;margin: 0 50px 50px 0;">
    <div><?= CHtml::image(Yii::app()->params['preloadedImagePath']. $preloaded->small) ?></div>
    <div><?=$preloaded->name ?>
    </div>
</span>
<?php endforeach;?>
<?php endif; ?>

<div class="row paragraph">
</div>

<?php if($model->productPackaging !== null && !empty($model->productPackaging->packaging)):?>
<div class="row caption product-packaging  form-section">Packaging</div>
<?php foreach($model->productPackaging->packagingModels as $pack):?>
<span class="packaging" style="display: inline-block;margin: 0 50px 50px 0;">
	<div><?= CHtml::image(Yii::app()->params['packagingImagePath']. $pack->small) ?></div>
    <div><?=$pack->name ?>
    </div>
</span>
<?php endforeach;?>
<?php endif; ?>

<div class="row paragraph">
</div>

<?php echo CHtml::label('Assigned Category', NULL, array('style'=>'font-weight: bold;'));?>
<?php $this->widget('CategoriesTree', array('model'=>$model))?>

<?php if (count($model->product_images)):?>
<?php $images = array(); 
$model1->product_images = $model->product_images;?>
<?php foreach($model1->product_images as $image):
unset($image->origin);
unset($image->large);
unset($image->huge);
unset($image->full);
                    
endforeach;?>

<div class="row view-section">
    <?php echo CHtml::label('Product Images', 'Product_images', array('style'=>'font-weight: bold;')); ?>         
    <?php $this->widget('ImagesList', array('images' => $model1->product_images, 'editable'=>false)); ?>
</div>
<?php endif;?>