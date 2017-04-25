<?php
/* @var $this PageController */
/* @var $model PageSectionItem */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'section-item-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
        
    
    <?php if ($size = $model->fileSize):?>
    <div class="row">
        File uploaded. Size: <?=$model->translateFileSize($size)?>
        <span style="margin-left: 20px;"><input type="checkbox" name="PageSectionItem[deleteFile]" style="position: relative; top: 2px;"/> Delete</span>
    </div>
    <?php endif;?>
    
    <div class="row">
        <?php echo CHtml::label('Upload a new file', '', array('style'=>'font-weight: bold;')); ?>
        <small>Note: file size must be <16Mbytes. For larger file uploading ask your system administrator.</small><br/>
        <?php echo CHtml::fileField('PageSectionItem[file]', '', array('id'=>'file'));?>
        <?php echo $form->error($model,'imageUploader'); ?>
    </div>    
    
	<div class="row">
		<?php echo $form->labelEx($model,'spec'); ?>
        <span>Note: specification must be a SHORT string < 256 symbols including HTML tags.</span>
		<?php $this->widget('ext.ckeditor.CKEditorWidget',array(
                        "model"=>$model,                 # Data-Model
                        "attribute"=>'spec',          # Attribute in the Data-Model
                        "defaultValue"=>$model->spec,     # Optional

                        # Additional Parameter (Check http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.config.html)
                        "config" => array(
                            "height"=>"400px",
                            "width"=>"100%",
                            "toolbar"=>"Full",
                            ),

                        #Optional address settings if you did not copy ckeditor on application root
                        "ckEditor" => Yii::app()->basePath . "/../html_public/ckeditor/ckeditor.php",
                        
                        # Path to ckeditor.php
                        "ckBasePath" => Yii::app()->baseUrl."/ckeditor/",
                        # Realtive Path to the Editor (from Web-Root)
        )); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php $this->widget('ext.ckeditor.CKEditorWidget',array(
                        "model"=>$model,                 # Data-Model
                        "attribute"=>'content',          # Attribute in the Data-Model
                        "defaultValue"=>$model->content,     # Optional

                        # Additional Parameter (Check http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.config.html)
                        "config" => array(
                            "height"=>"400px",
                            "width"=>"100%",
                            "toolbar"=>"Full",
                            ),

                        #Optional address settings if you did not copy ckeditor on application root
                        "ckEditor" => Yii::app()->basePath . "/../html_public/ckeditor/ckeditor.php",
                        
                        # Path to ckeditor.php
                        "ckBasePath" => Yii::app()->baseUrl."/ckeditor/",
                        # Realtive Path to the Editor (from Web-Root)
        )); ?>		
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->