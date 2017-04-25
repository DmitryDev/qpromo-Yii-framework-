<?php
/* @var $this UserController */
/* @var $model UserEntryForm */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-entry-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
    <div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'first_name'); ?>
		<?php echo $form->textField($model,'first_name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_name'); ?>
		<?php echo $form->textField($model,'last_name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'last_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>45,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'company'); ?>
		<?php echo $form->textField($model,'company',array('size'=>45,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'company'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'phone'); ?>
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

    <div class="row isAdmin">               
        <?php echo $form->checkBox($model, 'is_admin');?>
        <?php echo $form->labelEx($model,'is_admin');?>           
        <?php echo $form->error($model,'is_admin'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'is_banned'); ?>
		<?php echo $form->dropDownList($model,'is_banned', array('no'=>'No', 'yes'=>'Yes')); ?>
		<?php echo $form->error($model,'is_banned'); ?>
	</div>

        
	<div class="row buttons">
		<?php echo CHtml::submitButton(!$model->userExists()? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->