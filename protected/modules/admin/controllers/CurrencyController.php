<?php

class CurrencyController extends AdminController {

    public $layout = '/layouts/column1';

    /**
     * @return array action filters
     */
    public function filters() {
        $filters = array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );

        return array_merge($filters, parent::filters());
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'create', 'update', 'delete', 'view', 'order', 'saveorder'),
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        $model = new Currency('search');
        $model->unsetAttributes();
        if (isset($_GET['Currency'])) {
            $model->attributes = $_GET['Currency'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionCreate() {
        $model = new Currency;

        $this->performAjaxValidation($model);

        if (isset($_POST['Currency'])) {
            $model->attributes = $_POST['Currency'];
            $model->currency_icon = $_POST['Currency']['currency_icon'];
            $model->currency_created = date('Y-m-d H:i:s');

            if ($model->save()) {
                Yii::app()->user->setFlash('type', 'success');
                Yii::app()->user->setFlash('message', 'Currency added successfully.');
            } else {
                Yii::app()->user->setFlash('type', 'danger');
                Yii::app()->user->setFlash('message', 'Operation Failed due to lack of connectivity.');
            }
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        $this->performAjaxValidation($model);

        if (isset($_POST['Currency'])) {
            $model->attributes = $_POST['Currency'];
            $model->currency_icon = $_POST['Currency']['currency_icon'];
            $model->currency_status = $_POST['Currency']['currency_status'];
            $model->currency_updated = date('Y-m-d H:i:s');

            if ($model->save()) {
                Yii::app()->user->setFlash('type', 'success');
                Yii::app()->user->setFlash('message', 'Currency updated successfully.');
            } else {
                Yii::app()->user->setFlash('type', 'danger');
                Yii::app()->user->setFlash('message', 'Operation Failed due to lack of connectivity.');
            }

            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        $model = $this->loadModel($id);

        if ($model->delete()) {
            if (!isset($_GET['ajax'])) {
                Yii::app()->user->setFlash('msg_type', 'alert-success');
                Yii::app()->user->setFlash('message', 'Currency deleted successfully.');
            } else {
                echo '<div class="alert alert-success alert-dismissable" id="successmsg"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Currency deleted successfully.</div>';
            }
        }

        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
    }

    public function actionOrder() {
        $currencies = Currency::model()->findAll(array('order' => 'currency_order'));

        $this->render('order', array(
            'currencies' => $currencies
        ));
    }

    public function actionSaveOrder() {
        if (isset($_POST) && !empty($_POST)) {
            $order = $_POST['list'];
            $total = count($order);
            $flag = 0;
            foreach ($order as $key => $value) {
                $currency = Currency::model()->findByPk($value);
                if (!empty($currency)) {
                    $currency->currency_order = $key;
                    $currency->update();
                    $flag++;
                }
            }

            if ($flag == $total) {
                echo TRUE;
            } else {
                echo FALSE;
            }
        }
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'currency-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function loadModel($id) {
        $model = Currency::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

}
