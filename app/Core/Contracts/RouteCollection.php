<?php

namespace App\Core\Contracts;

use ArrayObject;
use InvalidArgumentException;

class RouteCollection extends ArrayObject
{
    public function __construct(array $items = [])
    {
        foreach ($items as $item) {
            $this->validate($item);
        }
    }

    public function append($value): void
    {
        $this->validate($value);
        parent::append($value);
    }

    public function offsetSet($key, $value): void
    {
        $this->validate($value);
        parent::offsetSet($key, $value);
    }

    protected function validate($value): void
    {
        if (!$value instanceof Route) {
            throw new InvalidArgumentException(
                'Not an instance of Route'
            );
        }
    }
}
