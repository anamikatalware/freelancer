<?php

class TourController extends AdminController {

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
                'actions' => array('index', 'create', 'update', 'delete', 'view', 'del_temp_img', 'getimages'),
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        $model = new Tour('search');
        $model->unsetAttributes();
        if (isset($_GET['Tour'])) {
            $model->attributes = $_GET['Tour'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionCreate() {
        $model = new Tour;

        $this->performAjaxValidation($model);

        if (isset($_POST['Tour'])) {
            //print_r($_POST);
            //die;
            $model->attributes = $_POST['Tour'];
            $model->tour_duration = $_POST['duration'] . ' ' . $model->tour_duration;
            $model->tour_overview = $_POST['Tour']['tour_overview'];
            $model->tour_categoryID = $_POST['Tour']['tour_categoryID'];
            $model->tour_is_private = $_POST['Tour']['tour_is_private'];
            $model->tour_is_bestSeller = $_POST['Tour']['tour_is_bestSeller'];

            $filename = '';
            $base_path_original = Yii::app()->basePath . '/../bootstrap/upload/tours/original/';
            $base_path_medium = Yii::app()->basePath . '/../bootstrap/upload/tours/medium/';
            $base_path_small = Yii::app()->basePath . '/../bootstrap/upload/tours/small/';
            $base_path_extra_small = Yii::app()->basePath . '/../bootstrap/upload/tours/extra_small/';
            $base_path_temp = Yii::app()->basePath . '/../bootstrap/upload/tours/temp/';

            if (!empty($_FILES['Tour']['name']['tour_image'])) {
                $list_featured_image = CUploadedFile::getInstance($model, 'tour_image');
                $random_name = rand(1111, 9999) . date('Ymdhi');

                if (!empty($list_featured_image)) {
                    $extension = strtolower($list_featured_image->getExtensionName());
                    $filename = "{$random_name}.{$extension}";
                    $list_featured_image->saveAs($base_path_original . $filename);

                    /* ------ Create Image Thumbnail Start ----- */
                    $obj = new ImageThumbnail;
                    $obj->CreateImageThumbnail($base_path_original . $filename, $base_path_medium . $filename, $extension, 200, 200);
                    $obj->CreateImageThumbnail($base_path_original . $filename, $base_path_small . $filename, $extension, 100, 100);
                    $obj->CreateImageThumbnail($base_path_original . $filename, $base_path_extra_small . $filename, $extension, 50, 50);
                    /* ------ Create Image Thumbnail End ----- */
                }
            }
            $model->tour_image = $filename;

            $model->tour_gallery = '';
            if (isset($_POST['gallery']) && !empty($_POST['gallery'])) {
                $gallery = $_POST['gallery'];
                $model->tour_gallery = implode(',', $gallery);
            }


            if ($model->save()) {

                if (isset($_POST['remgallery'])) {
                    $remgallery = $_POST['remgallery'];
                }

                if (!empty($remgallery)) {
                    foreach ($remgallery as $filename) {
                        $this->actionDel_temp_img($filename);
                    }
                }

                if (isset($gallery) && !empty($gallery)) {
                    if (count($gallery) > 0) {
                        foreach ($gallery as $filename) {
                            rename($base_path_temp . $filename, $base_path_original . $filename);

                            /* ------ Create Image Thumbnail Start ----- */
                            $name_array = explode(".", strtolower($filename));
                            $count = count($name_array);
                            $extension = $name_array[$count - 1];

                            $obj = new ImageThumbnail;
                            $obj->CreateImageThumbnail($base_path_original . $filename, $base_path_medium . $filename, $extension, 200, 200);
                            $obj->CreateImageThumbnail($base_path_original . $filename, $base_path_small . $filename, $extension, 100, 100);
                            $obj->CreateImageThumbnail($base_path_original . $filename, $base_path_extra_small . $filename, $extension, 50, 50);
                            /* ------ Create Image Thumbnail End ----- */
                        }
                    }
                }

                Yii::app()->user->setFlash('type', 'success');
                Yii::app()->user->setFlash('message', 'Tour added successfully.');
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

        $gallery = array();
        $remgallery = array();

        if (isset($_POST['Tour'])) {

            $model->attributes = $_POST['Tour'];
            $model->tour_duration = $_POST['duration'] . ' ' . $model->tour_duration;
            $model->tour_overview = $_POST['Tour']['tour_overview'];
            $model->tour_categoryID = $_POST['Tour']['tour_categoryID'];
            $model->tour_is_private = $_POST['Tour']['tour_is_private'];
            $model->tour_is_bestSeller = $_POST['Tour']['tour_is_bestSeller'];

            //print_r($_POST);
            //print_r($model->attributes);
            //die;
            //Featured Image
            $filename = '';
            $base_path_original = Yii::app()->basePath . '/../bootstrap/upload/tours/original/';
            $base_path_medium = Yii::app()->basePath . '/../bootstrap/upload/tours/medium/';
            $base_path_small = Yii::app()->basePath . '/../bootstrap/upload/tours/small/';
            $base_path_extra_small = Yii::app()->basePath . '/../bootstrap/upload/tours/extra_small/';
            $base_path_temp = Yii::app()->basePath . '/../bootstrap/upload/tours/temp/';

            if (!empty($_FILES['Tour']['name']['tour_image'])) {
                $list_featured_image = CUploadedFile::getInstance($model, 'tour_image');
                $random_name = rand(1111, 9999) . date('Ymdhi');

                if (!empty($list_featured_image)) {
                    $extension = strtolower($list_featured_image->getExtensionName());
                    $filename = "{$random_name}.{$extension}";
                    $list_featured_image->saveAs($base_path_original . $filename);

                    /* ------ Create Image Thumbnail Start ----- */
                    $obj = new ImageThumbnail;
                    $obj->CreateImageThumbnail($base_path_original . $filename, $base_path_medium . $filename, $extension, 200, 200);
                    $obj->CreateImageThumbnail($base_path_original . $filename, $base_path_small . $filename, $extension, 100, 100);
                    $obj->CreateImageThumbnail($base_path_original . $filename, $base_path_extra_small . $filename, $extension, 50, 50);
                    /* ------ Create Image Thumbnail End ----- */
                }
                $model->tour_image = $filename;
            }

            if (isset($_POST['gallery']) && !empty($_POST['gallery'])) {
                $gallery = $_POST['gallery'];
                $model->tour_gallery = implode(',', $gallery);
            }

            if ($model->save()) {

                if (isset($_POST['gallery'])) {
                    $gallery = $_POST['gallery'];
                }

                if (isset($_POST['remgallery'])) {
                    $remgallery = $_POST['remgallery'];
                }

                if (!empty($remgallery)) {
                    foreach ($remgallery as $filename) {
                        $this->actionDel_temp_img($filename);
                    }
                }

                foreach ($gallery as $filename) {
                    if (file_exists($base_path_temp . $filename)) {
                        rename($base_path_temp . $filename, $base_path_original . $filename);

                        /* ------ Create Image Thumbnail Start ----- */
                        $name_array = explode(".", strtolower($filename));
                        $count = count($name_array);
                        $extension = $name_array[$count - 1];

                        $obj = new ImageThumbnail;
                        $obj->CreateImageThumbnail($base_path_original . $filename, $base_path_medium . $filename, $extension, 200, 200);
                        $obj->CreateImageThumbnail($base_path_original . $filename, $base_path_small . $filename, $extension, 100, 100);
                        $obj->CreateImageThumbnail($base_path_original . $filename, $base_path_extra_small . $filename, $extension, 50, 50);
                        /* ------ Create Image Thumbnail End ----- */
                    }
                }

                Yii::app()->user->setFlash('type', 'success');
                Yii::app()->user->setFlash('message', 'Tour updated successfully.');
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
                Yii::app()->user->setFlash('message', 'Tour deleted successfully.');
            } else {
                echo '<div class="alert alert-success alert-dismissable" id="successmsg"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Tour deleted successfully.</div>';
            }
        }

        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
    }

    public function actionView($id) {
        $model = Tour::model()->findByPk($id);

        if (!empty($model)) {
            $this->render('view', array(
                'model' => $model,
            ));
        } else {
            $this->redirect('tour/index');
        }
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'tour-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function loadModel($id) {
        $model = Tour::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    public function actionDel_temp_img($image) {
        $base_path_original = Yii::app()->basePath . '/../bootstrap/upload/tours/original/';
        $base_path_medium = Yii::app()->basePath . '/../bootstrap/upload/tours/medium/';
        $base_path_small = Yii::app()->basePath . '/../bootstrap/upload/tours/small/';
        $base_path_extra_small = Yii::app()->basePath . '/../bootstrap/upload/tours/extra_small/';
        $base_path_temp = Yii::app()->basePath . '/../bootstrap/upload/tours/temp/';

        if (file_exists($base_path_temp . $image)) {
            unlink($base_path_temp . $image);
        }

        if (file_exists($base_path_original . $image)) {
            unlink($base_path_original . $image);
        }

        if (file_exists($base_path_medium . $image)) {
            unlink($base_path_medium . $image);
        }
        if (file_exists($base_path_small . $image)) {
            unlink($base_path_small . $image);
        }
        if (file_exists($base_path_extra_small . $image)) {
            unlink($base_path_extra_small . $image);
        }
    }

    public function actionGetimages($id) {
        $tour_id = $id;
        $base_path_original_url = Yii::app()->baseUrl . '/bootstrap/upload/tours/original/';
        $base_path_original = Yii::app()->basePath . '/../bootstrap/upload/tours/original/';

        $result = Tour::model()->findByPk($tour_id)->tour_gallery;
        $attachments = array();
        if ($result != '') {
            $data = explode(',', $result);
            foreach ($data as $d) {
                $path = $base_path_original . $d;
                $obj['name'] = $d;
                $obj['size'] = filesize($path);
                $obj['path'] = $base_path_original_url . $d;
                $attachments[] = $obj;
            }
        }

        header('Content-type: text/json');
        header('Content-type: application/json');
        echo json_encode($attachments);
    }

}
