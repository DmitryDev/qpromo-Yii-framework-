<ul class="image-list">
<?php foreach($images as $img):?>    
    <li class="image-list-item">    
    <div><?php echo CHtml::image(Yii::app()->params['productImagesPath']. $img->small); ?></div>
    <div class="image-list-controls">
    <?php if ($editable):?>
        <?php $checked = ($img->product->main_image_id === $img->id)?true:false; ?>        
        <?php echo CHtml::radioButton('defaultImage', $checked, array('value'=>$img->id)); ?>
        <span>Make Default</span><br />
        <?php echo CHtml::checkBox('deleteImage[' . $img->id .']'); ?>
        <span>Delete</span>
    <?php else: ?>        
        <?php if ($img->product->main_image_id === $img->id): ?>        
        <img src="<?php echo $checkedIcon; ?>" class="default-image" />
        <span>Default Image</span>
        <?php endif; ?>
    <?php endif;?>
    </div>    
    </li>
<?php endforeach; ?>
</ul>