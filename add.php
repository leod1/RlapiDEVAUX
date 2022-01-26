<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header($_SERVER["SERVER_PROTOCOL"] . " 405 Method Not Allowed", true, 405);
    exit;
}

$inputJSON = file_get_contents('php://input');
$rlCar = json_decode($inputJSON, TRUE);
if(!isset($rlCar["name"]) or !isset($rlCar["rarity"]) or !isset($rlCar["difficulty"]) or !isset($rlCar["imageLink"])){
    header($_SERVER["SERVER_PROTOCOL"] . " 400 miss some(s) value(s) in request", true, 400);
    exit;
}



$file_name = "data.json";
$rlCars = [];
if (file_exists($file_name)) {
    $rlCars = json_decode(file_get_contents($file_name), true);
}

foreach($rlCars as $rlCarr){
    if($rlCarr["name"] == $rlCar["name"]){
        header($_SERVER["SERVER_PROTOCOL"] . " 401 Car already exist", true, 401);
        exit;
    }
}
$rlCar["id"] = $rlCars[sizeof($rlCars)-1]["id"] + 1;

array_push($rlCars, $rlCar);
file_put_contents($file_name, json_encode($rlCars));