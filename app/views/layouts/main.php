<!DOCTYPE html>
<html>
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <link rel="stylesheet" type="text/css" href="/fonts/stylesheet.css" />
    <link href="/js/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="/js/fancybox/jquery.fancybox.css" rel="stylesheet" media="screen">
    <link href="/js/slider/flexslider.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" href="/styles.css" />
    <link href="/js/bootstrap/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.css" />
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.js"></script>
    <? $url = Yii::app()->request->requestUri;
    if ($this->_is_mobile()): ?>
    <link href="/css/mobile.css" rel="stylesheet" media="screen">
    <? endif; ?>
    <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/qpromo_favicon.ico">
        
    <title><?=$this->pageTitle?></title>
</head>
	
		<body>
	<?php
	
    if(strpos($url,'emailtoclient') >0){
		$this->renderPartial('//layouts/header_email');
	} else {
		if(strpos($url,'printfriendly') >0){
			$this->renderPartial('//layouts/header_printer');
		} else {
			$this->renderPartial('//layouts/header');
		}
	}
	?>
    
    <div id="main">        
        <?php echo $content; ?>        
        <div id="push"></div>
    </div>
    
    <script src="/js/html5.js" type="text/javascript"></script>
    <script src="/js/bootstrap/js/bootstrap.js"></script>
    <script src="/js/slider/jquery.flexslider-min.js"></script>
    <script src="/fonts/cufon.js" type="text/javascript"></script>
    <script src="/fonts/dinpro-medium.font.js" type="text/javascript"></script>
    
        
    <? if ($this->_is_mobile() ) : ?><script src="/js/mobile-site.js"></script>
    <? else : ?><script src="/js/site.js"></script>
    <? endif; ?>
    <?php
     if(strpos($url,'emailtoclient') >0){
     	
    $this->renderPartial('//layouts/footer_email');
    } else { 
    	if(strpos($url,'printfriendly') >0){
    		$this->renderPartial('//layouts/footer_printer');
    	} else {
    		$this->renderPartial('//layouts/footer');
    	}
    }
    ?> 


</body>
</html>