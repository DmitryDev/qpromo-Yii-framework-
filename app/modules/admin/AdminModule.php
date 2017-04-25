<?php

class AdminModule extends CWebModule
{
    public function init()
{
        // this method is called when the module is being created
        // you may place code here to customize the module or the application

        // import the module-level models and components
        $this->setImport(array(
            'admin.models.*',            
            'admin.components.widgets.CategoriesTree.*',
            'admin.components.widgets.ImageUploader.*',
            'admin.components.widgets.ImagesList.*',            
            'admin.components.widgets.ProductPrices.*',
            'admin.components.widgets.MarketingCategoriesTree.*',
            'ext.ckeditor.*',
        ));
        
        $this->layoutPath = Yii::getPathOfAlias('application.modules.admin.views.layouts');
        $this->layout = '/layouts/admin_main';

               
    }

    public function beforeControllerAction($controller, $action)
    {
        if(parent::beforeControllerAction($controller, $action))
        {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        }
        else
            return false;
    }
}
