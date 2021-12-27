<?php

$dbHost = "localhost"; //this should contain te host address when it gets uploaded to the web
$dbUser = "root"; //default mysql username
$dbPass = ""; //pass is mandatory for live websites
$dbName = "survey_database"; //database name

$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

if (!$conn) {
    die("Database connection failed.");
}
