<?php

namespace Mook\Configs;

use Mook\Configs\Contracts\Credentials;

class MoodleCredentials implements Credentials
{
    private string $uri;

    private string $token;

    private $path;

    public function __construct(string $uri, string $token)
    {
        $this->uri = $uri;
        $this->token = $token;
    }

    public function setPath(string $path = null)
    {
        $this->path = is_null($path) ? '' : $path;
    }

    public function uri(): string
    {
        return $this->uri;
    }

    public function token(): string
    {
        return $this->token;
    }

    public function path()
    {
        return $this->path;
    }

}