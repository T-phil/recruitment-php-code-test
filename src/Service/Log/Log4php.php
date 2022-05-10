<?php

namespace App\Service\Log;

class Log4php implements LogInterface
{
    private $logger;

    public function __construct()
    {
        $this->logger = \Logger::getLogger("Log");
    }

    public function info(string $content)
    {
        $this->logger->info($content);
    }

    public function error(string $content)
    {
        $this->logger->error($content);
    }

    public function debug(string $content)
    {
        $this->logger->debug($content);
    }
}