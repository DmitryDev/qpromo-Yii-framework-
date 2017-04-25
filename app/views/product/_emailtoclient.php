<style type="text/css">
.div1 {
    background: none repeat scroll center top #FFFFFF;
    height: auto;
    margin: 10px auto;
    overflow: visible;
    padding: 14px 40px 40px;
    width: 630px;
}
#emailForm {
    border: 1px solid #CCCCCC;
    box-shadow: 0 0 8px #000000;
    height: 680px;
    margin: 5px auto 0;
    padding: 0 5px 5px;
    width: 550px;
}
#headstyle {
    font-family: Century Gothic,Myriad Pro,Arial,Helvetica,sans-serif;
    font-size: 30px;
    font-weight: 500;
    letter-spacing: 1px;
    padding: 30px 10px 0 18px;
    text-align: left;
}
#signupForm {
    float: left;
}
.formContainer {
    float: left;
    margin-top: 0;
    padding: 0 0 5px 25px;
}
#prodImgsec {
    color: #666666;
    float: left;
    font-size: 13px;
    font-weight: bold;
    margin: 10px;
    padding: 0;
    word-spacing: 1px;
}
#prodImg {
    border: 1px solid #C3C3C3;
}
.emailFormContainer {
    float: left;
    margin-top: 0;
    padding-left: 8px;
    width: 250px;
}
.formRow {
    height: 25px;
    padding: 10px;
}
.formRow2 {
    height: 55px;
    padding: 10px;
}
.label_email {
    float: left;
    padding: 0 8px 0 0;
    text-align: left;
    width: 120px;
}
.label_email label {
    color: #000000;
    font-family: Century Gothic,Myriad Pro,Arial,Helvetica,sans-serif;
    font-size: 11px;
    letter-spacing: 1px;
    line-height: 35px;
}
#astrick {
    color: #FF0000;
    font-size: 14px;
}
.sendButton {
    float: left;
    padding-left: 10px;
    padding-top: 8px;
    text-align: center;
}
.field input, textarea {
    color: #666666;
    float: left;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 14px;
    outline: medium none;
    padding: 2px;
}

</style>

		<div id="emailtoclientbg">
			<!-- a href="http://www.qpromo.com/"><img src="http://www.qpromo.com/images/global/print-logo-1.jpg" style="border:none;"/></a-->
			<?= CHtml::link(CHtml::image("/images/header_popup_email.png"), array('site/index'), array('class'=>'last')); ?>
		</div>
		<div class="div1">
 <div style="padding-left:20px;">
 <font style="color:red; font-size:12px; ">* Required Fields</font><br>
 </div>
<div style="padding-top:0px;" id="emailForm">
	<font style="padding-top:0px;" id="headstyle">Email Friend</font>
	<?php /*$form=$this->beginWidget('CActiveForm', array(
                'id'=>'signupForm',
                'enableAjaxValidation'=>true,                 
                'htmlOptions'=>array('enctype'=>'multipart/form-data'),
    ));*/ 
	?>
<?php echo CHtml::form(); ?>
<?php echo CHtml::errorSummary($form); ?>
    <?php 
    //echo $form->errorSummary($model); ?>
			<div class="formContainer">
		
		<div id="prodImgsec">
		  <div id="prodImg">
		  <?php $modelImage = ProductImage::model()->findByPk($model->main_image_id);?>
		  <img width="200" height="200" src="<?php echo  '/images/product/'.$modelImage->large; ?>"></div>
		  <div style="text-align:center; width:200px; height:auto; text-transform:capitalize;">
		  <?php echo $model->name;?><br>
		  Model #:<span class="model"><?php echo $model->model_number;?></span>		  </div>
		</div>
	<div class="emailFormContainer">
			<div class="formRow">
			  <div class="label_email">
			  	<?php echo CHtml::activeLabel($form,'name_from'); ?>
			  	<?php //echo $form->labelEx($model,'name_from'); ?>
			  </div>
			  <div class="field">
			  	<?php echo CHtml::activeTextField($form, 'name_from');?>
			  	<?php //echo $form->textField($model,'name_from',array('id'=>'name','name'=>'name')); ?>
			  	<?php //echo $form->error($model,'name_from'); ?>
			    
			  </div>
			</div>	
			<div class="formRow">
			  <div class="label_email">
			   <?php //echo $form->labelEx($model,'email_from'); ?>
			   <?php echo CHtml::activeLabel($form,'email_from'); ?> 			   
			  </div>
			  <div class="field">
			  	<?php echo CHtml::activeTextField($form, 'email_from');?>
			  	<?php //echo $form->textField($model,'email_from',array('id'=>'email','name'=>'email')); ?>
			  	<?php //echo $form->error($model,'email_from'); ?>	
              </div>
			</div>
			<div class="formRow">
			  <div class="label_email">
			   <?php echo CHtml::activeLabel($form,'name_to'); ?>
			   <?php //echo $form->labelEx($model,'name_to'); ?>			   
			  </div>
			  <div class="field">
			   <?php echo CHtml::activeTextField($form, 'name_to');?>
			   <?php //echo $form->textField($model,'name_to',array('id'=>'frndname','name'=>'frndname')); ?>
			   <?php //echo $form->error($model,'name_to'); ?>			   
              </div>
			</div>
			<div class="formRow">
			  <div class="label_email">
			   <?php echo CHtml::activeLabel($form,'email_to'); ?> 
			   <?php //echo $form->labelEx($model,'email_to'); ?>			   
			  </div>
			  <div class="field">
			   <?php echo CHtml::activeTextField($form, 'email_to');?>
			   <?php //echo $form->textField($model,'email_to',array('id'=>'frndemail','name'=>'frndemail')); ?>
			   <?php //echo $form->error($model,'name_to'); ?>			   
			  </div>
			</div>
            <div class="formRow2">
			   <div class="label_email">
			   	  <?php echo CHtml::activeLabel($form,'email_message'); ?>    
			      <?php //echo $form->labelEx($model,'email_message'); ?>
			   </div>
			   <div class="field">
			   	 <?php echo CHtml::activeTextArea($form, 'email_message',array('name'=>'email_message','wrap'=>'hard','cols'=>'30','rows'=>'5'));?>
			   	 <?php //echo $form->textArea($model,'email_message',array('name'=>'message','wrap'=>'hard','cols'=>'30','rows'=>'5')); ?>
			     <?php //echo $form->error($model,'name_to'); ?>
				
     		  </div>
			</div>
		
 
		<div class="sendButton">
			<?php echo CHtml::submitButton("Send",array('name' => 'submit')); ?>
			
		</div>
		</div>	
		<div>
			
	</div>	
	

	
	
</div>
<?php //$this->endWidget(); ?>
<?php echo CHtml::endForm(); ?>

</div>
</div>

