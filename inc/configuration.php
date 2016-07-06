<?php

// TODO: Possibly load the configuration from a .ini/.json file?

$conf = [

    "title"     =>  "A Terrible Website",

    "database"  => [
        "dsn"       =>  "sqlite:./database/database.sqlite",
        "username"  =>  null,
        "password"  =>  null,
        "options"   =>  [],
    ]

];
