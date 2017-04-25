<div class="modal-body"><br/><br/><br/>
<?php $form=$this->beginWidget('CActiveForm', array(
                                'id'=>'pwd-recovery-form',                                
                                'enableClientValidation'=>false,
                                'enableAjaxValidation'=>true,
                                'action'=>Yii::app()->createUrl('password/recovery'),
                                'focus'=>array($model,'email'),
                                'clientOptions'=>array('validateOnSubmit'=>true),
                                'htmlOptions'=>array('class'=>'form-horizontal')
                            ));
?>  
        <!--form id="reset" class="form-horizontal"-->
            <div class="control-group">
                <label class="control-label" for="inputPasswordnew">Your Email:</label>
                <div class="controls">
                    <?=$form->textField($model,'email', array('placeholder'=>'email@example.com')); ?>
                    <!--input type="password" id="inputPasswordnew" placeholder=""-->
                    <span><small>(E-mail box assigned to your account where we will send recovery instructions)</small></span>
                    <?=$form->error($model,'email'); ?>
                </div>
            </div>
            <div class="control-group buttons">
                <div class="controls">
                    <button id="submit_reset" type="submit" class="btn btn-primary">Send</button>
                    <button id="cancel_reset" type="text" class="btn">Cancel</button>
                </div>
            </div>
        <!--/form-->
<?php $this->endWidget(); ?>
</div>