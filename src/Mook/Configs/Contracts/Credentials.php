<?php

namespace Mook\Configs\Contracts;

interface Credentials
{
    public function uri(): string;

    public function token(): string;

    public function path();
}