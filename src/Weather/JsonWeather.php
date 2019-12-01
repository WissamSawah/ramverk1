<?php
namespace Aisa\Weather;
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
class JsonWeather extends WeatherIpController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;
    /**
     * @var string $db a sample member variable that gets initialised
     */
    private $ipAddress;
    private $time;
    private $object;
    private $WeatherRequest;


    protected $apiKey;
    protected $darkKey;

    public function __construct()
    {
        $apiKeys = require ANAX_INSTALL_PATH . "/config/apiKeys.php";
        $this->apiKey = $apiKeys["ipstack"];
        $this->darkKey = $apiKeys["darksky"];
    }
    /**
     * Display the view
     *
     * @return object
     */
    public function indexAction() : object
    {
        $title = "Check IP (JSON)";
        $page = $this->di->get("page");
        $request = $this->di->get("request");
        $this->WeatherRequest = $this->di->get("WeatherRequest");
        $this->ipAddress = $request->getGet("ip");
        $this->time = $request->getGet("time");
        $currentIp = $this->ipAddress;
        $this->object = new WeatherIp();
        $currentIp = $this->object->validateIp($this->ipAddress);
        $accessKey  = $this->apiKey;
        $BaseUrl = 'http://api.ipstack.com/';
        $details =  $this->WeatherRequest->curlJson($BaseUrl.$currentIp.'?access_key='.$accessKey);
        $weather = $this->multiCurlJson($details);
        $data["details"] = $details;
        $data["weather"] = $weather;
        $data["currentIp"] = $currentIp;
        $page->add("weather/weatherjson", $data);
        return $page->render([
            "title" => $title,
        ]);
    }

    public function indexActionPost()
    {
        $title = "Check IP (JSON)";
        $page = $this->di->get("page");
        $request = $this->di->get("request");
        $this->WeatherRequest = $this->di->get("WeatherRequest");
        $this->ipAddress = $request->getPost("ip");
        $this->time = $request->getPost("time");
        $currentIp = $this->ipAddress;
        $this->object = new WeatherIp();
        $currentIp = $this->object->validateIp($this->ipAddress);
        $accessKey  = $this->apiKey;
        $BaseUrl = 'http://api.ipstack.com/';
        $details = $this->WeatherRequest->curlJson($BaseUrl.$currentIp.'?access_key='.$accessKey);
        $weather = $this->multiCurlJson($details);
        $data["details"] = $details;
        $data["weather"] = $weather;
        $data["currentIp"] = $currentIp;

        $data = [];
            foreach ($weather as $key => $value) {
                $day = [
                    "date" => gmdate("Y-m-d", $value["currently"]["time"]),
                    "summary" =>  $value["currently"]["summary"],
                    "temperature" =>  $value["currently"]["temperature"]
                ];
                $data[] = $day;
            }
            $json = [
                "ip" => $currentIp,
                "timezone" => $weather[0]["timezone"],
                "data" => $data,
            ];
            return json_encode($json, JSON_PRETTY_PRINT);
    }



    public function weatherCheckActionGet()
    {
        $title = "Check IP (JSON)";
        $page = $this->di->get("page");
        $request = $this->di->get("request");
        $this->WeatherRequest = $this->di->get("WeatherRequest");
        $this->ipAddress = $request->getGet("ip");
        $this->time = $request->getGet("time");
        $currentIp = $this->ipAddress;
        $this->object = new WeatherIp();
        $currentIp = $this->object->validateIp($this->ipAddress);
        $accessKey  = $this->apiKey;
        $BaseUrl = 'http://api.ipstack.com/';
        $details = $this->WeatherRequest->curlJson($BaseUrl.$currentIp.'?access_key='.$accessKey);
        $weather = $this->multiCurlJson($details);
        $data["details"] = $details;
        $data["weather"] = $weather;
        $data["currentIp"] = $currentIp;

        $data = [];
            foreach ($weather as $key => $value) {
                $day = [
                    "date" => gmdate("Y-m-d", $value["currently"]["time"]),
                    "summary" =>  $value["currently"]["summary"],
                    "temperature" =>  $value["currently"]["temperature"]
                ];
                $data[] = $day;
            }
            $json = [
                "ip" => $currentIp,
                "timezone" => $weather[0]["timezone"],
                "data" => $data,
            ];
            return json_encode($json, JSON_PRETTY_PRINT);
    }




    public function multiCurlJson($details)
    {
        $accessKey  = $this->darkKey;
        $multiRequests = [];
        #future weather
        if ($this->time === "future") {
            for ($i=0; $i < 7; $i++) {
                $unixTime = time() + ($i * 24 * 60 * 60);
                $BaseUrl = 'https://api.darksky.net/forecast/';
                $apiSetting = '?exclude=minutely,hourly,daily,flags';
                $multiRequests[] = $BaseUrl.$accessKey .'/'.$details['latitude'].','.$details['longitude'].','.$unixTime.$apiSetting;
            }
        }
        #previous weather
        if ($this->time === "past") {
            for ($i=0; $i < 30; $i++) {
                $unixTime = time() - ($i * 24 * 60 * 60);
                $BaseUrl = 'https://api.darksky.net/forecast/';
                $apiSetting = '?exclude=minutely,hourly,daily,flags';
                $multiRequests[] = $BaseUrl.$accessKey .'/'.$details['latitude'].','.$details['longitude'].','.$unixTime.$apiSetting;
            }
        }
        $weather = $this->WeatherRequest->multiRequest($multiRequests);
        foreach ($weather as $key => $value) {
            $weather[$key] = json_decode(stripslashes($value), JSON_PRETTY_PRINT);
        }
        return $weather;
    }
}
