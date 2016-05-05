<?php

class SiteController extends UserController {

    public $layout = '//layouts/column1';

    /**
     * @return array action filters
     */
    public function filters() {
        $filters = array(
            'accessControl', // perform access control for CRUD operations
        );

        return array_merge($filters, parent::filters());
    }

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('login', 'forgotpassword', 'resetpassword', 'register', 'postproject', 'fBLogin', 'googleLogin'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('index', 'logout', 'about', 'page', 'changepassword', 'profile', 'upload', 'remove'),
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionLogin() {
        if (!empty(Yii::app()->user->id)) {
            $this->redirect(array('site/index'));
        }

        $model = new CustomerForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'sky-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['CustomerForm'])) {
            $model->attributes = $_POST['CustomerForm'];
            if ($model->validate() && $model->login()) {
                $this->redirect(array('site/index'));
            }
        }

        $this->render('login', array('model' => $model));
    }

    public function actionFBLogin() {
        //print_r($_POST);

        $facebook_id = $_POST['id'];
        $email = $_POST['email'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $gender = $_POST['gender'];
        $image_url = $_POST['picture']['data']['url'];

        $model = Customer::model()->findByAttributes(array('customer_social_id' => $facebook_id, 'customer_email' => $email, 'customer_social_media' => 1));
        if (!empty($model)) {
            //User Exists
            Yii::app()->user->id = $model->customer_id;
            echo 1;
        } else {
            //New User
            $obj = new Customer;
            $obj->customer_username = $email;
            $obj->customer_firstname = $first_name;
            $obj->customer_lastname = $last_name;
            $obj->customer_email = $email;
            $obj->customer_roleID = 1;
            $obj->customer_status = 1;
            $obj->customer_social_id = $facebook_id;
            $obj->customer_image_url = $image_url;
            $obj->customer_social_media = 1;

            if ($obj->save()) {
                Yii::app()->user->id = $obj->customer_id;
                echo 1;
                //User Registered Successfully
            } else {
                echo 2;
                //User registration fail
            }
        }
    }
    
    public function actionGoogleLogin() {
        //print_r($_POST);

        $google_id = $_POST['googleID'];
        $email = $_POST['googleEmail'];
        $first_name = $_POST['googleName'];
        $last_name = $_POST['googleName'];
        $image_url = $_POST['googlePicture'];

        $model = Customer::model()->findByAttributes(array('customer_social_id' => $google_id, 'customer_email' => $email, 'customer_social_media' => 2));
        if (!empty($model)) {
            //User Exists
            Yii::app()->user->id = $model->customer_id;
            echo 1;
        } else {
            //New User
            $obj = new Customer;
            $obj->customer_username = $email;
            $obj->customer_firstname = $first_name;
            $obj->customer_lastname = $last_name;
            $obj->customer_email = $email;
            $obj->customer_roleID = 1;
            $obj->customer_status = 1;
            $obj->customer_social_id = $google_id;
            $obj->customer_image_url = $image_url;
            $obj->customer_social_media = 2;

            if ($obj->save()) {
                Yii::app()->user->id = $obj->customer_id;
                echo 1;
                //User Registered Successfully
            } else {
                echo 2;
                //User registration fail
            }
        }
    }

    public function actionIndex() {
        $this->render('index');
    }

    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(array('site/login'));
    }

    public function actionRegister() {
        $model = new RegisterForm;

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'sky-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['RegisterForm'])) {
            $model->attributes = $_POST['RegisterForm'];
            if ($model->validate()) {
                $model->confirmpassword = md5($model->confirmpassword);
                $model->customer_password = md5($model->customer_password);
                $model->customer_created = date('Y-m-d H:i:s');

                if ($model->save()) {
                    Yii::app()->user->setFlash('type', 'success');
                    Yii::app()->user->setFlash('message', 'You are registered successfully!');
                } else {
                    Yii::app()->user->setFlash('type', 'danger');
                    Yii::app()->user->setFlash('message', 'Your registration has been failed! Try again later.');
                }
                $this->refresh();
            }
        }

        $this->render('register', array('model' => $model));
    }

    public function actionForgotPassword() {
        if (!empty(Yii::app()->user->id)) {
            $this->redirect(Yii::app()->user->returnUrl);
        }

        $model = new CustomerForgotPasswordForm;

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'sky-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['CustomerForgotPasswordForm'])) {
            $model->attributes = $_POST['CustomerForgotPasswordForm'];
            if ($model->validate() && $model->login()) {
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }

        $this->render('forgot_password', array('model' => $model));
    }

    public function actionPostProject() {
        $model = new Project;

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'sky-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['Project'])) {
            $model->attributes = $_POST['Project'];

            $skills = $_POST['project_skills'];
            $model->project_skills = implode(",", $skills);
            $model->project_customerID = Yii::app()->user->id;
            $model->project_created = date('Y-m-d H:i:s');

            $model->project_files = '';
            if (isset($_POST['gallery']) && !empty($_POST['gallery'])) {
                $gallery = $_POST['gallery'];
                $model->project_files = implode(',', $gallery);
            }

//            echo '<pre>';
//            print_r($_POST);
//            print_r($model->attributes);
//            die;

            if ($model->save()) {

                if (isset($_POST['remgallery'])) {
                    $remgallery = $_POST['remgallery'];
                }

                $base_path_temp = Yii::app()->basePath . '/../bootstrap/upload/project/temp/';
                if (!empty($remgallery)) {
                    foreach ($remgallery as $filename) {
                        if (file_exists($base_path_temp . $filename)) {
                            unlink($base_path_temp . $filename);
                        }
                    }
                }

                $base_path_original = Yii::app()->basePath . '/../bootstrap/upload/project/';
                if (isset($gallery) && !empty($gallery)) {
                    if (count($gallery) > 0) {
                        foreach ($gallery as $filename) {
                            rename($base_path_temp . $filename, $base_path_original . $filename);
                        }
                    }
                }

                Yii::app()->user->setFlash('type', 'success');
                Yii::app()->user->setFlash('message', 'Your project is posted successfully!');
            } else {
                Yii::app()->user->setFlash('type', 'danger');
                Yii::app()->user->setFlash('message', 'Operation is failed! Try again later.');
            }
            $this->refresh();
        }

        $this->render('postproject', array('model' => $model));
    }

    public function actionUpload() {
        $rnd = rand(1111, 9999) . date('Ymdhi');
        $userfile_extn = explode(".", strtolower($_FILES['file']['name']));
        $count = count($userfile_extn);
        $fileName = $rnd . "." . $userfile_extn[$count - 1];

        $base_path_temp = Yii::app()->basePath . '/../bootstrap/upload/project/temp/';

        if (move_uploaded_file($_FILES['file']["tmp_name"], $base_path_temp . $fileName)) {
            echo json_encode(array('fname' => $fileName));
        } else {
            echo "1";
        }
    }

    public function actionRemove() {
        $filename = $_POST['file'];

        if (!empty($filename)) {
            $base_path_temp = Yii::app()->basePath . '/../bootstrap/upload/project/temp/' . $filename;
            if (file_exists($base_path_temp)) {
                unlink($base_path_temp);
            }
        }

        echo 'File unlinked!';
    }

}
