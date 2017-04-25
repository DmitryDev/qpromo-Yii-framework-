<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ImageUploader extends CWidget
{    
    
    public $model;

    public function init() {                
        $assetsDir = dirname(__FILE__).'/assets';
        $cs = Yii::app()->getClientScript();
        
        $cs->registerCoreScript("jquery");
        
        // Publishing and registering JavaScript file
        $cs->registerScriptFile(
            Yii::app()->assetManager->publish(
                $assetsDir.'/ImageUploader.js'
            ),
            CClientScript::POS_END
        );
        
        // Publishing and registering CSS file
        $cs->registerCssFile(
            Yii::app()->assetManager->publish(
                $assetsDir.'/ImageUploader.css'
            )
        );
                        
        parent::init();
    }
    
    public function run() {        
        $this->render('_view', array());        
        parent::run();
    }       
    
}

?>
