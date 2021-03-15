<?php

namespace Mook;

use Mook\Categories\CategoryHandler;
use Mook\Courses\CourseHandler;
use Mook\Configs\MoodleCredentials;
use Mook\Configs\Contracts\Credentials;
use Mook\Enrollments\EnrollmentHandler;
use Mook\Users\UserHandler;

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
        return new CategoryHandler($this->credentials());
    }

    public function courses(): CourseHandler
    {
        return new CourseHandler($this->credentials());
    }

    public function users(): UserHandler
    {
        return new UserHandler($this->credentials());
    }

    public function enrollments(): EnrollmentHandler
    {
        return new EnrollmentHandler($this->credentials());
    }
}