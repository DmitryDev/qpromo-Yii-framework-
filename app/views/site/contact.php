<div id="content">
    <div class="contact-page-wrap">

            <div class="contact-page">
                <?php if(Yii::app()->user->hasFlash('messageSent')): ?>
                <div style ="text-align: center; color: green;"><?= Yii::app()->user->getFlash('messageSent')?></div>
                <?php endif;?>
                <section class="col1">
                    <div class="basic">
                        <h2 class="dinpro">Contact Qpromo</h2>
                        <p>Qpromo works exclusively through the promotional products distributors therefore end-customers will be referred to a local distributor.</p>
                    </div>                    
                </section>
                <section class="col2">
                    <?php $form=$this->beginWidget('CActiveForm', array(
                                    'id'=>'contact-form',
                                    'enableClientValidation'=>true,
                                    'enableAjaxValidation'=>true,
                                    'action'=>Yii::app()->createUrl('site/contact'),
                                    'focus'=>array($model,'first_name'),
                                    'clientOptions'=>array('validateOnSubmit'=>true),
                                    'htmlOptions'=>array('class'=>'form-horizontal'),
                            )); 
                    ?>
                        <div class="contact">
                            <div class="control-group">
                                <?=$form->labelEx($model,'first_name', array('class'=>'control-label dinpro')); ?>
                                <div class="controls">                                    
                                    <?=$form->textField($model,'first_name', array('placeholder'=>'First')); ?>                                    
                                    <?=$form->textField($model,'last_name', array('placeholder'=>'Last')); ?><br /><br /><br/>
                                    <div style="display:block; text-align: left;">
                                        <?= $form->error($model,'first_name'); ?>
                                        <?= $form->error($model,'last_name'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <?=$form->labelEx($model,'company', array('class'=>'control-label dinpro')); ?>
                                <div class="controls">
                                    <?=$form->textField($model,'company', array('placeholder'=>'ExamCorp LLC')); ?>
                                    <?= $form->error($model,'company'); ?>
                                </div>                                
                            </div>
                            <div class="control-group">
                                <?=$form->labelEx($model,'email', array('class'=>'control-label dinpro')); ?>
                                <div class="controls">
                                    <?=$form->textField($model,'email', array('placeholder'=>'ms2013@gmail.com')); ?>
                                    <?= $form->error($model,'email'); ?>
                                </div>
                            </div>
                            <div class="control-group">
                                <?=$form->labelEx($model,'phone', array('class'=>'control-label dinpro')); ?>
                                <div class="controls">
                                    <?=$form->textField($model,'phone', array('placeholder'=>'phone number')); ?>
                                    <?= $form->error($model,'phone'); ?>
                                </div>
                            </div>
                            <div class="control-group">
                                <?=$form->labelEx($model,'message', array('class'=>'control-label dinpro')); ?>
                                <div class="controls">
                                    <?=$form->textArea($model,'message', array('placeholder'=>'Please write us any comments.')); ?>
                                    <?= $form->error($model,'message'); ?>
                                </div>                                
                            </div>
                            <div class="control-group">
                                <input class="btn dinpro" type="submit" id="submit" value="Submit" />
                            </div>
                        </div>

                    <?php $this->endWidget(); ?>
                </section>
            </div>  <!-- .contact-page -->

        </div>  <!-- .account-page-wrap -->
</div>