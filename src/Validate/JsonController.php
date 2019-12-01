<?php

namespace Aisa\Validate;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample JSON controller to show how a controller class can be implemented.
 * The controller will be injected with $di if implementing the interface
 * ContainerInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 */
class JsonController extends ValidateController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;



    private $ipAddress;
    private $object;
    /**
     * Display the view
     *
     * @return object
     */
    public function indexAction() : object
    {
        $title = "Check IP with (JSON)";
        $page = $this->di->get("page");
        $request = $this->di->get("request");
        $json = null;
        $this->ipAddress = $request->getGet("ip");
        $this->object = new ValidateIP();

        $json = $this->object->getDetails($this->ipAddress, $this->object);
        $ip = $this->object->getCurrentIp();
        $data["json"] = $json;
        $data["ip"] = $ip;

        $page->add("validate/json", $data);
        return $page->render([
            "title" => $title,
        ]);
    }
    /**
     * Check if IP is valid or not and return with host.
     * GET ip
     *
     * @return array
     */
     public function indexActionPost()
         {
             $request = $this->di->get("request");
             $this->ipAddress = $request->getPost("ip");
             $this->object = new ValidateIP();
             $json = $this->object->getDetails($this->ipAddress);
             return json_encode($json, JSON_PRETTY_PRINT);
         }

     public function apiCheckActionGet()
     {
         $request = $this->di->get("request");
         $this->ipAddress = $request->getGet("ip");
         $this->object = new ValidateIP();
         $json = $this->object->getDetails($this->ipAddress);
         return json_encode($json, JSON_PRETTY_PRINT);
     }
}
