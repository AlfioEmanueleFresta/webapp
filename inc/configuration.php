<?php

// TODO: Possibly load the configuration from a .ini/.json file?

$conf = [

    "title"     =>  "A Terrible Website",
    "about_url" =>  "https://www.cs.york.ac.uk/cyber-practicals/",

    "database"  => [
        "dsn"       =>  "mysql:host=localhost;dbname=dbname",
        "username"  =>  "dbuser",
        "password"  =>  "hackmeplease",
        "options"   =>  [],
    ],

    "minimum_password_length"   => 4,
    "default_role"              => "user",

];
