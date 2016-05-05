<?php

class ImageThumbnail {

    public function CreateImageThumbnail($temp_path, $img_thumbnail_path, $extension, $width = 300, $height = 300) {

        //Create Thumbnail Image from Original Image        
        switch ($extension) {
            case 'jpg':
                $img = imagecreatefromjpeg("$temp_path");
                break;
            case 'jpeg':
                $img = imagecreatefromjpeg("$temp_path");
                break;
            case 'png':
                $img = imagecreatefrompng("$temp_path");
                break;
            case 'gif':
                $img = imagecreatefromgif("$temp_path");
                break;
            default:
                $img = imagecreatefromjpeg("$temp_path");
        }

        $original_width = imagesx($img);
        $original_height = imagesy($img);

        $thumbnail_height = $height;
        $thumbnail_width = $width;

        // create a new temporary image
        $tmp_img = imagecreatetruecolor($thumbnail_width, $thumbnail_height);

        //select background color using number between 0 to 255
        $color = imagecolorallocate($tmp_img, 255, 255, 255);
        imagefill($tmp_img, 0, 0, $color);

        // copy and resize old image into new image
        imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $thumbnail_width, $thumbnail_height, $original_width, $original_height);

        // save thumbnail into a file
        $result = imagejpeg($tmp_img, $img_thumbnail_path, 100);

        imagedestroy($tmp_img);
        imagedestroy($img);

        if ($result) {
            return 1;
        } else {
            return 0;
        }
    }

}
