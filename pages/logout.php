<?php

// This is not the right way to log out a user,
// but it is needed to allow session IDs to continue
// to be valid after logout. This is simply to allow
// to demonstrate session hijacking for students using
// a single browser/computer.
session_regenerate_id(false);
$_SESSION = [];

redirectTo("index.php&logged_out");