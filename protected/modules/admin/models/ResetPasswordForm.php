<?php

class ResetPasswordForm extends CFormModel {

    public $password_new, $password_confirmation;

    public function rules() {
        return array(
            array('password_new, password_confirmation', 'required'),
            array('password_new', 'compare', 'compareAttribute' => 'password_confirmation'),
            array('password_new, password_confirmation', 'length', 'min' => 6, 'max' => 16),
        );
    }

    public function attributeLabels() {
        return array(
            'password_new' => 'New Password',
            'password_confirmation' => 'Confirm New Password',
        );
    }

    public static function sendPasswordChangeMail($user) {
        $utils = new Utils;

        $user_name = $user->user_firstname . ' ' . $user->user_lastname;
        $userdata['username'] = $user_name;

        $template = Template::model()->findByAttributes(array('template_alias' => 'change-password---admin-dashboard'));

        $subject = $utils->replace($userdata, $template->template_subject);
        $message = $utils->replace($userdata, $template->template_content);

        $email = $user->user_email;

        $utils->Send($email, $userdata['username'], $subject, $message);
    }

}
