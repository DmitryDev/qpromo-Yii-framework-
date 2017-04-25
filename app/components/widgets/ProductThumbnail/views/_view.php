<li class="list_item">
    
    <a href="<?=Yii::app()->createUrl('product/view', array('id'=>$model->id))?>" class="thumb">        
        <?php if(($image = $model->defaultImage) !== null):?>
        <?= CHtml::image(Yii::app()->params['productImagesPath'].$image->small); ?>
        <?php endif; ?>
    </a>    

    <div class="title"><?=$model->name?></div>
    
    <?php if(count($model->capacities)==1): ?>
    <div class="desc"><?=  ($model->minCapacity >0) ? Capacity::translateCapacity($model->minCapacity) : ''?></div>
    <?php elseif(count($model->capacities)>1): ?>
    <div class="desc"><?=Capacity::translateCapacity($model->minCapacity)?> - <?=  Capacity::translateCapacity($model->maxCapacity)?></div>
    <? endif; ?>

    <ul class="colors">
        <?php foreach ($model->colorsArray as $color): ?>    
        <li><span class="color" style="background: #<?=$color?>;"></span></li>
        <?php endforeach;?>
    </ul>
    
</li>