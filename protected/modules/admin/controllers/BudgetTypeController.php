<?php

class BudgetTypeController extends AdminController {

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
                'actions' => array('index', 'create', 'update', 'delete', 'view'),
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        $model = new BudgetType('search');
        $model->unsetAttributes();
        if (isset($_GET['BudgetType'])) {
            $model->attributes = $_GET['BudgetType'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionCreate() {
        $model = new BudgetType;

        $this->performAjaxValidation($model);

        if (isset($_POST['BudgetType'])) {
            $model->attributes = $_POST['BudgetType'];
            $model->budgettype_description = $_POST['BudgetType']['budgettype_description'];
            $model->budgettype_created = date('Y-m-d H:i:s');            

            if ($model->save()) {
                Yii::app()->user->setFlash('type', 'success');
                Yii::app()->user->setFlash('message', 'Budget Type added successfully.');
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

        if (isset($_POST['BudgetType'])) {
            $model->attributes = $_POST['BudgetType'];
            $model->budgettype_description = $_POST['BudgetType']['budgettype_description'];
            $model->budgettype_status = $_POST['BudgetType']['budgettype_status'];
            $model->budgettype_updated = date('Y-m-d H:i:s');

            if ($model->save()) {
                Yii::app()->user->setFlash('type', 'success');
                Yii::app()->user->setFlash('message', 'Budget Type updated successfully.');
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
                Yii::app()->user->setFlash('message', 'Budget Type deleted successfully.');
            } else {
                echo '<div class="alert alert-success alert-dismissable" id="successmsg"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Budget Type deleted successfully.</div>';
            }
        }

        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'budgettype-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function loadModel($id) {
        $model = BudgetType::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

}
