<?php

namespace Aisa\Validate;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $di if implementing the interface
 * ContainerInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class ValidateController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;



    /**
     * @var string $db a sample member variable that gets initialised
     */
    private $ipAddress;
    private $object;


    /**
     * Check if IP is valid or not.
     * GET ip
     *
     * @return string
     */
    public function Result($ipAddress, $object) : string
    {
        if ($object->getProtocol($ipAddress)) {
            return "The IP $ipAddress is a valid " . $object->getProtocol($ipAddress) ." address." ;
        }
        return "The IP $ipAddress is not a valid ip-Address.";
    }

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexAction() : object
    {
        $protocol;
        $host;
        $details;
        $title = "Ip validator";
        $page = $this->di->get("page");
        $request = $this->di->get("request");
        $this->ipAddress = $request->getGet("ip");
        $ip = $this->ipAddress;

        $this->object = new ValidateIP();
        $protocol = $this->Result($this->ipAddress, $this->object);
        $host = $this->object->getDomain($this->ipAddress);
        $details = $this->object->getDetails($this->ipAddress);
        $ip = $this->object->getCurrentIp();
        $data["ip"] = $ip;
        $data["protocol"] = $protocol;
        $data["host"] = $host;
        $data["details"] = $details;


        $page->add("validate/index", $data);
        return $page->render([
            "title" => $title,
        ]);
    }
}
