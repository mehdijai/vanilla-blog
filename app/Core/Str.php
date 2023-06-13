<?php

namespace App\Core;

class Str
{
    public static function toKebabCase(string $input)
    {
        $output = preg_replace('/[\s_]+/', '-', $input);
        $output = strtolower($output);
        return $output;
    }
    public static function toCamelCase(string $input, bool $withCapital = false)
    {
        $output = preg_replace('/[\s-]+/', ' ', $input);

        $output = ucwords($output);

        $output = str_replace(array(' ', '-'), '', $output);

        if (!$withCapital) {
            $output = lcfirst($output);
        }

        return $output;
    }
    public static function toSnakeCase(string $input)
    {
        $output = preg_replace('/[\s-]+/', '_', $input);
        $output = strtolower($output);
        return $output;
    }
    public static function randomString(string $base = "", int $length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';
        $charCount = strlen($characters);

        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[rand(0, $charCount - 1)];
        }

        return base64_encode($base . $string);
    }

    public static function generateUUID() {
        $data = random_bytes(16);
    
        // Set the version (4) and variant (2) bits
        $data[6] = chr(ord($data[6]) & 0x0F | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3F | 0x80);
    
        // Format the UUID string
        $uuid = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    
        return $uuid;
    }
}
