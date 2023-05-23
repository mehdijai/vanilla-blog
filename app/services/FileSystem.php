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
                echo "Failed to create directory.";
            }
        }

        return self::TARGET_DIR;
    }

    public static function uploadImage($image, string $fileName = null)
    {
        $imageFileType = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
        $target_file = self::getUploadDir() . ($fileName == null ? basename($image["name"]) : $fileName . "." . $imageFileType);

        // Check if image file is a actual image or fake image
        $valid = true;
        $check = getimagesize($image["tmp_name"]);
        if ($check !== false) {
            $valid = true;
        } else {
            echo "File is not an image.\n";
            $valid = false;
        }

        // Check file size
        if ($image["size"] > self::IMAGE_MAX_SIZE) {
            echo "Sorry, your file is too large.\n";
            $valid = false;
        }

        // Allow certain file formats
        if (
            !in_array($imageFileType, self::IMAGE_ALLOWED_TYPES)
        ) {
            echo "Sorry, only " . join(" & ", self::IMAGE_ALLOWED_TYPES) . " files are allowed.\n";
            $valid = false;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($valid == false) {
            echo "Sorry, your file was not uploaded.\n";
            // if everything is ok, try to upload file
        } else {
            if (!move_uploaded_file($image["tmp_name"], $target_file)) {
                echo "Sorry, there was an error uploading your file.\n";
            }
        }

        return $target_file;
    }
}
