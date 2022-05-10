<?php

namespace App\Service\Log;

interface LogInterface
{
    public function info(string $content);

    public function error(string $content);

    public function debug(string $content);
}