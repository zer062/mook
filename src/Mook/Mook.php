<?php

namespace Mook;

use Mook\Categories\CategoryHandler;
use Mook\Configs\MoodleCredentials;
use Mook\Configs\Contracts\Credentials;

class Mook
{
    private Credentials $credentials;

    public function __construct(string $moodleUri, string $moodleToken)
    {
        $this->credentials = new MoodleCredentials($moodleUri, $moodleToken);
    }

    public function credentials(): Credentials
    {
        return $this->credentials;
    }

    public function categories(): CategoryHandler
    {
        return new CategoryHandler($this->credentials);
    }
}