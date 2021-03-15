<?php

namespace Mook\Enrollments;

use Mook\Configs\Contracts\Credentials;
use Mook\Core\Http\MoodleRequest;
use Mook\Enrollments\Models\Enrollment;
use Mook\Services\Api;

class EnrollmentHandler
{
    private $user;

    private $course;

    private $role;

    private $credentials;

    private $api;

    private const ENROL_ACTION = "enrol_manual_enrol_users";
    private const UNENROL_ACTION = "enrol_manual_unenrol_users";

    public function __construct(Credentials $credentials, $user, $course, $role)
    {
        $this->credentials = $credentials;
        $this->user = $user;
        $this->course = $course;
        $this->role = $role;

        $this->api = new Api($credentials);
    }

    private function getData()
    {
        return [
            'roleid' => $this->role,
            'userid' => $this->user,
            'courseid' => $this->course
        ];
    }

    public function enroll()
    {
        $request = new MoodleRequest('enrolments', self::ENROL_ACTION);
        $this->api->setRequest($request->data($this->getData()))->call();
        return true;
    }

    public function unenroll()
    {
        $request = new MoodleRequest('enrolments', self::UNENROL_ACTION);
        $this->api->setRequest($request->data($this->getData()))->call();
        return true;
    }

}