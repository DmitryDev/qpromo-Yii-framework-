<style type="text/css">
<!--
	div.images {
		margin-top: 10px;
	}
    
    div.description {
        text-align: justify;
        padding-top:2px;
        padding-left:10px;
        width: 645px;
        
    }
    div.images {
    	margin-left: 50px;
    	text-align: center;
    } 
    div.images img {
        /*margin-right: 30px;
        margin-bottom: 10px;
        margin-top: 10px;
        margin-left:40px;*/
    	    	    
    }
        
    div.color {
        border: 1px solid black;
        border-radius: 2px;
        height: 10px;
        width: 10px;        
        display: inline-block;
        margin-left: 10px;
    }
    div.size_spec {
        display: inline;
        margin-left: 10px;        
        width: auto;
    }
    
    table.specification {
        width: 100%;
        padding-top:18px;        
    }
    
    table.specification td {
        width: 50%;
        vertical-align: text-top;
    }
    div.method-name {
        display: inline;
        margin-left: 5mm;
    }    
	
	h1 {color: #000033}
	h2 {color: #000055}
	h3 {color: #000033; margin-bottom: 2px;margin-left:10px;}
		
-->
</style>
	<div id="printfriendlybg">
			<!-- a href="http://www.qpromo.com/"><img src="http://www.qpromo.com/images/global/print-logo-1.jpg" style="border:none;"/></a-->
			<img src="/images/header_popup.png" alt="">
			<? //=CHtml::link(CHtml::image("/images/header_new.png", array('width' => 800,'height' => 124 )), array('site/index')); ?>
			<?php //array('width' => 938,'height' => 124 )?>
			<a id="printa" href="#" onClick="window.print()">
				<div class="print_link">Print</div>
			</a>
		</div>
	 
	 
	<div class="images">
        <?php $counter = 0;?>
        <?php foreach($model->product_images as $image): ?>
        	
            <?php if ($image!== null): ?>                
                <img src="<?=Yii::app()->params['productImagesPath'] . $image->large?>" class="product-image" />                
                <?php if (++$counter == 2) break; ?>
            <?php endif; ?>
        <?php endforeach; ?>
	</div>
	<div class="description"><?=$model->description?></div>
    
    <table class="specification">
        <tr>
            <td>
            <?php //$this->renderPartial('_specification', array('product'=>$product));?>
                <h3>Product Specs:</h3>
    <div style="margin-left:10px;">Model #: <?=$model->model_number?></div>
    <?php if(count($model->capacities)>0 && ($model->capacities[0]->capacity>0)):?>
    <div style="margin-left:10px;">Capacities: 
            <?php foreach($model->capacities as $key=>$capacity):?>
            <?= ($capacity->capacity>0)? Capacity::translateCapacity($capacity->capacity) : '';?>
            <?php if(count($model->capacities) > ($key+1)) echo ', ';?>
            <?php endforeach;?>
    </div>
    <?php endif;?>
    
    <?php if (count($model->colorsArray)): ?>
    <div style="margin-left:10px;">Available Colors: 
    <?php foreach($model->colorsArray as $color): ?>
    	<?php if (!empty($color)): ?>
                <div class="color" style="background-color: #<?=$color?>;"></div>
        <?php endif;?>
    <?php endforeach; ?>
    </div>
    <?php endif; ?>    
    
    <?php if($model->custom_color=='yes'): ?>
        <div style="margin-left:10px;">Custom Colors Available: yes</div>
    <?php endif ?>
        
    <?php if($model->width>0 || $model->length>0 || $model->height>0 || $model->diameter>0):?>
    <div style="margin-left:10px;">Physical Size:
        <?php $size_in = ($model->size_in=='in')?'"':$model->size_in?>
        <?php if($model->width>0): ?>
        <div class="size_spec"><?=number_format($model->width,2).' '.$size_in?>(w)</div>
        <?php if($model->length>0 || $model->height>0 || $model->diameter>0) echo '&times;'?>
        <?php endif; ?>
        <?php if($model->length>0): ?>
        <div class="size_spec"><?=number_format($model->length,2).' '.$size_in?>(l)</div>
        <?php if($model->height>0 || $model->diameter>0) echo '&times;'?>
        <?php endif; ?>
        <?php if($model->height>0): ?>
        <div class="size_spec"><?=number_format($model->height,2).' '.$size_in?>(h)</div>
        <?php if($model->diameter>0) echo '&times;'?>
        <?php endif; ?>
        <?php if($model->diameter>0): ?>
        <div class="size_spec"><?=number_format($model->diameter,2).' '.$size_in?>(d)</div>        
        <?php endif; ?>
    </div>
    <?php endif;?>
        
    <?php if($model->weight>0): ?>
        <div style="margin-left:10px;">Weight: <?=number_format($model->weight,3).' '.$model->weight_in?></div>
    <?php endif; ?>    
            </td>
            <td>
            <?php //$this->renderPartial('_imprint', array('product'=>$product));?>
            <?php if($model->imprint !== null):?>

<h3>Customization Options:</h3>
<?php if (!empty($model->imprint->areas)):?>
<div style="padding-left:12px;">Printing Areas: <?=$model->imprint->areas?>
</div>
<?php endif;?>

<?php if($model->imprint->width>0 || $model->imprint->height>0):?>
    <div style="padding-left:12px;">Area Size:
        <?php if($model->imprint->width>0): ?>
        <div class="size_spec"><?=number_format($model->imprint->width,2).'"'?></div>
        <?php if($model->imprint->height>0) echo '&times;'?>
        <?php endif; ?>
        <?php if($model->imprint->height>0): ?>
        <div class="size_spec"><?=number_format($model->imprint->height,2).'"'?></div>
        <?php endif; ?>
    </div>
<?php endif;?>

<?php if(!empty($model->imprint->printings)):?>
<div style="padding-left:12px;">Printing Methods:
    <?php foreach($model->imprint->printingModels as $method):?>
    <div class="method-name"><?=$method->name;?></div>
    <?php endforeach;?>
</div>
<?php endif;?>

<?php endif; ?>
            </td>
            
        </tr>
    </table>
	  
	  
	  
		
		 