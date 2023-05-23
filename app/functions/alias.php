<?php

function component($name, $data = null)
{
    $t = debug_backtrace();
    $root = dirname($t[0]['file']);
    $base_root = "";
    if (strpos($root, 'views') == false) {
        $base_root = merge_paths($base_root, 'views');
    }
    if (strpos($root, 'components') == false) {
        $base_root .= merge_paths($base_root, 'components');
    }
    $base_root = merge_paths($base_root, "{$name}.php");
    if ($data != null) {
        extract($data);
    }
    require(merge_paths($root, $base_root));
}

function merge_paths($path1, $path2)
{
    $paths = func_get_args();
    $last_key = func_num_args() - 1;
    array_walk($paths, function (&$val, $key) use ($last_key) {
        switch ($key) {
            case 0:
                $val = rtrim($val, '/ ');
                break;
            case $last_key:
                $val = ltrim($val, '/ ');
                break;
            default:
                $val = trim($val, '/ ');
                break;
        }
    });
    $first = array_shift($paths);
    $last = array_pop($paths);
    $paths = array_filter($paths);
    array_unshift($paths, $first);
    $paths[] = $last;
    return implode('/', $paths);
}
