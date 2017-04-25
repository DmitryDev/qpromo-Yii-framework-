<?php

class Authorization extends CWidget
{               
    private $loginModel=null;
    private $signupModel=null;
    private $recoveryModel=null;
            
    public function init() {
        parent::init();                    
        
        $assetsDir = dirname(__FILE__).'/assets';
        $cs = Yii::app()->getClientScript();
                      
        // Publishing widget assets
        $publishedDir = Yii::app()->assetManager->publish($assetsDir, false, -1, true);
        
        // registering JavaScript file        
        $cs->registerScriptFile($publishedDir . '/authorization.js', CClientScript::POS_END);        
        
        // Registering CSS file        
        $cs->registerCssFile($publishedDir .'/authorization.css');
        
        
        $this->signupModel=new SignupForm;
        $this->loginModel=new LoginForm;
        $this->recoveryModel=new PwdRecoveryForm;
    }

    public function run() {        
        $this->render('_view', array('loginModel'=>$this->loginModel,
                                     'signupModel'=>$this->signupModel,
                                     'recoveryModel'=>$this->recoveryModel));
        parent::run();
    }
        
}

?>
