<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>        

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>32,'maxlength'=>128)); ?>
	</div>
    
    <div class="row">
		<?php echo $form->label($model,'model_number'); ?>
		<?php echo $form->textField($model,'model_number',array('size'=>32,'maxlength'=>32)); ?>
	</div>
    
    <div class="row">
		<?php echo $form->label($model,'tags'); ?>
		<?php echo $form->textField($model,'tags',array('size'=>32,'maxlength'=>32)); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'is_published'); ?>
		<?php echo $form->dropDownList($model,'is_published', array('no'=>'No', 'yes'=>'Yes')); ?>		
	</div>    	

	<div class="row">
		<?php echo $form->label($model,'release_date'); ?>
		<?php echo $form->dateField($model,'release_date'); ?>        
	</div>
		
	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->