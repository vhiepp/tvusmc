<?php

namespace App\Helpers;

class UploadHelper {
    public static function resize_crop_image($max_width, $max_height, $source_file, $dst_dir, $quality = 80) {
		$imgsize = getimagesize($source_file);
		$width = $imgsize[0];
		$height = $imgsize[1];
		$mime = $imgsize['mime'];

		switch ($mime) {
			case 'image/gif':
				$image_create = "imagecreatefromgif";
				$image = "imagegif";
				break;
			case 'image/png':
				$image_create = "imagecreatefrompng";
				$image = "imagepng";
				$quality = 7;
				break;
			case 'image/jpeg':
				$image_create = "imagecreatefromjpeg";
				$image = "imagejpeg";
				$quality = 80;
				break;
			default:
				return false;
				break;
		}

		$dst_img = imagecreatetruecolor($max_width, $max_height);
		$src_img = $image_create($source_file);

		$width_new = $height * $max_width / $max_height;
		$height_new = $width * $max_height / $max_width;

		if ($width_new > $width) {
			$h_point = (($height - $height_new) / 2);
			imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
		} else {
			$w_point = (($width - $width_new) / 2);
			imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
		}

		$image ($dst_img, $dst_dir, $quality);

		if ($dst_img) imagedestroy($dst_img);
		if ($src_img) imagedestroy($src_img);
	}

    public static function imgToBase64($file = null,
                                        $size = null) {

        try {
            if ($file != null) {

                $folder = 'updates_cache/';
                $fileName =  'images.' . $file->getClientOriginalExtension();
                $path = $folder . $fileName;
                $fileUrl = $file->move($folder, $fileName);

                if ($size) {
                    self::resize_crop_image(
                        $size['w'],
                        $size['h'],
                        $path,
                        $path,
                        80
                    );
                }

                $type = pathinfo($path, PATHINFO_EXTENSION);

                $data = file_get_contents($path);

                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

                unlink($path);

                return $base64;
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
        return false;
    }
}