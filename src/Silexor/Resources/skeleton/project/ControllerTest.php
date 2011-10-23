<?php

require_once __DIR__.'/bootstrap.php';

use Silex\WebTestCase;

class ControllerTest extends WebTestCase
{
    public function createApplication()
    {
        return require __DIR__.'/../src/app.php';
    }

    public function testIndex()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/');

        $this->assertTrue($client->getResponse()->isOk());
        $this->assertEquals('Hello', $client->getResponse()->getContent());
    }
}