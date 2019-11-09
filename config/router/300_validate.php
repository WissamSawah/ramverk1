<?php
/**
 * Routes to ease development and debugging.
 */
return [
    "routes" => [
        [
            "info" => "Validate IP-addresses",
            "mount" => "validate",
            "handler" => "Aisa\Validate\ValidateController",
        ],
    ]
];
