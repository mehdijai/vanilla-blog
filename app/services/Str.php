<?php

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
}
