<?php

/**
 * RegisterForm class.
 * RegisterForm is the data structure for keeping
 * user register form data. It is used by the 'register' action of 'SiteController'.
 */
class RegisterForm extends CActiveRecord {

    public $confirmpassword;
    public $terms;

    public function tableName() {
        return '{{customer}}';
    }

    public function rules() {
        return array(
            array('customer_email, customer_username, customer_password, confirmpassword', 'required', 'message' => 'Please enter {attribute}'),
            array('customer_roleID', 'required', 'message' => 'Please select a role.'),
            array('terms', 'required', 'message' => 'Please accept the Terms and Conditions.'),
            array('customer_password', 'length', 'min' => 6, 'max' => 64),
            //array('customer_password', 'compare', 'compareAttribute' => 'confirmpassword'),
            array('confirmpassword', 'compare', 'compareAttribute' => 'customer_password'),
            array('customer_email', 'email'),
            array('customer_email,  customer_username', 'unique'),
            array('confirmpassword', 'safe'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'customer_email' => 'Email',
            'customer_username' => 'Username',
            'customer_password' => 'Password',
            'confirmpassword' => 'Confirm Password',
            'customer_roleID' => 'I want to',
        );
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
