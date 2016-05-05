<?php

class PortfolioController extends UserController {

    public function actionIndex() {
        $portfolio_customerID = Yii::app()->user->id;
        $model = Portfolio::model()->findAllByAttributes(array('portfolio_customerID' => $portfolio_customerID));

        $this->render('index', array(
            'model' => $model
        ));
    }

    public function actionAdd() {
        $model = new Portfolio();

        $this->performAjaxValidation($model);

        if (isset($_POST['Portfolio'])) {
            $model->attributes = $_POST['Portfolio'];

            $model->portfolio_content_type = $_POST['content_type'];
            $model->portfolio_files = '';
            if (isset($_POST['gallery']) && !empty($_POST['gallery'])) {
                $gallery = $_POST['gallery'];
                $model->portfolio_files = implode(',', $gallery);
            }

            $skills = $_POST['project_skills'];
            $model->portfolio_skills = implode(",", $skills);
            $model->portfolio_created = date('Y-m-d H:i:s');

            $model->portfolio_customerID = Yii::app()->user->id;
            $model->portfolio_other_description = !empty($_POST['Portfolio']['portfolio_other_description']) ? $_POST['Portfolio']['portfolio_other_description'] : '';


            /*
              echo '<pre>';
              print_r($_POST);
              print_r($model->attributes);
              die;
             */

            if ($model->save()) {

                if (isset($_POST['remgallery'])) {
                    $remgallery = $_POST['remgallery'];
                }

                $base_path_temp = Yii::app()->basePath . '/../bootstrap/upload/portfolio/temp/';
                if (!empty($remgallery)) {
                    foreach ($remgallery as $filename) {
                        if (file_exists($base_path_temp . $filename)) {
                            unlink($base_path_temp . $filename);
                        }
                    }
                }

                $base_path_original = Yii::app()->basePath . '/../bootstrap/upload/portfolio/';
                if (isset($gallery) && !empty($gallery)) {
                    if (count($gallery) > 0) {
                        foreach ($gallery as $filename) {
                            rename($base_path_temp . $filename, $base_path_original . $filename);
                        }
                    }
                }

                Yii::app()->user->setFlash('type', 'success');
                Yii::app()->user->setFlash('message', 'Portfolio added successfully!');
            } else {
                Yii::app()->user->setFlash('type', 'danger');
                Yii::app()->user->setFlash('message', 'Operation is failed! Try again later.');
            }
            //$this->refresh();
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }

        $this->render('add', array('model' => $model));
    }

    public function actionEdit($id) {
        $model = $this->loadModel($id);

        $this->performAjaxValidation($model);

        if (isset($_POST['Portfolio'])) {
            $model->attributes = $_POST['Portfolio'];

            $model->portfolio_content_type = $_POST['content_type'];
            $model->portfolio_files = '';
            if (isset($_POST['gallery']) && !empty($_POST['gallery'])) {
                $gallery = $_POST['gallery'];
                $model->portfolio_files = implode(',', $gallery);
            }

            $skills = $_POST['project_skills'];
            $model->portfolio_skills = implode(",", $skills);
            $model->portfolio_created = date('Y-m-d H:i:s');
            $model->portfolio_other_description = !empty($_POST['Portfolio']['portfolio_other_description']) ? $_POST['Portfolio']['portfolio_other_description'] : '';

            if ($model->update()) {
                $base_path_temp = Yii::app()->basePath . '/../bootstrap/upload/portfolio/temp/';
                $base_path_original = Yii::app()->basePath . '/../bootstrap/upload/portfolio/';

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
                    }
                }

                Yii::app()->user->setFlash('type', 'success');
                Yii::app()->user->setFlash('message', 'Portfolio updated successfully.');
            } else {
                Yii::app()->user->setFlash('type', 'danger');
                Yii::app()->user->setFlash('message', 'Opertaion Failed. Try again later.');
            }
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }

        $this->render('edit', array(
            'model' => $model,
        ));
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'sky-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionUpload() {
        $rnd = rand(1111, 9999) . date('Ymdhi');
        $userfile_extn = explode(".", strtolower($_FILES['file']['name']));
        $count = count($userfile_extn);
        $fileName = $rnd . "." . $userfile_extn[$count - 1];

        $base_path_temp = Yii::app()->basePath . '/../bootstrap/upload/portfolio/temp/';

        if (move_uploaded_file($_FILES['file']["tmp_name"], $base_path_temp . $fileName)) {
            echo json_encode(array('fname' => $fileName));
        } else {
            echo "1";
        }
    }

    public function actionRemove() {
        $filename = $_POST['file'];

        if (!empty($filename)) {
            $base_path_temp = Yii::app()->basePath . '/../bootstrap/upload/portfolio/temp/' . $filename;
            if (file_exists($base_path_temp)) {
                unlink($base_path_temp);
            }
        }

        echo 'File unlinked!';
    }

    public function actionDelete($id) {
        $model = $this->loadModel($id);

        if ($model->delete()) {
            if (!empty($model->portfolio_files)) {
                $files = explode(',', $model->portfolio_files);
                foreach ($files as $file) {
                    $base_path_temp = Yii::app()->basePath . '/../bootstrap/upload/portfolio/' . $file;
                    if (file_exists($base_path_temp)) {
                        unlink($base_path_temp);
                    }
                }
            }

            Yii::app()->user->setFlash('type', 'success');
            Yii::app()->user->setFlash('message', 'Item deleted successfully.');
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
    }

    public function loadModel($id) {
        $model = Portfolio::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    public function actionGetImages($id) {
        $base_path_original_url = Yii::app()->baseUrl . '/bootstrap/upload/portfolio/';
        $base_path_original = Yii::app()->basePath . '/../bootstrap/upload/portfolio/';

        $result = Portfolio::model()->findByPk($id)->portfolio_files;
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
