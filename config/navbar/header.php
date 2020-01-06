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
            "text" => "Home",
            "url" => "",
            "title" => "Första sidan, börja här.",
        ],
        [
            "text" => "Questions",
            "url" => "questions",
            "title" => "Första sidan, börja här.",
        ],
        [
            "text" => "Tags",
            "url" => "tags",
            "title" => "Första sidan, börja här.",
        ],
        [
            "text" => "Profile",
            "url" => "user",
            "title" => "Första sidan, börja här.",
        ],
        [
            "text" => "About",
            "url" => "om",
            "title" => "Om denna webbplats.",
        ],
        [
            "text" => "<i class='fas fa-sign-in-alt'></i>",
            "url" => "user/logout",
            "title" => "Login",
        ],

    ],
];
