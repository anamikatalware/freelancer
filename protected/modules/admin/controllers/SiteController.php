<?php

class SiteController extends AdminController {

    public $layout = '/layouts/column1';

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
                'actions' => array('login', 'error', 'forgotpassword', 'resetpassword'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('index', 'logout', 'about', 'page', 'changepassword', 'profile'),
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest) {
                echo $error['message'];
            } else {
                $this->render('error', $error);
            }
        }
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {

        //echo password_hash('123456', PASSWORD_DEFAULT);die;

        $this->layout = '/layouts/login';
        if (!Yii::app()->user->isGuest) {
            $this->redirect(array('site/index'));
        }
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                //$this->redirect(array('site/index', 'lang' => Yii::app()->language));
                $this->redirect(array('site/index'));
            }
        }
        // display the login form
        //$this->render('login', array('model' => $model, 'lang' => Yii::app()->language));
        $this->render('login', array('model' => $model));
    }

    public function actionIndex() {
        $user = User::getUserProfile();
        if (empty($user)) {
            Yii::app()->user->logout();
            $this->redirect(array('site/login'));
        }
        $this->render('index');
    }

    public function actionForgotpassword() {

        $this->layout = '/layouts/login';
        if (!Yii::app()->user->isGuest) {
            $this->redirect(array('site/index'));
        }
        $model = new ForgotPasswordForm();

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'forgot-password-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['ForgotPasswordForm'])) {
            $model->attributes = $_POST['ForgotPasswordForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate()) {
                if ($model->checkEmail()) {
                    Yii::app()->user->setFlash('type', 'success');
                    Yii::app()->user->setFlash('message', 'Reset Password Link has been sent to your Registered Email Address!');
                } else {
                    Yii::app()->user->setFlash('type', 'danger');
                    Yii::app()->user->setFlash('message', 'This email address is not exists!');
                }
            }
        }

        $this->render('forgot_password', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(array('site/login'));
    }

    public function actionResetpassword() {

        $this->layout = '/layouts/login';

        $code = $_REQUEST['code'];

        $user = User::model()->findByAttributes(array('user_resetcode' => $code));
        if (!empty($user)) {
            //Do Reset Password Page

            $resettime = $user->user_resettime + 900; //Seconds
            $currenttime = time();
            $diff = ($resettime - $currenttime);

            if ($diff > 0) {
                //Reset Password Page

                if (isset($_POST) && !empty($_POST)) {
                    $password_new = $_POST['ResetPasswordForm']['password_new'];

                    $user->user_password = CPasswordHelper::hashPassword($password_new);
                    $user->user_resetcode = '';
                    $user->user_resettime = '';
                    if ($user->update()) {
                        //ResetPasswordForm::model()->sendPasswordChangeMail($user);
                        Yii::app()->user->setFlash('type', 'success');
                        Yii::app()->user->setFlash('message', 'Password reset successfully!');
                        $this->redirect(array('site/login'));
                    } else {
                        Yii::app()->user->setFlash('type', 'danger');
                        Yii::app()->user->setFlash('message', 'Reset Password fail!');
                        $this->render('reset_password');
                    }
                }

                $this->render('reset_password');
            } else {
                //Verification Link is Expired!
                Yii::app()->user->setFlash('type', 'danger');
                Yii::app()->user->setFlash('message', 'Verification Link has been Expired!');
                $this->render('resetpassword_invalidpage');
            }
        } else {
            //Return an Error Meesage and Redirect it to User
            Yii::app()->user->setFlash('type', 'danger');
            Yii::app()->user->setFlash('message', 'Invalid Verfication Link!');
            $this->render('resetpassword_invalidpage');
        }


        //$this->redirect(array('site/login'));
    }

    public function actionProfile() {

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'profile-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['User'])) {
            $user_id = Yii::app()->user->id;
            $model = User::model()->findByPk($user_id);
            $model->attributes = $_POST['User'];
            if ($model->update()) {
                Yii::app()->user->setFlash('type', 'success');
                Yii::app()->user->setFlash('message', 'Profile updated successfully.');
            } else {
                Yii::app()->user->setFlash('type', 'danger');
                Yii::app()->user->setFlash('message', 'Profile update fail!');
            }
            $this->redirect(array('site/profile'));
        }

        $this->render('profile');
    }

    public function actionChangePassword() {
        $model = new ChangePasswordForm();

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'change-password-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['ChangePasswordForm'])) {
            $model->attributes = $_POST['ChangePasswordForm'];
            if ($model->validate()) {
                $num = $model->changePassword();

                switch ($num) {
                    case 1:
                        Yii::app()->user->setFlash('type', 'success');
                        Yii::app()->user->setFlash('message', 'Password changed successfully.');
                        break;
                    case 2:
                        Yii::app()->user->setFlash('type', 'warning');
                        Yii::app()->user->setFlash('message', 'Password changed failed!');
                        break;
                    case 3:
                        Yii::app()->user->setFlash('type', 'warning');
                        Yii::app()->user->setFlash('message', 'Old Password is incorrect!');
                        break;
                    case 4:
                        Yii::app()->user->setFlash('type', 'danger');
                        Yii::app()->user->setFlash('message', 'Invalid User!');
                        break;
                    default :
                        Yii::app()->user->setFlash('type', 'danger');
                        Yii::app()->user->setFlash('message', 'Invalid User!');
                        break;
                }

                $this->redirect(array('site/profile'));
            }
        }
    }

}
