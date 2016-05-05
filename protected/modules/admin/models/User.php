<?php

class User extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @return CActiveRecord the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{user}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            //array('username', 'CRegularExpressionValidator', 'pattern' => '/^([0-9a-z]+)$/'),
            //array('user_password, repeatPassword, email', 'length', 'min' => 6, 'max' => 100),
            //array('user_password', 'compare', 'compareAttribute' => 'repeatPassword'),
            array('user_firstname, user_lastname', 'length', 'max' => 100),
            array('user_email', 'unique'),
            array('user_email', 'email'),
            array('user_firstname, user_lastname, user_email', 'required'),
            array('user_password', 'filter', 'filter' => array($obj = new CHtmlPurifier(), 'purify')),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'user_id' => 'ID',
            'user_firstname' => 'First Name',
            'user_lastname' => 'Last Name',
            'user_email' => 'Email',
            'user_password' => 'Password',
            'user_created' => 'Created',
            'user_status' => 'Status',
        );
    }

    public static function getUserProfile() {
        $user_id = Yii::app()->user->id;
        $user = User::model()->findByPk($user_id);
        return $user;
    }

}
