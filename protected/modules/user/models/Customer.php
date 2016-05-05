<?php

class Customer extends CActiveRecord {

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
        return '{{customer}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('customer_username', 'required'),
            //array('customername', 'CRegularExpressionValidator', 'pattern' => '/^([0-9a-z]+)$/'),
            //array('customer_password, repeatPassword, email', 'length', 'min' => 6, 'max' => 100),
            //array('customer_password', 'compare', 'compareAttribute' => 'repeatPassword'),
            array('customer_firstname, customer_lastname', 'length', 'max' => 100),
            array('customer_email', 'unique'),
            array('customer_email', 'email'),
            array('customer_firstname, customer_lastname, customer_email', 'required'),
            array('customer_address1, customer_address2, customer_city,customer_pincode,customer_state,customer_company,customer_location', 'safe'),
            array('customer_password', 'filter', 'filter' => array($obj = new CHtmlPurifier(), 'purify')),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'customer_id' => 'ID',
            'customer_firstname' => 'First Name',
            'customer_lastname' => 'Last Name',
            'customer_address1' => 'Address Line 1',
            'customer_address2' => 'Address Line 2',
            'customer_city' => 'City',
            'customer_pincode' => 'Pin Code',
            'customer_state' => 'State',
            'customer_company' => 'Company',
            'customer_location' => 'Location',
            'customer_email' => 'Email',
            'customer_password' => 'Password',
            'customer_created' => 'Created',
            'customer_status' => 'Status',
        );
    }

    public static function getCustomerProfile() {
        $customer_id = Yii::app()->user->id;
        $customer = Customer::model()->findByPk($customer_id);
        return $customer;
    }

    public static function getBudget($currency_id) {
        $string = '';
        $currency = Currency::model()->findByPk($currency_id);
        $budgets = Budget::model()->findAllByAttributes(array('budget_currencyID' => $currency_id, 'budget_budgettypeID' => 1), array('order' => 'budget_order'));
        if (!empty($budgets)) {
            foreach ($budgets as $budget) {
                $price_range = $currency->currency_icon . $budget->budget_min_value . ' - ' . $currency->currency_icon . $budget->budget_max_value;
                if (empty($budget->budget_max_value)) {
                    $price_range = $currency->currency_icon . ' > ' . $budget->budget_min_value;
                }

                $name = $budget->budget_name . ' (' . $price_range . ' ' . $currency->currency_code . ')';
                $id = $budget->budget_id;
                $string .= '<option value="' . $id . '">' . $name . '</option>';
            }
        }

        return $string;
    }

}
