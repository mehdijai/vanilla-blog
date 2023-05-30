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
        if (strlen($base) != 0) {
            $base = base64_encode($base);
            $length = 3;
        }
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';
        $charCount = strlen($characters);

        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[rand(0, $charCount - 1)];
        }

        return $base . $string;
    }
}
