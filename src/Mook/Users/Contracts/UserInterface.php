<?php

namespace Mook\Users\Contracts;

interface UserInterface
{
    public function id();

    public function username();

    public function firstname();

    public function lastname();

    public function email();

    public function idNumber();

    public function auth();
}