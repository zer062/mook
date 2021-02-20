<?php

namespace Mook\Configs;

use Mook\Configs\Contracts\Credentials;

class MoodleCredentials implements Credentials
{
    private string $uri;

    private string $token;

    private $path;

    public function __construct(string $uri, string $token, string $path = null)
    {
        $this->uri = $uri;
        $this->token = $token;
        $this->path = $path;
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