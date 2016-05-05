<?php

class CategoryController extends AdminController {

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
        $model = new Category('search');
        $model->unsetAttributes();
        if (isset($_GET['Category'])) {
            $model->attributes = $_GET['Category'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionCreate() {
        $model = new Category;

        $this->performAjaxValidation($model);

        if (isset($_POST['Category'])) {
            $model->attributes = $_POST['Category'];

            if ($model->save()) {
                Yii::app()->user->setFlash('type', 'success');
                Yii::app()->user->setFlash('message', 'Category added successfully.');
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

        if (isset($_POST['Category'])) {
            $model->attributes = $_POST['Category'];
            $model->category_status = $_POST['Category']['category_status'];

            if ($model->save()) {
                Yii::app()->user->setFlash('type', 'success');
                Yii::app()->user->setFlash('message', 'Category updated successfully.');
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
                Yii::app()->user->setFlash('message', 'Category deleted successfully.');
            } else {
                echo '<div class="alert alert-success alert-dismissable" id="successmsg"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Category deleted successfully.</div>';
            }
        }

        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
    }

    public function actionOrder() {
        $categories = Category::model()->findAll(array('order' => 'category_order'));

        $this->render('order', array(
            'categories' => $categories
        ));
    }

    public function actionSaveOrder() {
        if (isset($_POST) && !empty($_POST)) {
            $order = $_POST['list'];
            $total = count($order);
            $flag = 0;
            foreach ($order as $key => $value) {
                $category = Category::model()->findByPk($value);
                if (!empty($category)) {
                    $category->category_order = $key;
                    $category->update();
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
        if (isset($_POST ['ajax']) && $_POST ['ajax'] === 'category-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function loadModel($id) {
        $model = Category::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

}
