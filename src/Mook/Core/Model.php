<?php

namespace Mook\Core;

use Mook\Categories\Models\Category;

class Model
{
    private $attributes = [];

    public function __get($name)
    {
        return $this->attributes[$name];
    }

    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    public function mapToRequest(): array
    {
        return [];
    }
}