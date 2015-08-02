<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 02.08.2015
 * Time: 17:48
 */

namespace Tim\CheatSheetBundle\Tests\Controller;

// use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Tim\CheatSheetBundle\Tests\Fixtures\Entity\LoadData;
// use Doctrine\Common\DataFixtures\FixtureInterface;
use Liip\FunctionalTestBundle\Test\WebTestCase as WebTestCase;

class ApiV1ControllerTest extends WebTestCase
{
    public function setUp()
    {
        $this->auth = array(
            'PHP_AUTH_USER' => 'user',
            'PHP_AUTH_PW'   => 'userpass',
        );
        $this->client = static::createClient(array(), $this->auth);
    }

    public function testJsonGetFeedbackAction()
    {
        $fixtures = array('Tim\CheatSheetBundle\Tests\Fixtures\Entity\LoadData');
        $this->loadFixtures($fixtures);
        $feedbacks = LoadData::$feedbacks;
        $feedback = array_pop($feedbacks);

        $route =  $this->getUrl('api_v1_get_feedback', array('id' => $feedback->getId(), '_format' => 'json'));
        $this->client->request('GET', $route, array('ACCEPT' => 'application/json'));
        $response = $this->client->getResponse();

        $this->assertEquals(
            200, $response->getStatusCode(),
            $response->getContent()
        );
        $this->assertTrue(
            $response->headers->contains('Content-Type', 'application/json'),
            $response->headers
        );

        $content = $response->getContent();
        $decoded = json_decode($content, true);

        $this->assertTrue(isset($decoded['id']));
        $this->assertEquals("Username", $decoded['name']);
        $this->assertNotContains("created_at", $decoded);
    }
}