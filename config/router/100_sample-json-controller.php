<?php
/**
 * Load the sample json controller.
 */
return [
    "routes" => [
        [
             "info" => "Weather IP (JSON)",
             "mount" => "weatherjson",
             "handler" => "\Aisa\Weather\JsonWeather",
         ],
    ]
];
