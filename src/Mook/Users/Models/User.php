<?php

namespace Mook\Users\Models;

use Mook\Core\Model;
use Mook\Users\Contracts\UserInterface;

class User extends Model implements UserInterface
{

    const CREATE_ACTION = "core_user_create_users";
    const UPDATE_ACTION = "core_user_update_users";
    const DELETE_ACTION = "core_user_delete_users";
    const GET_ACTION = "core_user_get_users";
    const SEARCH_ACTION = "core_user_get_users";

    const CREATE_PARAMS_KEY = "users";
    const GET_PARAMS_KEY = "criteria";

    private $id;

    private $username;

    private $firstname;

    private $lastname;

    private $email;

    private $idNumber;

    private $password;

    private $auth = 'manual';

    public function __construct(
        string $username,
        string $firstname,
        string $lastname,
        string $email,
        string $password = null
    ){
        $this->username = $username;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
    }

    public function username()
    {
        return $this->username;
    }

    public function id()
    {
        return $this->id;
    }

    public function idNumber()
    {
        return $this->idNumber;
    }

    public function firstname()
    {
        return $this->firstname;
    }

    public function lastname()
    {
        return $this->lastname;
    }

    public function email()
    {
        return $this->email;
    }

    public function auth()
    {
        return $this->auth;
    }

    public function setId(int $id = null)
    {
        return $this->id = $id;
    }

    public function setIdNumber(string $idNumber)
    {
        $this->idNumber = $idNumber;
    }

    public function setAuth(string $auth)
    {
        return $this->auth = $auth;
    }

    public function mapToRequest(): array
    {
        return [
            'username' => $this->username,
            'password' => $this->password,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'auth' => $this->auth
        ];
    }
}