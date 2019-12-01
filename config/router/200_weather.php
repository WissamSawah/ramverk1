<?php
/**
 * Routes to ease development and debugging.
 */
return [
    "routes" => [
        [
            "info" => "Validate IP-addresses",
            "mount" => "weather",
            "handler" => "Aisa\Weather\WeatherIpController",
        ],

    ]
];
