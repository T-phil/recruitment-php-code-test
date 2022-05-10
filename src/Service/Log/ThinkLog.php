<?php

namespace App\Service\Log;

use think\LogManager;

class ThinkLog implements LogInterface
{
    /**
     * @var $logger LogManager
     */
    private $logger;

    private $config = [];

    public function __construct()
    {
        $this->getInstance();
    }

    protected function getInstance()
    {
        if(!isset($this->logger)){
            $this->logger  = new LogManager();
            $this->logger->init($this->config);
        }
        return $this->logger ;
    }

    /**
     * 大写
     * @param string $content
     * @return string
     */
    public function logToUpper(string $content = ''): string
    {
        return $content = strtoupper($content);
    }

    public function info(string $content)
    {
        $this->logger->info($this->logToUpper($content));
    }

    public function error(string $content)
    {
        $this->logger->error($this->logToUpper($content));
    }

    public function debug(string $content)
    {
        $this->logger->debug($this->logToUpper($content));
    }
}