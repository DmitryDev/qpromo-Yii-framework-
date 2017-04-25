<?php
/* @var $this CapacityController */
/* @var $model Capacity */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'capacity-form',
	'enableAjaxValidation'=>true    
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>    

	<div class="row">
		<?php echo $form->labelEx($model,'formEntry'); ?>
		<?php echo $form->textField($model,'formEntry'); ?>
		<?php echo $form->error($model,'formEntry'); ?>
	</div>    
    <div class="row">
        <?php echo $form->labelEx($model,'units', array('class'=>'caption')); ?>
        <?php echo $form->dropDownList($model,'units', $model->unitsListBoxArray); ?>
    </div>
    
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->