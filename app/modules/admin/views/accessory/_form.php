<?php
/* @var $this AccessoryController */
/* @var $model Accessory */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'accessory-form',
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
		<?php echo $form->labelEx($model,'description'); ?>
        <?php echo $form->textArea($model,'description',array('rows'=>15, 'cols'=>65)); ?>
        <?php echo $form->error($model,'description'); ?>
	</div>
        
	<?php if ($model->image):?>
    <div class="row" style="margin-top: 15px;">        
        <?php echo CHtml::checkBox('Accessory[deleteImage]'); ?><span>Delete Accessory</span>
        <div><?php echo CHtml::image(Yii::app()->params['accessoriesImagePath'].'/'.$model->small); ?></div>        
    </div>
    <?php endif;?>

    <div class="row">
        <?php echo CHtml::label('Upload a new image', '', array('style'=>'font-weight: bold;')); ?>
        <?php echo CHtml::fileField('Accessory[image]', '', array('id'=>'image'));?>
        <?php echo $form->error($model,'imageUploader'); ?>
    </div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->