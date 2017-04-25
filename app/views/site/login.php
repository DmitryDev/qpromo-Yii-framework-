<div class="form" style="margin: 150px 300px;">
<?php $form=$this->beginWidget('CActiveForm', array(
                                    'id'=>'login-form-nojs',
                                    'enableClientValidation'=>false,
                                    'clientOptions'=>array('validateOnSubmit'=>true)
                            )); 
?>
    <div class="row">
    <h1>Login / <?=  CHtml::link('Sign Up', Yii::app()->createUrl('site/signup'))?></h1>
    <p>Please fill out the following form with your login credentials:<br/>
	<em class="note">(fields with <span class="required">*</span> are required)</em>
    </p>
    </div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>
    

    <div class="row">
        <div>
        <?php echo $form->labelEx($model,'Password *', array('style'=>'display: inline;')); ?>
        <em style="color:#727272;display: inline;">
            <?php echo CHtml::link('(I don\'t remember my password)', $this->createUrl('password/recovery'),
                            array("style"=>"font-weight:normal;cursor:pointer; text-decoration: none;")); ?>
        </em>
        </div>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>		
	</div>
    
    <p class="hint">
			Hint: You may login with <kbd>demo</kbd>/<kbd>demo</kbd> or <kbd>admin</kbd>/<kbd>admin</kbd>.
    </p>        
	
	<div class="row buttons centered">
		<?php echo CHtml::submitButton('Login'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
