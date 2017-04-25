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
    height: 580px;
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
 
<div style="padding-top:0px;" id="emailForm">
	<font style="padding-top:0px;" id="headstyle">Email Friend</font>
	
    
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
	<?php echo "Thank you!<br/>Your message has been sent!!<br/>".CHtml::link('Email another friend', array('product/emailtoclient/'.$_GET['id']), array('class'=>'last')); ?>;
			
	</div>	
	<div>
			
	</div>	
	

	
	
</div>


</div>
</div>

