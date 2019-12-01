<?php
namespace Aisa\WeatherRequest;


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
class WeatherRequest implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;
    /**
     * Curl URL and return JSON
     *
     * @return array
     */
    public function curlJson($url)
    {
        // Initialize CURL:
        $initization = curl_init($url);
        curl_setopt($initization, CURLOPT_RETURNTRANSFER, true);
        // Store the data:
        $json = curl_exec($initization);
        curl_close($initization);
        // Decode JSON response:
        return json_decode($json, true);
    }

    /**
     * Curl multi
     *
     * @return array
     */
    public function multiRequest($data, $options = array())
    {
        // array of curl handles
    $curly = array();
    // data to be returned
    $result = array();
    // multi handle
    $mh = curl_multi_init();
    // loop through $data and create curl handles
    // then add them to the multi-handle
    foreach ($data as $id => $d) {
        $curly[$id] = curl_init();
        $url = (is_array($d) && !empty($d['url'])) ? $d['url'] : $d;
        curl_setopt($curly[$id], CURLOPT_URL, $url);
        curl_setopt($curly[$id], CURLOPT_HEADER, 0);
        curl_setopt($curly[$id], CURLOPT_RETURNTRANSFER, 1);
        // post?
        if (is_array($d)) {
            if (!empty($d['post'])) {
                curl_setopt($curly[$id], CURLOPT_POST, 1);
                curl_setopt($curly[$id], CURLOPT_POSTFIELDS, $d['post']);
            }
        }
    // extra options?
        if (!empty($options)) {
            curl_setopt_array($curly[$id], $options);
        }
        curl_multi_add_handle($mh, $curly[$id]);
        }
        // execute the handles
        $running = null;
        do {
            curl_multi_exec($mh, $running);
        } while ($running > 0);
        // get content and remove handles
        foreach ($curly as $id => $c) {
            $result[$id] = curl_multi_getcontent($c);
            curl_multi_remove_handle($mh, $c);
        }
            // all done
            curl_multi_close($mh);
            return $result;
        }
    }
