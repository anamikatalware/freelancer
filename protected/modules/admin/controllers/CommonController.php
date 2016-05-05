<?php

class CommonController extends Controller {

    public function actionUpload() {
        $rnd = rand(1111, 9999) . date('Ymdhi');
        $userfile_extn = explode(".", strtolower($_FILES['file']['name']));
        $count = count($userfile_extn);
        $fileName = $rnd . "." . $userfile_extn[$count - 1];

        $base_path_temp = Yii::app()->basePath . '/../bootstrap/upload/tours/temp/';

        if (move_uploaded_file($_FILES['file']["tmp_name"], $base_path_temp . $fileName)) {
            echo json_encode(array('fname' => $fileName));
        } else {
            echo "1";
        }
    }

}
