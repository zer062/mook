<?php

namespace Mook\Courses\Models;

use Mook\Core\Model;
use Mook\Courses\Contracts\CourseInterface;

class Course extends Model implements CourseInterface
{

    const CREATE_ACTION = "core_course_create_courses";
    const UPDATE_ACTION = "core_course_update_courses";
    const GET_ACTION = "core_course_get_courses_by_field";

    const CREATE_PARAMS_KEY = "courses";
    const GET_PARAMS_KEY = null;

    const TOPICS_FORMAT = "topics";
    const WEEKS_FORMAT = "weeks";
    const SOCIAL_FORMAT = "social";
    const SITE_FORMAT = "site";

    private $id;

    private $name;

    private $shortname;

    private $category;

    private $idNumber;

    private $description;

    private $format;

    public function __construct(string $name, string $shortname, int $category) {
        $this->name = $name;
        $this->shortname = $shortname;
        $this->category = $category;
        $this->format = self::TOPICS_FORMAT;
    }

    public function setId(int $id = null)
    {
        $this->id = $id;
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

        public function setIdNumber(string $idNumber)
        {
            $this->idNumber = $idNumber;
        }

    public function idNumber()
    {
        return $this->idNumber;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function description()
    {
        return $this->description;
    }

    public function setFormat(string $format)
    {
        $this->format = $format;
    }

    public function format()
    {
        return $this->format;
    }

    public function mapToRequest(): array
    {
        return [
            'id' => $this->id(),
            'fullname'=> $this->name(),
            'shortname'=> $this->shortname(),
            'idnumber' => $this->idNumber(),
            'categoryid' => $this->category(),
            'summary' => $this->description(),
            'format' => $this->format()
        ];
    }
}