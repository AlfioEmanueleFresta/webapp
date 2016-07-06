<?php

// Connect to the SQLite database
$db = new PDO(
    $conf["database"]["dsn"],
    $conf["database"]["username"],
    $conf["database"]["password"],
    $conf["database"]["options"]
);
