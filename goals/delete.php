<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require("../objects/goals.php");

$goal = new Goals();

$data = json_decode(file_get_contents("php://input"));

$goal->id = $data->id;

if ($goal->delete()) {
    echo '{ "message" => "Goal was deleted." }';
} else {
    echo '{ "message" => "Unable to delete Goal." }';
}