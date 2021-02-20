<?php

namespace Mook\Courses\Contracts;

interface CourseInterface
{
    public function id();

    public function name();

    public function shortname();

    public function description();

    public function format();

    public function category();
}