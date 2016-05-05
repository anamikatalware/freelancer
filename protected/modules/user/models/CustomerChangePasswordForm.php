<?php

class CustomerChangePasswordForm extends CFormModel {

    public $password_old;
    public $password_new;
    public $password_confirmation;

    public function rules() {
        return array(
            array('password_old, password_new, password_confirmation', 'required'),
            array('password_new', 'compare', 'compareAttribute' => 'password_confirmation'),
            array('password_new, password_confirmation', 'length', 'min' => 6, 'max' => 16),
        );
    }

    public function attributeLabels() {
        return array(
            'password_old' => 'Current Password',
            'password_new' => 'New Password',
            'password_confirmation' => 'Confirm New Password',
        );
    }

    public function changePassword() {
        $password_old = $this->password_old;
        $password_new = $this->password_new;
        $user_id = Yii::app()->user->id;

        $user = Customer::model()->findByPk($user_id);

        if (!empty($user)) {
            if (CPasswordHelper::verifyPassword($password_old, $user->customer_password)) {
                $user->customer_password = CPasswordHelper::hashPassword($password_new);
                if ($user->update()) {
                    //ResetPasswordForm::model()->sendPasswordChangeMail($user);
                    return 1;
                } else {
                    return 2;
                }
            } else {
                return 3;
            }
        } else {
            return 4;
        }
    }

}
