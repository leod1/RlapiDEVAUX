<?php
if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    header($_SERVER["SERVER_PROTOCOL"] . " 405 Method Not Allowed", true, 405);
    exit;
}

$inputJSON = file_get_contents('php://input');
$data = json_decode($inputJSON, TRUE);
$file_name = "data.json";
$rlCars = [];
if (file_exists($file_name)) {
    $rlCars = json_decode(file_get_contents($file_name), true);
}

foreach($rlCars as $key=>$value){
    if($rlCars[$key]["id"] == $data["id"]){
        array_splice($rlCars, $key, 1);
        break;
    }
    if(($key +1) == sizeof($rlCars)){
        header($_SERVER["SERVER_PROTOCOL"] . " 402 This ID doesn't exist", true, 402);
    }
}
// Mise à jour du fichier
file_put_contents($file_name, json_encode($rlCars));