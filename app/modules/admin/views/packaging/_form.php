<?php
/* @var $this PackagingController */
/* @var $model Packaging */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'packaging-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>    

    <div class="row">
		<?php echo $form->labelEx($model,'model_number'); ?>
		<?php echo $form->textField($model,'model_number',array('size'=>60,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'moodel_number'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'customization'); ?>
        <?php echo $form->textArea($model,'customization',array('rows'=>2, 'cols'=>65)); ?>
        <?php echo $form->error($model,'customization'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
        <?php echo $form->textArea($model,'description',array('rows'=>15, 'cols'=>65)); ?>
        <?php echo $form->error($model,'description'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'width'); ?>
		<?php echo $form->textField($model,'width',array('size'=>10,'maxlength'=>10, 'placeholder'=>'inches')); ?>
		<?php echo $form->error($model,'width'); ?>
	</div>
    <div class="row">
		<?php echo $form->labelEx($model,'length'); ?>
		<?php echo $form->textField($model,'length',array('size'=>10,'maxlength'=>10, 'placeholder'=>'inches')); ?>
		<?php echo $form->error($model,'length'); ?>
	</div>
    <div class="row">
		<?php echo $form->labelEx($model,'height'); ?>
		<?php echo $form->textField($model,'height',array('size'=>10,'maxlength'=>10, 'placeholder'=>'inches')); ?>
		<?php echo $form->error($model,'height'); ?>
	</div>    
    <div class="row">
		<?php echo $form->labelEx($model,'diameter'); ?>
		<?php echo $form->textField($model,'diameter',array('size'=>10,'maxlength'=>10, 'placeholder'=>'inches')); ?>
		<?php echo $form->error($model,'diameter'); ?>        
	</div>
    <div class="row">
		<?php echo $form->labelEx($model,'weight'); ?>
		<?php echo $form->textField($model,'weight',array('size'=>10,'maxlength'=>10, 'placeholder'=>'lbs')); ?>
		<?php echo $form->error($model,'weight'); ?>
	</div>
	<?php if ($model->image):?>
    <div class="row" style="margin-top: 15px;">        
        <?php echo CHtml::checkBox('Packaging[deleteImage]'); ?><span>Delete Image</span>
        <div><?php echo CHtml::image(Yii::app()->params['packagingImagePath'].'/'.$model->small); ?></div>        
    </div>
    <?php endif;?>
    <?php if ($model->image2):?>
    <div class="row" style="margin-top: 15px;">        
        <?php echo CHtml::checkBox('Packaging[deleteImage2]'); ?><span>Delete Alternative Image</span>
        <div><?php echo CHtml::image(Yii::app()->params['packagingImagePath'].'/'.$model->small2); ?></div>
    </div>
    <?php endif;?>

    <div class="row">
        <?php echo CHtml::label('Upload a new image', '', array('style'=>'font-weight: bold;')); ?>        
        <?php echo CHtml::fileField('Packaging[image]', '', array('id'=>'image'));?>               
        <?php echo CHtml::label('Upload a new alternative image', '', array('style'=>'font-weight: bold;')); ?>
        <?php echo CHtml::fileField('Packaging[image2]', '', array('id'=>'image2'));?>               
        <?php echo $form->error($model,'imageUploader'); ?>
    </div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->