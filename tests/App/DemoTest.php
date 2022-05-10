<?php
/*
 * @Date         : 2022-03-02 14:49:25
 * @LastEditors  : Jack Zhou <jack@ks-it.co>
 * @LastEditTime : 2022-03-02 17:22:16
 * @Description  : 
 * @FilePath     : /recruitment-php-code-test/tests/App/DemoTest.php
 */

namespace Test\App;

use App\App\Demo;
use App\Util\HttpRequest;
use Logger;
use PHPUnit\Framework\TestCase;


class DemoTest extends TestCase
{

    private $successCode = 0;
    private $errorCode = -1;

    private $data = [
        "id" => 1,
        "username" => "hello world"
    ];


    /**
     * ./vendor/bin/phpunit  tests/App/DemoTest.php --filter=testFoo
     */
    public function testFoo()
    {
        $httpClient = \Mockery::mock(HttpRequest::class);
        $httpClient->shouldReceive('get')->andReturn(json_encode(['error' => $this->successCode, 'data' => $this->data]));

        $logger = \Mockery::mock(Logger::class);
        $logger->shouldReceive("error")->andReturn(null);

        $demo = new Demo($logger, $httpClient);
        $result = $demo->foo();
        $this->assertIsString($result);
    }

    /**
     * ./vendor/bin/phpunit  tests/App/DemoTest.php --filter=testGetUserInfoSuccess
     */
    public function testGetUserInfoSuccess()
    {
        $httpClient = \Mockery::mock(HttpRequest::class);
        $httpClient->shouldReceive('get')->andReturn(json_encode(['error' => $this->successCode, 'data' => $this->data]));

        $logger = \Mockery::mock(Logger::class);
        $logger->shouldReceive("error")->andReturn(null);

        $demo = new Demo($logger, $httpClient);
        $result = $demo->get_user_info();
        $this->assertEquals($this->data, $result);
    }

    /**
     * ./vendor/bin/phpunit  tests/App/DemoTest.php --filter=testGetUserInfoError
     */
    public function testGetUserInfoError()
    {

        $httpClient = \Mockery::mock(HttpRequest::class);
        $httpClient->shouldReceive('get')->andReturn(json_encode(['error' => $this->errorCode, 'data' => $this->data]));

        $logger = \Mockery::mock(Logger::class);
        $logger->shouldReceive("error")->andReturn(null);

        $demo = new Demo($logger, $httpClient);
        $result = $demo->get_user_info();
        $this->assertNull($result);
    }
}