<?php

/**
 * @author Sergey Muzyka
 * @company Loginaut
 * @site http://loginaut.com
 * @created 9/12/12
 */

date_default_timezone_set('UTC');

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'LEAF Demo',

    // preloading 'log' component
    'preload'=>array('log'),

    // application components
    'components'=>array(						
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning',
                ),
            ),
        ),
        'authManager'=>array(
            'class'=>'CDbAuthManager',
            'connectionID'=>'db',
            'itemTable'=>'auth_item',
            'itemChildTable'=>'auth_itemchild',
            'assignmentTable'=>'auth_assignment',
            'defaultRoles'=>array('customer'),
        ),
    ),
);