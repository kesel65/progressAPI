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
$goal->userId = $data->userId;
$goal->GoalName = $data->name;
$goal->GoalStart = date('Y-m-d H:i:s', $data->GoalStart);
$goal->TargetKVI = $data->TargetKVI;
$goal->CurrentKVI = $data->CurrentKVI;

if ($goal->update()) {
    echo '{' ;
        echo '"message" => "Goal was updated."';
    echo '}';
} else {
    echo '{' ;
        echo '"message" => "Unable to update Goal."';
    echo '}';
}