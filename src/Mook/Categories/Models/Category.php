<?php

namespace Mook\Categories\Models;

use Mook\Categories\Contracts\CategoryInterface;
use Mook\Core\Model;

class Category extends Model implements CategoryInterface
{
    const CREATE_ACTION = "core_course_create_categories";
    const UPDATE_ACTION = "core_course_update_categories";
    const GET_ACTION = "core_course_get_categories";

    const CREATE_PARAMS_KEY = "categories";
    const FIND_PARAMS_KEY = "criteria";

    private $id;

    private $name;

    private $description;

    private $idNumber;

    private $parent;

    public function __construct(string $name, int $id = null)
    {
        $this->name = $name;
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

    public function idNumber()
    {
        return $this->idNumber;
    }

    public function parent()
    {
        return $this->parent;
    }

    public function description()
    {
        return $this->description;
    }

    public function mapToRequest(): array
    {
        return [
            'name'=> $this->name(),
            'idnumber' => $this->idNumber(),
            'parent' => $this->parent(),
            'description' => $this->description(),
        ];
    }
}