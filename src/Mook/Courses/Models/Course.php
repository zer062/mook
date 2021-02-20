<?php

namespace Mook\Courses\Models;

use Mook\Core\Model;
use Mook\Courses\Contracts\CourseInterface;

class Course extends Model implements CourseInterface
{

    const TOPICS_FORMAT = "topics";

    private $id;

    private $name;

    private $shortname;

    private $category;

    private $description;

    private $format;

    public function __construct(
        string $name,
        string $shortname,
        int $category,
        int $id = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->shortname = $shortname;
        $this->category = $category;
        $this->format = self::TOPICS_FORMAT;
    }

    public function id()
    {
        return $this->id;
    }

    public function name()
    {
        return $this->name;
    }

    public function shortname()
    {
        return $this->shortname;
    }

    public function category()
    {
        return $this->category;
    }

    public function description()
    {
        return $this->description;
    }

    public function format()
    {
        return $this->format;
    }
}