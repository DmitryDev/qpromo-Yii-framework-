<?php
/* @var $this PageController */
/* @var $data Page */
?>

<div class="view">
    
	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->name), array('view', 'id'=>$data->id)); ?>	
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('slug')); ?>:</b>
	<?php echo CHtml::encode($data->slug); ?>
	<br />
    
    <b><?php echo CHtml::encode($data->getAttributeLabel('url')); ?>:</b>
	<?php echo CHtml::encode($data->url); ?>
	<br />
    
    <b><?php echo CHtml::encode($data->getAttributeLabel('is_published')); ?>:</b>
	<?php echo CHtml::encode($data->is_published); ?>
	<br />
	
    <b><?php echo CHtml::encode($data->getAttributeLabel('logged_in')); ?>:</b>
	<?php echo CHtml::encode($data->logged_in); ?>
	<br />

</div>