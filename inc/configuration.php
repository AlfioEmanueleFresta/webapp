<?php

$conf = [

    "title"     =>  "A Terrible Website",
    "about_url" =>  "https://www.cs.york.ac.uk/cyber-practicals/",

    // Database connection details
    "database"  => [
        "dsn"       =>  "mysql:host=localhost;dbname=dbname",
        "username"  =>  "dbuser",
        "password"  =>  "hackmeplease",
        "options"   =>  [],
    ],

    // User registration -- constraint on user input
    "minimum_password_length"   => 4,
    "default_role"              => "user",

    // This is the default salt used to salt password hashes. Password hashes are
    // stored in the database alongside the password hash. Please note that salt should
    // be randomly generated for security reasons -- but this is needed for a practical.
    "password_default_salt"     => "This is the salt for exercise 2",

    // This variable configures the session.gc_maxlifetime, which is used
    // by the PHP garbage collector to cleanup the session. Its purpose is to
    // prolong the session duration so to make it less likely for students to
    // encounter any problem during the practical.
    "php.session.gc_maxlifetime" => (60 * 60 * 2), // 2 days (in seconds)

];

