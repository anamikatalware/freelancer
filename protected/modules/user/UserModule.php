<?php

class UserModule extends CWebModule {
    /*
     * Add parameters here. You can access them using Yii::app()->controller->module->myParameter
     */

    public $db;
    public $defaultController = "Site";
    private $_assetsUrl;

    public function init() {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        // import the module-level models and components
        $this->setImport(array(
            'user.models.*',
            'user.components.*',
            'application.views.layouts.*'
        ));

        Yii::app()->setComponents(
                array(
                    'errorHandler' => array(
                        'errorAction' => 'site/error'
                    ),
                    'user' => array(
                        'class' => 'CWebUser',
                        'loginUrl' => Yii::app()->createUrl('user/site/login'),
                    ),
                )
        );
    }

    public function getAssetsUrl() {
        if ($this->_assetsUrl === null) {
            $this->_assetsUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('user.assets'));
        }
        return $this->_assetsUrl;
    }

}
