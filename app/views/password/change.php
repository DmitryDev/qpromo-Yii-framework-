<div class="form" style="margin: 0 auto; width: 900px; min-width: 1280px; padding: 80px 0;">
<?php $form=$this->beginWidget('CActiveForm', array(
                                    'id'=>'password-entry-form',
                                    'enableClientValidation'=>true,
                                    'clientOptions'=>array('validateOnSubmit'=>true)                                            
                                ));
?>
    <h1 style="margin: 0 0 20px;">Update Password</h1>
	<p class="note" style="margin: 0 0 20px;">Hi, <strong><?=$user->first_name?></strong>! Enter and confirm you new password.</p>

	<?php //echo $form->errorSummary($model); ?>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>45,'maxlength'=>45, 'value'=>'')); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'password_repeat'); ?>
		<?php echo $form->passwordField($model,'password_repeat',array('size'=>45,'maxlength'=>45, 'value'=>'')); ?>
		<?php echo $form->error($model, 'password_repeat'); ?>
	</div>

    <div class="control-group buttons centered">
		<?php echo CHtml::submitButton('Update Password', array('class'=>'btn btn-go')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
