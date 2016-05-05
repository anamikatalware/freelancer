<?php

class CustomerIdentity extends CUserIdentity {

    private $_id;
    private $_role_id;
    private $_role_name;

    public function getId() {
        return $this->_id;
    }

    public function getRoleId() {
        return $this->_role_id;
    }

    public function getRoleName() {
        return $this->_role_name;
    }

    public function authenticate() {
        if (strpos($this->username, '@') === false) {
            $user = RegisterForm::model()->findByAttributes(array('customer_username' => strtolower($this->username)));
        } else {
            $user = RegisterForm::model()->findByAttributes(array('customer_email' => strtolower($this->username)));
        }

        if (empty($user)) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else if ($user->customer_password != md5($this->password)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            if ($user->customer_status == 1) {
                $this->errorCode = 6; //Enabled

                $this->_id = $user->customer_id;
                $this->_role_id = $user->customer_roleID;
                $role_id = $this->_role_id;
                $this->errorCode = self::ERROR_NONE;
            } else if ($user->user_status == 0) {
                $this->errorCode = 7; //Disabled
            }
        }

        return !$this->errorCode;
    }

}
