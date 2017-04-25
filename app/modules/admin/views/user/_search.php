<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
	
    <div class="row">
		<?php echo $form->label($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>32,'maxlength'=>32)); ?>
	</div>
    
	<div class="row">
		<?php echo $form->label($model,'first_name'); ?>
		<?php echo $form->textField($model,'first_name',array('size'=>32,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'last_name'); ?>
		<?php echo $form->textField($model,'last_name',array('size'=>32,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>32,'maxlength'=>64)); ?>
	</div>

    <div class="row">
		<?php echo $form->label($model,'company'); ?>
		<?php echo $form->textField($model,'company',array('size'=>32,'maxlength'=>64)); ?>
	</div>        
    
	<div class="row">
		<?php echo $form->label($model,'phone'); ?>
		<?php echo $form->textField($model,'phone'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'industry_asi'); ?>
		<?php echo $form->textField($model,'industry_asi',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'industry_asi'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'industry_ppai'); ?>
		<?php echo $form->textField($model,'industry_ppai',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'industry_ppai'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'industry_sage'); ?>
		<?php echo $form->textField($model,'industry_sage',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'industry_sage'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'industry_upic'); ?>
		<?php echo $form->textField($model,'industry_upic',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'industry_upic'); ?>
	</div>
                
    <div class="row">
		<?php echo $form->label($model,'created_at'); ?>
		<?php echo $form->dateField($model,'created_at'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->label($model,'updated_at'); ?>
		<?php echo $form->dateField($model,'updated_at'); ?>
	</div>        
    
    <div class="row">
		<?php echo $form->labelEx($model,'is_banned'); ?>
		<?php echo $form->dropDownList($model,'is_banned', array('no'=>'No', 'yes'=>'Yes')); ?>		
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->