<?php
/**
 * @author Sergey Muzyka
 * @company Loginaut
 * @site http://loginaut.com
 * @created 9/12/12
 */

return array(    
    '/'=>'/site/index',
    '/admin'=>'/admin/product',
    '/faq'=>'/site/faq',
    
    'site/index/<category:\d+>/<product:\w+>'=>'site/index',
    'page/<id:\d+>'=>'page/view',
    'page/<slug:\w+>'=>'page/view',
    
    
    '<controller:\w+>/<id:\d+>'=>'<controller>/view',
    '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
    '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
);
