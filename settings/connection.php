<?php

$SERVER = "localhost";
$USERNAME = "51.145.20.224";
$PASSWD = "";
$DATABASE = "gym_book";

$con = new mysqli($SERVER, $USERNAME, $PASSWD, $DATABASE) or die("could not connect database");

// check con
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}


