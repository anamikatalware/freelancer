<?php

class CustomerController extends UserController {

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'getExpData'),
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {

        if (isset($_POST)) {
            // Below post && Ajax for publication.
            if ((isset($_POST['ajax']) && $_POST['ajax'] === 'sky-publication') || isset($_POST['Publication'])) {
                $this->checkPublication();
            }
            // Below post && Ajax for Certificate.  
            if ((isset($_POST['ajax']) && $_POST['ajax'] === 'sky-certification') || isset($_POST['Certification'])) {
                $this->checkCertification();
            }

            // Below post && Ajax for Experience.  
            if ((isset($_POST['ajax']) && $_POST['ajax'] === 'sky-experience') || isset($_POST['Experience'])) {
                $this->checkExperience();
            }

            // Below post && Ajax for Education.  
            if ((isset($_POST['ajax']) && $_POST['ajax'] === 'sky-education') || isset($_POST['Education'])) {
                $this->checkEducation();
            }
        }

        $this->render('index');
    }

    public function actionSettings() {
        if (isset($_POST)) {
            if ((isset($_POST['ajax']) && $_POST['ajax'] === 'sky-profile') || isset($_POST['Customer'])) {
                $this->updCustomerProfile();
            }

            if ((isset($_POST['ajax']) && $_POST['ajax'] === 'sky-change-pass') || isset($_POST['CustomerChangePasswordForm'])) {
                $this->updPassword();
            }

            if (isset($_POST) && !empty($_POST)) {
                if (isset($_POST['account_type']) && !empty($_POST['account_type'])) {
                    $account_type = $_POST['account_type'];
                    $customer = Customer::model()->getCustomerProfile();
                    $customer->customer_roleID = $account_type;
                    
                    if ($customer->update()) {
                        Yii::app()->user->setFlash('type', 'success');
                        Yii::app()->user->setFlash('message', 'Account has beed updated successfully!');
                    } else {
                        Yii::app()->user->setFlash('type', 'danger');
                        Yii::app()->user->setFlash('message', 'Account update failed! Try again later.');
                    }
                    $this->refresh();
                }
            }
        }
        $this->render('settings');
    }

    public function updPassword() {
        $model = new CustomerChangePasswordForm();

        if (isset($_POST['ajax'])) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['CustomerChangePasswordForm'])) {
            $model->attributes = $_POST['CustomerChangePasswordForm'];
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

                //$this->redirect(array('site/profile'));
            }
        }
    }

    // setting page update & save
    private function updCustomerProfile() {
        $model = new Publication();
        if (isset($_POST['ajax'])) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (isset($_POST['Customer'])) {
            $model = Customer::model()->getCustomerProfile();
            $model->attributes = $_POST['Customer'];

            /*
              print_r($_POST);
              print_r($model->attributes);
              die;
             */

            if ($model->save()) {
                Yii::app()->user->setFlash('type', 'success');
                Yii::app()->user->setFlash('message', 'Profile has beed updated successfully!');
            } else {
                Yii::app()->user->setFlash('type', 'danger');
                Yii::app()->user->setFlash('message', 'Profile update failed! Try again later.');
            }
            $this->refresh();
        }
    }

    private function checkPublication() {
        $model = new Publication();
        if (isset($_POST['ajax'])) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (isset($_POST['Publication'])) {

            $id = $_POST['id'];
            if ($id) {
                $model = Publication::model()->findByPk($id);
                $model->attributes = $_POST['Publication'];
            } else {
                $model->attributes = $_POST['Publication'];
                $model->publication_customerID = Yii::app()->user->id;
                $model->publication_created = date('Y-m-d');
            }

            if ($model->save()) {
                Yii::app()->user->setFlash('type', 'success');
                Yii::app()->user->setFlash('message', ' Publication has beed added successfully!');
            } else {
                Yii::app()->user->setFlash('type', 'danger');
                Yii::app()->user->setFlash('message', 'Publication has been failed! Try again later.');
            }
            $this->refresh();
        }
    }

    private function checkCertification() {
        $model = new Certification();
        if (isset($_POST['ajax'])) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (isset($_POST['Certification'])) {

            $id = $_POST['id'];
            if ($id) {
                $model = Certification::model()->findByPk($id);
                $model->attributes = $_POST['Certification'];
            } else {
                $model->attributes = $_POST ['Certification'];
                $model->certification_customerID = Yii::app()->user->id;
                $model->certification_created = date('Y-m-d');
            }

            if
            ($model->save()) {
                Yii::app()->user->setFlash('type', 'success');
                Yii::app()->user->setFlash('message', ' Certification has beed added successfully!');
            } else {
                Yii::app()->user->setFlash('type', 'danger');
                Yii::app()->user->setFlash('message', 'Certification has been failed! Try again later.');
            }
            $this->refresh();
        }
    }

    private function checkExperience() {
        $model = new Experience();
        if (isset($_POST['ajax'])) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (isset($_POST['Experience'])) {

            $id = $_POST['id'];
            if ($id) {
                $model = Experience::model()->findByPk($id);
                $model->attributes = $_POST['Experience'];
            } else {
                $model->attributes = $_POST['Experience'];
                $model->experience_customerID = Yii::app()->user->id;
                $model->experience_created = date('Y-m-d');
            }

            if ($model->save()) {
                Yii::app()->user->setFlash('type', 'success');
                Yii::app()->user->setFlash('message', ' Experience has beed added successfully!');
            } else {
                Yii::app()->user->setFlash('type', 'danger');
                Yii::app()->user->setFlash('message', 'Experience has been failed! Try again later.');
            }
            $this->refresh();
        }
    }

    private function checkEducation() {
        $model = new Education();
        if (isset($_POST['ajax'])) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (isset($_POST['Education'])) {
            $id = $_POST['id'];
            if ($id) {
                $model = Education::model()->findByPk($id);
                $model->attributes = $_POST['Education'];
            } else {
                $model->attributes = $_POST['Education'];
                $model->education_customerID = Yii::app()->user->id;
                $model->education_created = date('Y-m-d');
            }

            if ($model->save()) {
                Yii::app()->user->setFlash('type', 'success');
                Yii::app()->user->setFlash('message', ' Experience has beed added successfully!');
            } else {
                Yii::app()->user->setFlash('type', 'danger');
                Yii::app()->user->setFlash('message', 'Experience has been failed! Try again later.');
            }
            $this->refresh();
        }
    }

    function actionGetExpData() {
        $id = $_POST['id'];

        $model = Experience::model()->findByPk($id);
        echo json_encode($model->attributes);
    }

    function actionGetCertData() {
        $id = $_POST['id'];
        $model = Certification::model()->findByPk($id);

        echo json_encode($model->attributes);
    }

    function actionGetPubData() {
        $id = $_POST['id'];
        $model = Publication::model()->findByPk($id);
        echo json_encode($model->attributes);
    }

    public function actionGetEduData() {

        $id = $_POST['id'];
        $model = Education::model()->findByPk($id);
        echo json_encode($model->attributes);
    }

    /* Delete function for setting profile */

    function actionDelEdu() {
        $id = $_POST['id'];
        Education::

        model()->deleteByPk($id);
        echo 0;
    }

    function actionDelPub() {

        $id = $_POST['id'];
        Publication::model()->deleteByPk($id);
        echo 0;
    }

    function actionDelExp() {
        $id = $_POST['id'];

        Experience::model()->deleteByPk($id);
        echo 0;
    }

    function actionDelcert() {
        $id = $_POST['id'];
        Certification::model()->deleteByPk($id);
        echo 0;
    }

    public function actionPortfolio() {
        $this->render('portfolio');
    }

    public function actionAjaxGetBudget() {
        $currency = $_POST['currency'];
        $budget = Customer::getBudget($currency);

        echo $budget;
    }

    public function actionSkills() {
        $subcategories = $_POST['subcategory'];
        $current_user = Yii::app()->user->id;

        CustomerSkills::model()->deleteAllByAttributes(array('skill_customerID' => $current_user));

        if (!empty($subcategories)) {
            foreach ($subcategories as $sub) {
                $model = new CustomerSkills();
                $model->skill_customerID = $current_user;
                $model->skill_subcategoryID = $sub;
                $model->skill_created = date('Y-m-d H:i:s');
                $model->skill_status = 1;
                $model->save();
            }
        }

        $this->redirect(Yii::app()->createAbsoluteUrl('profile'));
    }

}
