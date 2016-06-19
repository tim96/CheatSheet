<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 6/19/2016
 * Time: 8:18 PM
 */

namespace Tim\CheatSheetBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    /** @var  Client */
    private $client;

    public function setUp()
    {
        parent::setUp();

        $this->client = static::createClient();
    }

    public function testIndex()
    {
        // $client = static::createClient();

        $crawler = $this->client->request('GET', '/');

        // self::assertContains('Hello World', $client->getResponse()->getContent());
        self::assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testAbout()
    {
        $crawler = $this->client->request('GET', '/about');

        self::assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testAboutNotFound()
    {
        $crawler = $this->client->request('GET', '/about1');

        self::assertEquals(404, $this->client->getResponse()->getStatusCode());
    }
}