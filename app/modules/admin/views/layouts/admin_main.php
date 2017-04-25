<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl; ?>/css/yii_screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl; ?>/css/yii_print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl; ?>/css/yii_ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl; ?>/css/yii_main.css" />
	<link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl; ?>/css/yii_form.css" />
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?> Administration Panel</div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Store', 'url'=>array('/site/index')),
                                array('label'=>'Users', 'url'=>array('/admin/user/index')),
                                array('label'=>'Categories', 'url'=>array('/admin/category/index')),
                                array('label'=>'Products', 'url'=>array('/admin/product/index')),
                                array('label'=>'Specials', 'url'=>array('/admin/specials/index')),
                                array('label'=>'Packaging', 'url'=>array('/admin/packaging/index')),
                                array('label'=>'Accessories', 'url'=>array('/admin/accessory/index')),
                                array('label'=>'Preloaded', 'url'=>array('/admin/preloaded/index')),
                                array('label'=>'FAQs', 'url'=>array('/admin/faq/index')),
                                array('label'=>'Events', 'url'=>array('/admin/event/index')),
                                array('label'=>'Mrkt Tool', 'url'=>array('/admin/marketing/index')),
                                array('label'=>'Pages', 'url'=>array('/admin/page/index')),
                                array('label'=>'Capacities', 'url'=>array('/admin/capacity/index')),
			),
		)); ?>
	</div><!-- mainmenu -->        
	<?php if(isset($this->breadcrumbs)):?>        
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by <?php echo Yii::app()->params['companyName'];?>.<br/>
		All Rights Reserved.<br/>		
	</div><!-- footer -->

</div><!-- page -->
</body>
</html>
