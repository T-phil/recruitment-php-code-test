<?php

namespace App\Service;

use App\Service\Log\LogInterface;
use Exception;

class AppLogger
{
    protected static $namespace = 'App\\Service\\Log\\';

    const TYPE_LOG4PHP = 'log4php';

    const TYPE_THINK = 'thinkLog';

    protected static $typeMap = [
        self::TYPE_LOG4PHP => 'Log4php',
        self::TYPE_THINK => 'ThinkLog'
    ];

    private $logger;

    public function __construct($type = self::TYPE_LOG4PHP)
    {
        $serviceClass = self::$typeMap[$type] ?? null;

        if ($serviceClass === null) {
            throw new Exception('service module not found');
        }

        $serviceClass = self::$namespace . $serviceClass;

        if (!class_exists($serviceClass)) {
            throw new Exception('service class not found');
        }

        $obj = new $serviceClass();
        if (!$obj instanceof LogInterface) {
            throw new Exception('serviceClass not implements LogInterface');
        }

        return $this->logger = $obj;
    }

    public function info($message = '')
    {
        $this->logger->info($message);
    }

    public function debug($message = '')
    {
        $this->logger->debug($message);
    }

    public function error($message = '')
    {
        $this->logger->error($message);
    }
}