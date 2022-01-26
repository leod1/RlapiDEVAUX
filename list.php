<?php
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    header($_SERVER["SERVER_PROTOCOL"] . " 405 Method Not Allowed", true, 405);
    exit;
}
$file_name = "data.json";
$rlCars = [];
if (file_exists($file_name)) {
    $rlCars = json_decode(file_get_contents($file_name), true);
}
$json_text = json_encode($rlCars);
echo $json_text;