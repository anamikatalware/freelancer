<?php

class Utils {

    public static function getLabels($num) {
        switch ($num) {
            case 1:
                $label = '<label class="label label-success">Active</label>';
                break;
            case 2:
                $label = '<label class="label label-danger">Inactive</label>';
                break;
            case 3:
                //For No
                $label = '<label class="label label-warning">No</label>';
                break;
            case 4:
                //For Yes
                $label = '<label class="label label-info">Yes</label>';
                break;
            default :
                $label = '<label class="label label-danger">Inactive</label>';
                break;
        }

        return $label;
    }

    public static function getDefaultFeaturedImage($size) {
        switch ($size) {
            case 'full':
                $name = 'noImageAvailable_280_280.png';
                break;
            case 'medium':
                $name = 'noImageAvailable_200_200.png';
                break;
            case 'small':
                $name = 'noImageAvailable_100_100.png';
                break;
            case 'extra-small':
                $name = 'noImageAvailable_50_50.png';
                break;
        }

        return Yii::app()->baseUrl . '/bootstrap/upload/' . $name;
    }

    public static function getDuration() {
        $duration = array(
            'Hours' => 'Hours',
            'Minutes' => 'Minutes',
            'Seconds' => 'Seconds'
        );
        return $duration;
    }

    public static function getPathFeaturedImage($image, $size, $class = '', $path = true) {
        switch ($size) {
            case 'full':
                $name = Yii::app()->baseUrl . '/bootstrap/upload/tours/original/';
                break;
            case 'medium':
                $name = Yii::app()->baseUrl . '/bootstrap/upload/tours/medium/';
                break;
            case 'small':
                $name = Yii::app()->baseUrl . '/bootstrap/upload/tours/small/';
                break;
            case 'extra_small':
                $name = Yii::app()->baseUrl . '/bootstrap/upload/tours/extra_small/';
                break;
        }

        if ($path) {
            return '<img src="' . $name . $image . '" class="' . $class . '" />';
        } else {
            return $name . $image;
        }
    }

    public static function getPathFlag($image, $size, $class = '', $path = true) {
        switch ($size) {
            case 'full':
                $name = Yii::app()->baseUrl . '/bootstrap/upload/flags/original/';
                break;
            case 'small':
                $name = Yii::app()->baseUrl . '/bootstrap/upload/flags/small/';
                break;
        }

        if ($path) {
            if ($image == '') {
                return '';
            } else {
                return '<img src="' . $name . $image . '" class="' . $class . '" />';
            }
        } else {
            return $name . $image;
        }
    }

    public static function getRandomPassword($length = 8) {
        $characters = '123456789ABCDEFGHJKLMNPQRSTUVWXYZ@#$%';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    private function Encryption_Key() {
        $string = 'd0a7e7997b6d5fcd55f4b5c32611b87cd923e88837b63bf2941ef819dc8ca282';
        return $string;
    }

    private function mc_encrypt($encrypt, $key) {
        $encrypt = serialize($encrypt);
        $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM);
        $key = pack('H*', $key);
        $mac = hash_hmac('sha256', $encrypt, substr(bin2hex($key), -32));
        $passcrypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $encrypt . $mac, MCRYPT_MODE_CBC, $iv);
        $encoded = base64_encode($passcrypt) . '|' . base64_encode($iv);
        return $encoded;
    }

    private function mc_decrypt($decrypt, $key) {
        $decrypt = explode('|', $decrypt . '|');
        $decoded = base64_decode($decrypt[0]);
        $iv = base64_decode($decrypt[1]);
        if (strlen($iv) !== mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)) {
            return false;
        }
        $key = pack('H*', $key);
        $decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $decoded, MCRYPT_MODE_CBC, $iv));
        $mac = substr($decrypted, -64);
        $decrypted = substr($decrypted, 0, -64);
        $calcmac = hash_hmac('sha256', $decrypted, substr(bin2hex($key), -32));
        if ($calcmac !== $mac) {
            return false;
        }
        $decrypted = unserialize($decrypted);
        return $decrypted;
    }

    function passwordEncrypt($password) {
        return $this->mc_encrypt($password, $this->Encryption_Key());
    }

    function passwordDecrypt($password) {
        return $this->mc_decrypt($password, $this->Encryption_Key());
    }

    public static function replace($array, $str) {
        foreach ($array as $key => $value) {
            $str = str_replace("$" . $key, $value, $str);
        }
        return $str;
    }

    public static function Send($to, $to_name, $subject, $message) {
        Yii::import('application.extensions.phpmailer.JPhpMailer');
        $mail = new JPhpMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com:465';
        $mail->SMTPSecure = "ssl";
        $mail->SMTPAuth = true;
        $mail->Username = 'canries.test@gmail.com';
        $mail->Password = 'pratik1234';
        $mail->SetFrom('canries.test@gmail.com', 'Canries');
        $mail->Subject = $subject;
        $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
        $mail->MsgHTML($message);
        $mail->AddAddress($to, $to_name);
        //$mail->AddBCC('support@fitnesspermit.com', 'FITNESS PERMIT');
        //$mail->AddBCC('sonnylaskar@gmail.com', 'FITNESS PERMIT');
        //print_r($mail);die;

        if ($mail->Send()) {
            return true;
        } else {
            return false;
        }
    }

}
