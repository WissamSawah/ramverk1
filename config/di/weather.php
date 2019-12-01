<?php
/**
 * Configuration file for DI container.
 */
return [
    // Services to add to the container.
    "services" => [
        "WeatherRequest" => [
            "shared" => true,
            //"callback" => "\Anax\Response\Response",
            "callback" => function () {
                $obj = new \Aisa\WeatherRequest\WeatherRequest();
                $obj->setDI($this);
                return $obj;
            }
        ],
    ],
];
