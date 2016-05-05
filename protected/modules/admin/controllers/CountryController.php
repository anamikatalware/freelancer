<?php

class CountryController extends AdminController {

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
        $model = new Country('search');
        $model->unsetAttributes();
        if (isset($_GET['Country'])) {
            $model->attributes = $_GET['Country'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionCreate() {
        $model = new Country;

        $this->performAjaxValidation($model);

        if (isset($_POST['Country'])) {
            $model->attributes = $_POST['Country'];
            $model->country_created = date('Y-m-d H:i:s');

            $filename = '';
            $base_path_original = Yii::app()->basePath . '/../bootstrap/upload/flags/original/';
            $base_path_small = Yii::app()->basePath . '/../bootstrap/upload/flags/small/';

            if (!empty($_FILES['Country']['name']['country_flag'])) {
                $country_flag = CUploadedFile::getInstance($model, 'country_flag');
                $random_name = rand(1111, 9999) . date('Ymdhi');

                if (!empty($country_flag)) {
                    $extension = strtolower($country_flag->getExtensionName());
                    $filename = "{$random_name}.{$extension}";
                    $country_flag->saveAs($base_path_original . $filename);

                    /* ------ Create Image Thumbnail Start ----- */
                    $obj = new ImageThumbnail;
                    $obj->CreateImageThumbnail($base_path_original . $filename, $base_path_small . $filename, $extension, 80, 50);
                    /* ------ Create Image Thumbnail End ----- */
                }
            }
            $model->country_flag = $filename;

            if ($model->save()) {
                Yii::app()->user->setFlash('type', 'success');
                Yii::app()->user->setFlash('message', 'Country added successfully.');
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

        if (isset($_POST['Country'])) {
            $model->attributes = $_POST['Country'];
            $model->country_status = $_POST['Country']['country_status'];

            $filename = '';
            $base_path_original = Yii::app()->basePath . '/../bootstrap/upload/flags/original/';
            $base_path_small = Yii::app()->basePath . '/../bootstrap/upload/flags/small/';

            if (!empty($_FILES['Country']['name']['country_flag'])) {
                $country_flag = CUploadedFile::getInstance($model, 'country_flag');
                $random_name = rand(1111, 9999) . date('Ymdhi');

                if (!empty($country_flag)) {
                    $extension = strtolower($country_flag->getExtensionName());
                    $filename = "{$random_name}.{$extension}";
                    $country_flag->saveAs($base_path_original . $filename);

                    /* ------ Create Image Thumbnail Start ----- */
                    $obj = new ImageThumbnail;
                    $obj->CreateImageThumbnail($base_path_original . $filename, $base_path_small . $filename, $extension, 80, 50);
                    /* ------ Create Image Thumbnail End ----- */
                }
                $model->country_flag = $filename;
            }

            if ($model->save()) {
                Yii::app()->user->setFlash('type', 'success');
                Yii::app()->user->setFlash('message', 'Country updated successfully.');
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

            $base_path_original = Yii::app()->basePath . '/../bootstrap/upload/flags/original/' . $model->country_flag;
            $base_path_small = Yii::app()->basePath . '/../bootstrap/upload/flags/small/' . $model->country_flag;

            if (file_exists($base_path_original)) {
                unlink($base_path_original);
            }

            if (file_exists($base_path_small)) {
                unlink($base_path_small);
            }

            if (!isset($_GET['ajax'])) {
                Yii::app()->user->setFlash('msg_type', 'alert-success');
                Yii::app()->user->setFlash('message', 'Country deleted successfully.');
            } else {
                echo '<div class="alert alert-success alert-dismissable" id="successmsg"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Country deleted successfully.</div>';
            }
        }

        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'country-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function loadModel($id) {
        $model = Country::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

}
