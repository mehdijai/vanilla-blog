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
        // Replace whitespace and hyphens with spaces
        $output = preg_replace('/[\s-]+/', ' ', $input);

        // Convert to title case
        $output = ucwords($output);

        // Remove spaces and hyphens
        $output = str_replace(array(' ', '-'), '', $output);

        // Convert first character to lowercase
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
