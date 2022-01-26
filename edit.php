<?php
if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
    header($_SERVER["SERVER_PROTOCOL"] . " 405 Method Not Allowed", true, 405);
    exit;
}
$inputJSON = file_get_contents('php://input');
$data = json_decode($inputJSON, TRUE);
if(!isset($data["id"])){
    header($_SERVER["SERVER_PROTOCOL"] . " 400 miss ID in request", true, 400);
    exit;
}

$file_name = "data.json";
$rlCars = [];
if (file_exists($file_name)) {
    $rlCars = json_decode(file_get_contents($file_name), true);
}
foreach($rlCars as $key => $value){
    if($data["id"] == $value["id"]){
        foreach ($data as $key2 => $value2){
            if($value !== $value["id"]){
                $rlCars[$key][$key2] = $data[$key2];
            }
        }
    }
}
file_put_contents($file_name, json_encode($rlCars));