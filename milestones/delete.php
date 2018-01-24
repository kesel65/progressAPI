<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require("../objects/goals.php");

$milestone = new Milestones();

$data = json_decode(file_get_contents("php://input"));

$milestone->id = $data->id;

if ($milestone->delete()) {
    echo '{ "message" => "Milestone was deleted." }';
} else {
    echo '{ "message" => "Unable to delete Milestone." }';
}