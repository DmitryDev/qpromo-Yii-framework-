<?php
/* @var $this SpecialsController */
/* @var $model Specials */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'specials-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>    

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'link'); ?>
		<?php echo $form->textField($model,'link',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'link'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'is_published'); ?>
		<?php echo $form->dropDownList($model,'is_published', array('yes'=>'Yes', 'no'=>'No')); ?>
		<?php echo $form->error($model,'is_published'); ?>
	</div>

	<?php if ($model->image):?>
    <div class="row" style="margin-top: 15px;">        
        <?php echo CHtml::checkBox('Specials[deleteImage]'); ?><span>Delete Image</span>
        <div><?php echo CHtml::image(Yii::app()->params['specialsImagePath'].'/'.$model->small); ?></div>        
    </div>
    <?php endif;?>

    <div class="row">
        <?php echo CHtml::label('Upload a new image', '', array('style'=>'font-weight: bold;')); ?>        
        <?php echo CHtml::fileField('Specials[image]', '', array('id'=>'image'));?>               
        <?php echo $form->error($model,'imageUploader'); ?>
    </div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->