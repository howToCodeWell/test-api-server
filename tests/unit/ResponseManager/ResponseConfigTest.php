<?php namespace App\Tests\unit\ResponseManager;

use App\ResponseManager\ResponseConfig;
use App\Tests\UnitTester;
use Codeception\Test\Unit;

class ResponseConfigTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected UnitTester $tester;

    public function testDefaults()
    {
        $default = new ResponseConfig(['default' => 'message']);
        self::assertSame(200, $default->getStatusCode());
        self::assertEmpty($default->getHeaders());
        self::assertArrayHasKey('default', $default->getBody());
        self::assertContains('message', $default->getBody());
    }


    public function testSetBody()
    {
        $response = new ResponseConfig([]);

        $response->setBody([
            'username' => 'someUserName'
        ]);

        self::assertArrayHasKey('username', $response->getBody());
        self::assertContains('someUserName', $response->getBody());
    }


    public function testSetStatusCode()
    {
        $response = new ResponseConfig([]);
        $response->setStatusCode(404);

        self::assertSame(404, $response->getStatusCode());
    }

    public function testSetHeaders()
    {
        $response = new ResponseConfig([]);
        $response->setHeaders([
            'Content-Type' => 'application/json'
        ]);

        self::assertArrayHasKey('Content-Type', $response->getHeaders());
        self::assertContains('application/json', $response->getHeaders());
    }
}
