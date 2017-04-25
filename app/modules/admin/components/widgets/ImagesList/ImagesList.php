<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ImagesList extends CWidget
{    
    public $images;
    public $editable = false;
    private $_checkedImgUrl;


    public function init() {    
        $assetsDir = dirname(__FILE__).'/assets';
        $cs = Yii::app()->getClientScript();
        
        /*if ($this->editable) {
            $cs->registerCoreScript("jquery");

            // Publishing and registering JavaScript file
            $cs->registerScriptFile(
                Yii::app()->assetManager->publish(
                    $assetsDir.'/ImagesList.js'
                ),
                CClientScript::POS_END
            );
        }*/
        
        // Publishing and registering CSS file
        $cs->registerCssFile(
            Yii::app()->assetManager->publish(
                $assetsDir.'/ImagesList.css'
            )
        );
         
        $this->_checkedImgUrl = Yii::app()->assetManager->publish(
            $assetsDir.'/checked.png'
        );
        
        parent::init();
    }
    
    public function run() {        
        $this->render('_view', array('images'=>$this->images, 'editable'=>$this->editable, 'checkedIcon'=>$this->_checkedImgUrl));        
        parent::run();
    }
      
    
}

?>
