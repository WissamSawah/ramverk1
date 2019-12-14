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
class ValidateIP implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;


    protected $apiKey;
    public function __construct()
    {
        $apiKeys = require ANAX_INSTALL_PATH . "/config/apiKeys.php";
        $this->apiKey = $apiKeys["ipstack"];
    }


    /**
     * Check if IP is valid or not.
     * GET ip
     *
     * @return string
     */

    public function getProtocol($ipAddress)
    {
        if (filter_var($ipAddress, FILTER_VALIDATE_IP)) {
            if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
                return "IPv4";
            }
            if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
                return "IPv6";
            }
        }
        return false;
    }

        /**
     * Check if IP is valid or not.
     * GET  domain
     *
     * @return string
     */
    public function getDomain($ipAddress)
    {
        if (filter_var($ipAddress, FILTER_VALIDATE_IP)) {
            return gethostbyaddr($ipAddress);
        }
        return "Not valid";
    }

    public function getCurrentIp()
    {
        return $_SERVER["REMOTE_ADDR"] ?? '127.0.0.1';
    }


    public function getDetails($ipAddress)
    {
        $BaseUrl = "http://api.ipstack.com/";
        $req = curl_init($BaseUrl . $ipAddress . "?access_key=" . $this->apiKey . '');
        curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($req);
        curl_close($req);
        $result = json_decode($json, JSON_PRETTY_PRINT);
        $result["map_link"] = "https://www.openstreetmap.org/#map=13/{$result['latitude']}/{$result['longitude']}";
        return $result;
    }
}
