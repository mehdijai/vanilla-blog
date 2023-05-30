<?php

namespace App\Core;

use ReflectionMethod;

trait ValidationTrait
{
    public function string($value)
    {
        return $value != null && strlen(trim($value)) !== 0;
    }
    public function min($value, $min)
    {
        return  $value != null && strlen(trim($value)) >= $min;
    }
    public function max($value, $min)
    {
        return  $value != null && strlen(trim($value)) <= $min;
    }
    public function between($value, $min, $max)
    {
        return  $value != null && between($value, $min, $max);
    }
    public function file_path($value)
    {
        return $value != null && is_file($value);
    }
    public function bool(bool $value)
    {
        return is_bool($value);
    }
    public function int($value)
    {
        return is_int($value);
    }
    public function required($value)
    {
        return isset($value);
    }
    public function nullable($value)
    {
        return $value == true;
    }
    public function file($value)
    {
        if($value == null) return false;
        return isset($value) && isset($value["tmp_name"]) && $value["tmp_name"] != null && getimagesize($value["tmp_name"]);
    }

    private $rules = [
        'string' => ':attribute must be a string',
        'min' => ':attribute must have at least :min characters',
        'max' => ':attribute must have less than :max characters',
        'between' => ':attribute must be between :min and :max',
        'file_path' => ':attribute must be a file path',
        'file' => ':attribute must be a valid file',
        'bool' => ':attribute must be a boolean',
        'required' => ':attribute is required',
        'nullable' => ':attribute is nullable',
    ];


    protected function setMessage(string $method, string $key, array $args)
    {
        $params = $this->parseParams($method, $args);
        $params['attribute'] = $key;
        $attribute = $this->rules[$method];
        $message = preg_replace_callback('/:([a-zA-Z_]\w*)/', function ($matches) use ($params) {
            $variableName = $matches[1];
            if (isset($params[$variableName])) {
                return $params[$variableName];
            }
            return $matches[0];
        }, $attribute);

        $this->messages[$key] = $message;
    }

    private function parseParams($function, array $args)
    {
        $params = $this->getParamsAsObject($function);
        $parsed = [];

        foreach ($params as $index => $param) {
            $parsed[$param] = $args[$index];
        }

        return $parsed;
    }

    private function getParamsAsObject($function)
    {
        $reflection = new ReflectionMethod($this, $function);
        $params = $reflection->getParameters();

        $paramObject = [];

        foreach ($params as $param) {
            if ($param->getName() != 'value') {
                array_push($paramObject, $param->getName());
            }
        }

        return $paramObject;
    }
}
