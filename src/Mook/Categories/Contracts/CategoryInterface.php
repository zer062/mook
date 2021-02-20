<?php

namespace Mook\Categories\Contracts;

interface CategoryInterface
{

    public function id();

    public function name();

    public function idNumber();

    public function parent();

    public function description();
}