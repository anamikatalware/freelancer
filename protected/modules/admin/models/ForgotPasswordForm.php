<?php

class ForgotPasswordForm extends CFormModel {

    public $email;

    public function rules() {
        return array(
            array('email', 'required'),
            array('email', 'email'),
        );
    }

    public function attributeLabels() {
        return array(
            'email' => 'Email'
        );
    }

    public function checkEmail() {
        $email = $this->email;

        $user = User::model()->findByAttributes(array('user_email' => $email));

        if (!empty($user)) {

            $code = $user->user_id . date('YmdHis');
            $code = base64_encode(base64_encode($code));

            $user->user_resetcode = $code;
            $user->user_resettime = time();

            if ($user->update()) {
                //Send Mail for New Password Link
                $utils = new Utils;

                $user_name = $user->user_firstname . ' ' . $user->user_lastname;
                $userdata['username'] = $user_name;
                $userdata['verification_link'] = 'http://' . $_SERVER['HTTP_HOST'] . '/admin/site/resetpassword?code=' . $code;

                $template = Template::model()->findByAttributes(array('template_alias' => 'forgot-password---admin-template'));

                $subject = $utils->replace($userdata, $template->template_subject);
                $message = $utils->replace($userdata, $template->template_content);

                $email = $user->user_email;

                $utils->Send($email, $userdata['username'], $subject, $message);
            }

            return 1;
        } else {
            return 0;
        }
    }

}
