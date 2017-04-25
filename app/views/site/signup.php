<div class="form" style="margin: 150px 300px;">
<?php $form=$this->beginWidget('CActiveForm', array(
                                    'id'=>'signup-form-nojs',
                                    'enableClientValidation'=>false,
                                    'clientOptions'=>array('validateOnSubmit'=>true)
                            )); 
?>
    <div class="row">
    <h1><?=  CHtml::link('Log In', Yii::app()->createUrl('site/login'))?> / Sign Up</h1>
    <p>Please fill out the following form with your login credentials:<br/>
	<em class="note">(fields with <span class="required">*</span> are required)</em>
    </p>
    </div>
	<div class="row">
		<?php echo $form->labelEx($model,'first_name'); ?>
		<?php echo $form->textField($model,'first_name'); ?>
		<?php echo $form->error($model,'first_name'); ?>
	</div>
    <div class="row">
		<?php echo $form->labelEx($model,'last_name'); ?>
		<?php echo $form->textField($model,'last_name'); ?>
		<?php echo $form->error($model,'last_name'); ?>
	</div>
    <div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
    <div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone'); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>
    <div class="row">
		<?php echo $form->labelEx($model,'company'); ?>
		<?php echo $form->textField($model,'company'); ?>
		<?php echo $form->error($model,'company'); ?>
	</div>
    <div class="row">
		<?php echo $form->labelEx($model,'industry_asi'); ?>
		<?php echo $form->textField($model,'industry_asi'); ?>
		<?php echo $form->error($model,'industry_asi'); ?>
	</div>
    <div class="row">
		<?php echo $form->labelEx($model,'industry_ppai'); ?>
		<?php echo $form->textField($model,'industry_ppai'); ?>
		<?php echo $form->error($model,'industry_ppai'); ?>
	</div>
    <div class="row">
		<?php echo $form->labelEx($model,'industry_sage'); ?>
		<?php echo $form->textField($model,'industry_sage'); ?>
		<?php echo $form->error($model,'industry_sage'); ?>
	</div>
    <div class="row">
		<?php echo $form->labelEx($model,'industry_upic'); ?>
		<?php echo $form->textField($model,'industry_upic'); ?>
		<?php echo $form->error($model,'industry_upic'); ?>
	</div>
    <div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>
    <div class="row">
        <?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>		
	</div>
    <div class="row">
        <?php echo $form->labelEx($model,'password_repeat'); ?>
		<?php echo $form->passwordField($model,'password_repeat'); ?>
		<?php echo $form->error($model,'password_repeat'); ?>		
	</div>
        
	<div class="row buttons centered">
		<?php echo CHtml::submitButton('Sign Up'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
