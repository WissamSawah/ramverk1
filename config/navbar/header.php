<?php
/**
 * Supply the basis for the navbar as an array.
 */
return [
    // Use for styling the menu
    "wrapper" => null,
    "class" => "my-navbar rm-default rm-desktop",

    // Here comes the menu items
    "items" => [
        [
            "text" => "Hem",
            "url" => "",
            "title" => "Första sidan, börja här.",
        ],
        [
            "text" => "Redovisning",
            "url" => "redovisning",
            "title" => "Redovisningstexter från kursmomenten.",
            // "submenu" => [
            //     "items" => [
            //         [
            //             "text" => "Kmom01",
            //             "url" => "redovisning/kmom01",
            //             "title" => "Redovisning för kmom01.",
            //         ],
            //         [
            //             "text" => "Kmom02",
            //             "url" => "redovisning/kmom02",
            //             "title" => "Redovisning för kmom02.",
            //         ],
            //     ],
            // ],
        ],
        [
            "text" => "IP-Validator",
            "url" => "validate",
            "title" => "Enter an IP to validate.",
            "submenu" => [
                "items" => [
                    [
                        "text" => "IP-validation",
                        "url" => "validate",
                        "title" => "Enter an IP to validate.",
                    ],
                    [
                        "text" => "IP-JSON",
                        "url" => "json",
                        "title" => "Get info in JSON.",
                    ],
                ],
            ],
        ],
        [
            "text" => "Weather",
            "url" => "docu",
            "title" => "Doc to get Weather.",
            "submenu" => [
                "items" => [
                    [
                        "text" => "Weather",
                        "url" => "weather",
                        "title" => "Enter an IP to get Weather.",
                    ],
                    [
                        "text" => "Weather-JSON",
                        "url" => "weatherjson",
                        "title" => "Get info in JSON.",
                    ],
                ],
            ],
        ],
        [
            "text" => "Om",
            "url" => "om",
            "title" => "Om denna webbplats.",
        ],
        [
            "text" => "Styleväljare",
            "url" => "style",
            "title" => "Välj stylesheet.",
        ],
        [
            "text" => "Verktyg",
            "url" => "verktyg",
            "title" => "Verktyg och möjligheter för utveckling.",
        ],
    ],
];
