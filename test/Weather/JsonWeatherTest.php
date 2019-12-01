<?php

namespace Aisa\Weather;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the FlatFileContentController.
 */
class JsonWeatherTest extends TestCase
{

    // Create the di container.
    protected $di;
    protected $controller;



    /**
     * Prepare before each test.
     */
    protected function setUp()
    {
        global $di;

        // Setup di
        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // Use a different cache dir for unit test
        // $this->di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        // View helpers uses the global $di so it needs its value
        $di = $this->di;

        $this->controller = new JsonWeather();
        $this->controller->setDI($this->di);
        $this->WeatherRequest = $this->di->get("WeatherRequest");
        //$this->controller->initialize();
    }

    /**
     * Test the route "index".
     */
    public function testIndexAction()
    {
        $res = $this->controller->indexAction();
        $this->assertInternalType("object", $res);
    }

    public function testIndexActionPost()
    {
        $_POST["ip"] = "3.249.76.98";
        $_POST["time"] = "future";
        $json = $this->controller->indexActionPost();
        $exp = '{ "ip": "3.249.76.98", "timezone": "Europe\/Dublin", "data": [ { "date": "2019-11-25", "summary": "Mostly Cloudy", "temperature": 54 }';
        $this->assertContains($exp, $json);
    }
}
