<?php

namespace Aisa\Validate;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the FlatFileContentController.
 */
class ValidateIPTest extends TestCase
{

    // Create the di container.
    protected $di;
    protected $controller;



    /**
     * Just assert something is true.
     */
    public function testGetProtocolIPv6()
    {
        $object = new ValidateIP();
        $ipAddress = "2001:0db8:85a3:0000:0000:8a2e:0370:7334";
        $res = $object->getProtocol($ipAddress);
        $exp = "IPv6";
        $this->assertEquals($exp, $res);
    }


         /**
     * Just assert something is true.
     */
    public function testGetHostTrue()
    {
        $object = new ValidateIP();
        $ipAddress = "108.174.10.10";
        $res = $object->getDomain($ipAddress);
        $exp = "108-174-10-10.fwd.linkedin.com";
        $this->assertEquals($exp, $res);
    }
    public function testGetHostFalse()
    {
        $object = new ValidateIP();
        $ipAddress = "108.174";
        $res = $object->getDomain($ipAddress);
        $this->assertInternalType("string", $res);
    }


    public function testgetDetails()
    {
        $object = new ValidateIP();
        $ipAddress = "108.174.10.10";
        $res = $object->getDetails($ipAddress);
        $this->assertInternalType("array", $res);
    }
}
