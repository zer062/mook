<?php

namespace Mook\Enrollments;

use Mook\Configs\Contracts\Credentials;
use Mook\Core\Http\MoodleRequest;
use Mook\Enrollments\Models\Enrollment;
use Mook\Services\Api;

class EnrollmentHandler
{
    private const ENROL_ACTION = "enrol_manual_enrol_users";
    private const UNENROL_ACTION = "enrol_manual_unenrol_users";

    public function __construct(Credentials $credentials)
    {
        $this->credentials = $credentials;
        $this->api = new Api($credentials);
    }

    private function getData($role, $user, $course)
    {
        return [
            [
                'roleid' => $role,
                'userid' => $user,
                'courseid' => $course
            ]
        ];
    }

    public function enroll($role, $user, $course)
    {
        $request = new MoodleRequest('enrolments', self::ENROL_ACTION);
        $this->api->setRequest($request->data($this->getData($role, $user, $course)))->call();
        return true;
    }

    public function unenroll($role, $user, $course)
    {
        $request = new MoodleRequest('enrolments', self::UNENROL_ACTION);
        $this->api->setRequest($request->data($this->getData($role, $user, $course)))->call();
        return true;
    }

}