<?php

class Controller
{
    protected $data = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }
}
