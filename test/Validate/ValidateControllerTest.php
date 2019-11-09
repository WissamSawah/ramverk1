<?php

namespace Aisa\Validate;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the FlatFileContentController.
 */
class ValidateControllerTest extends TestCase
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

        $di = $this->di;

        // Setup the controller
        $this->controller = new ValidateController();
        $this->controller->setDI($this->di);
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

        /**
     * Test the route "dump-di".
     */
    public function testGetProtocolResultTrue()
    {
        $object = new ValidateIp();
        $res = $this->controller->Result("186.151.62.176", $object);
        $this->assertInternalType("string", $res);
    }
}
