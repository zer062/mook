<?php

namespace Mook\Categories;

use Mook\Categories\Models\Category;
use Mook\Configs\Contracts\Credentials;
use Mook\Core\Http\MoodleRequest;
use Mook\Services\Api;

class CategoryHandler
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

    public function create(array $categories)
    {
        $request = new MoodleRequest(Category::CREATE_PARAMS_KEY, Category::CREATE_ACTION);
        $response = $this->api->setRequest($request->data($categories))->call();
        return collect($response)->map(function ($item) {
            return $this->prepareToResponse($item);
        })->toArray();
    }

    public function update(array $categories)
    {
        $request = new MoodleRequest(Category::CREATE_PARAMS_KEY, Category::UPDATE_ACTION);
        $response = $this->api->setRequest($request->data($categories))->call();
        return collect($response)->map(function ($item) {
            return $this->prepareToResponse($item);
        })->toArray();
    }

    public function get()
    {
        $request = new MoodleRequest(Category::FIND_PARAMS_KEY, Category::GET_ACTION);
        $response = $this->api->setRequest($request->data($this->filters()))->call();
        return collect($response)->map(function ($item) {
            return $this->prepareToResponse($item);
        })->toArray();
    }

    private function prepareToResponse(\stdClass $item)
    {
        $category = new Category($item->name);
        $category->setId($item->id);
        $category->setIdNumber($item->idnumber);
        $category->setDescription($item->description);
        $category->setParent($item->parent);
        return $category;
    }

    public function findByName(string $name)
    {
        $this->filters[] = [
            'key' => 'name',
            'value' => $name
        ];
        return $this;
    }


    public function findById(int $id)
    {
        $this->filters[] = [
            'key' => 'id',
            'value' => $id
        ];
        return $this;
    }

    public function findByIds(array $ids)
    {
        $this->filters[] = [
            'key' => 'ids',
            'value' => implode(',', $ids)
        ];
        return $this;
    }

    public function findByIdNumber(string $idNumber)
    {
        $this->filters[] = [
            'key' => 'idnumber',
            'value' => $idNumber
        ];
        return $this;
    }

    public function findByParent(int $parentId)
    {
        $this->filters[] = [
            'key' => 'parent',
            'value' => $parentId
        ];
        return $this;
    }
}