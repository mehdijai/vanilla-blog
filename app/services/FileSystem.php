<?php

class FileSystem
{
    private const TARGET_DIR = "public/uploads/";
    private const IMAGE_MAX_SIZE = 5000000;
    private const IMAGE_ALLOWED_TYPES = ['jpg', 'png', 'jpeg'];

    private static function getUploadDir()
    {
        if (!is_dir(self::TARGET_DIR)) {
            if (!mkdir(self::TARGET_DIR, 0777, true)) {
                throw new Exception("Failed to create directory.");
            }
        }

        return self::TARGET_DIR;
    }

    public static function uploadImage($image, string $fileName = null)
    {

        $imageFileType = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
        $target_file = self::getUploadDir() . ($fileName == null ? basename($image["name"]) : $fileName . "." . $imageFileType);

        $valid = true;
        $check = getimagesize($image["tmp_name"]);
        if ($check !== false) {
            $valid = true;
        } else {
            throw new Exception("File is not an image.");
            $valid = false;
        }

        if ($image["size"] > self::IMAGE_MAX_SIZE) {
            throw new Exception("Sorry, your file is too large.");
            $valid = false;
        }

        if (
            !in_array($imageFileType, self::IMAGE_ALLOWED_TYPES)
        ) {
            throw new Exception("Sorry, only " . join(" & ", self::IMAGE_ALLOWED_TYPES) . " files are allowed.");
            $valid = false;
        }

        if ($valid == false) {
            throw new Exception("Sorry, your file was not uploaded.");
        } else {
            if (!move_uploaded_file($image["tmp_name"], $target_file)) {
                throw new Exception("Sorry, there was an error uploading your file.");
            }
        }

        return $target_file;
    }
}
