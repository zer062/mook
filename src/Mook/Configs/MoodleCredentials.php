<?php

namespace Mook\Configs;

use Mook\Configs\Contracts\Credentials;

class MoodleCredentials implements Credentials
{
    private string $uri;

    private string $token;

    public function __construct(string $uri, string $token)
    {
        $this->uri = $uri;
        $this->token = $token;
    }

    public function uri(): string
    {
        return $this->uri;
    }

    public function token(): string
    {
        return $this->token;
    }

}