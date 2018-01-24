<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require("../objects/goals.php");

$goal = new Goals();
$goal->userId = isset($_GET['userId']) ? $_GET['userId'] : die("User ID not sent in GET request");
$goal->read();