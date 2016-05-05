<?php

class CustomerForgotPasswordForm extends CFormModel {

    public $username;

    public function rules() {
        return array(
            array('username', 'required'),
            array('username', 'email'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'username' => 'E-mail'
        );
    }

}
