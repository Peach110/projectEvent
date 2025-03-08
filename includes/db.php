<?php

function getConnection():mysqli
{
    $hostname = 'localhost';
    $dbName = 'event_university';
    $username = 'Pro';
    $password = 'Pro';
    $conn = new mysqli($hostname, $username, $password, $dbName);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

require_once DATABASE_DIR . '/users.php';
require_once DATABASE_DIR . '/authen.php';
require_once DATABASE_DIR . '/events.php';
require_once DATABASE_DIR . '/event_registrations.php';