<?php

/**
 * @author Sergey Muzyka
 * @company Loginaut
 * @site http://loginaut.com
 * @created 9/12/12
 */


date_default_timezone_set('UTC');

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'QPromo',    

    // preloading 'log' component          
    'preload'=>array('log'),
    
    // autoloading model and component classes
    'import'=>array(
        'application.models.*',
        'application.components.helpers.*',
        'application.components.system.*',
        'application.components.widgets.CategoriesMenu.*',
        'application.components.widgets.CategoriesMenuMobile.*',
        'application.components.widgets.FooterMenu.*',
        'application.components.widgets.SpecialsSlider.*',
        'application.components.widgets.ProductThumbnail.*',
        'application.components.widgets.Authorization.*',
        //'application.components.widgets.ProductsSearcher.*',        
        //'application.components.widgets.ProductsCollection.*',
        //'application.components.widgets.ShoppingCartWidget.*',        
        'ext.image.*',
        //'ext.TPGoogleAnalytics.components.*',
        //'ext.anet.*',
        //'ext.anet.lib.*',
        //'ext.anet.lib.shared.*',
    ),

    'modules'=>array(
        // Administrator panel module
        'admin' => array(),		
    ),

    // application components
    'components'=>array(
        'user'=>array(
            'class'=>'WebUser',
            // enable cookie-based authentication
            'allowAutoLogin'=>true,
            'loginUrl'=>null,
        ),
        
        //'shoppingCart'=>array(
        //    'class'=>'ShoppingCart',
        //),
                       
        'mailer'=>array(
            'class'=>'Mailer',
        ),
        
        'authManager'=>array(
            'class'=>'CDbAuthManager',
            'connectionID'=>'db',
            'itemTable'=>'auth_item',
            'itemChildTable'=>'auth_itemchild',
            'assignmentTable'=>'auth_assignment',
            'defaultRoles'=>array('customer'),
        ),
        
        //URLs in path-format        
        'urlManager'=>array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => require(dirname(__FILE__) . '/routes.php'),
        ),
        
        'image'=>array(
			'class' => 'application.extensions.image.CImageComponent',
			'driver'=>'GD',
		),                
				
        'errorHandler'=>array(
            // use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
        
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error',
				),                
            ),
        ),
        
        'ePdf' => array(
            'class'         => 'ext.yii-pdf.EYiiPdf',
            'params'        => array(                
                'HTML2PDF' => array(
                    'librarySourcePath' => 'ext.yii-pdf.html2pdf.*',
                    'classFile'         => 'html2pdf.class.php', // For adding to Yii::$classMap
                    'defaultParams'     => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
                        'orientation' => 'L', // landscape or portrait orientation
                        'format'      => 'letter', // format A4, A5, ...
                        'language'    => 'en', // language: fr, en, it ...
                        'unicode'     => true, // TRUE means clustering the input text IS unicode (default = true)
                        'encoding'    => 'UTF-8', // charset encoding; Default is UTF-8
                        'marges'      => array(15, 10, 15, 10), // margins by default, in order (left, top, right, bottom)
                    )
                )
            ),
        ),
    ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params'=>array(
        // this is used in contact page
        'adminEmail'=>'sergey@loginaut.com',
        'quoteEmail'=>'sergey@loginaut.com',
        'companyName'=>'Loginaut LLC',
        'cookiesDuration'=>3600*15, //15 hours by default
        'tokenDuration'=>3600,       //1 hour by default
        'specialsImagePath' => '/images/specials/',
        'pdfsPath' => '/pdf/',
        'downloadsPath' => '/downloads/',
        'accessoriesImagePath' => '/images/accessories/',
        'packagingImagePath' => '/images/packaging/',
        'preloadedImagePath' => '/images/preloaded/',
        'productImagesPath' => '/images/product/',
        'productImageSize' => array(
			'full' => array(
				'width' => 432,
				'height' => 324,
			),
            'huge' => array(
				'width' => 360,
				'height' => 270,
			),
			'large' => array(
				'width' => 240,
				'height' => 180,
			),
            'small' => array(
				'width' => 160,
				'height' => 120,
			),            
		),            
        'marketingImagePath' => '/images/marketing/',
        'marketingImageSize' => array(
			'original' => array(
				'width' => 600,
				'height' => 700,
			),
            'thumbnail' => array(
				'width' => 156,
				'height' => 182,
			),
        ),
                
        'paypal' => array(
	  'merchantId'=>'00000000000'
        ),
        'authorizeNet' => array(
			//'METHOD_TO_USE' => 'AIM',
			'AUTHORIZENET_API_LOGIN_ID' => '00000000',
			'AUTHORIZENET_TRANSACTION_KEY' => '0000000000000',
			'AUTHORIZENET_SANDBOX' => false,
			'TEST_REQUEST' => true, // You may want to set to true if testing against production
			'AUTHORIZENET_MD5_SETTING' => '',
		),
    ),
);
