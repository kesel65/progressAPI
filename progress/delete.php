<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require("../objects/goals.php");

$progress = new Progress();

$data = json_decode(file_get_contents("php://input"));

$progress->id = $data->id;

if ($progress->delete()) {
    echo '{ "message" => "Progress was deleted." }';
} else {
    echo '{ "message" => "Unable to delete Progress." }';
}