<?php

namespace Mook\Users;

use Mook\Configs\Contracts\Credentials;
use Mook\Core\Http\MoodleRequest;
use Mook\Services\Api;
use Mook\Users\Models\User;

class UserHandler
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

    private function prepareToResponseOnCreate(\stdClass $item)
    {
        $user = new User($item->username, null, null, null);
        $user->setId($item->id);
        return $user;
    }

    private function prepareToResponse(\stdClass $item)
    {
        $user = new User(
            $item->username,
            $item->firstname,
            $item->lastname,
            $item->email
        );
        $user->setId($item->id);
        $user->setIdNumber($item->idnumber);
        return $user;
    }

    public function create(array $users)
    {
        $request = new MoodleRequest(User::CREATE_PARAMS_KEY, User::CREATE_ACTION);
        $response = $this->api->setRequest($request->data($users))->call();
        return collect($response)->map(function ($item) {
            return $this->prepareToResponseOnCreate($item);
        })->toArray();
    }

    public function update(array $users)
    {
        $request = new MoodleRequest(User::CREATE_PARAMS_KEY, User::UPDATE_ACTION);
        $this->api->setRequest($request->data($users))->call();
        return [];
    }

    public function get()
    {
        $request = new MoodleRequest(User::GET_PARAMS_KEY, User::GET_ACTION);
        $response = $this->api->setRequest($request->data($this->filters()))->call();
        return collect($response)->map(function ($item) {
            return $this->prepareToResponse($item);
        })->toArray();
    }

    public function findByName(string $name)
    {
        $this->filters[] = [
            'field' => 'firstname',
            'value' => '%' . $name . '%'
        ];
        return $this;
    }

    public function findByEmail(string $email)
    {
        $this->filters[] = [
            'field' => 'email',
            'value' => '%' . $email . '%'
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
}