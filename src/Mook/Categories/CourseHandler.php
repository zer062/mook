<?php

namespace Mook\Categories;

use Mook\Categories\Models\Category;
use Mook\Configs\Contracts\Credentials;
use Mook\Core\Http\MoodleRequest;
use Mook\Courses\Models\Course;
use Mook\Services\Api;

class CourseHandler
{
    private $api;

    private $credentials;

    private $filters = [];

    public function __construct(Credentials $credentials)
    {
        $this->credentials = $credentials;
        $this->api = new Api($credentials);
    }

    public function filters()
    {
        return $this->filters;
    }

    public function create(array $courses)
    {
        $request = new MoodleRequest(Course::CREATE_PARAMS_KEY, Course::CREATE_ACTION);
        $response = $this->api->setRequest($request->data($courses))->call();
        return collect($response)->map(function ($item) {
            return $this->prepareToResponseOnCreate($item);
        })->toArray();
    }

    public function update(array $courses)
    {
        $request = new MoodleRequest(Course::CREATE_PARAMS_KEY, Course::UPDATE_ACTION);
        $this->api->setRequest($request->data($courses))->call();
        return [];
    }

    public function get()
    {
        $request = new MoodleRequest(Course::GET_PARAMS_KEY, Course::GET_ACTION);
        $response = $this->api->setRequest($request->data($this->filters()))->call();
        return collect($response)->map(function ($item) {
            return $this->prepareToResponse($item);
        })->toArray();
    }

    private function prepareToResponseOnCreate(\stdClass $item)
    {
        $course = new Course(null, $item->shortname, null);
        $course->setId($item->id);
        return $course;
    }

    private function prepareToResponse(\stdClass $item)
    {
        $course = new Course($item->fullname, $item->shortname, $item->categoryid);
        $course->setId($item->id);
        $course->setDescription($item->summary);
        $course->setIdNumber($item->idnumber);
        $course->setFormat($item->format);
        return $course;
    }

    public function findByName(string $name)
    {
        $this->filters[] = [
            'field' => 'name',
            'value' => $name
        ];
        return $this;
    }


    public function findById(int $id)
    {
        $this->filters[] = [
            'field' => 'id',
            'value' => $id
        ];
        return $this;
    }

    public function findByIds(array $ids)
    {
        $this->filters[] = [
            'field' => 'ids',
            'value' => implode(',', $ids)
        ];
        return $this;
    }

    public function findByIdNumber(string $idNumber)
    {
        $this->filters[] = [
            'field' => 'idnumber',
            'value' => $idNumber
        ];
        return $this;
    }

    public function findByParent(int $parentId)
    {
        $this->filters[] = [
            'field' => 'parent',
            'value' => $parentId
        ];
        return $this;
    }
}