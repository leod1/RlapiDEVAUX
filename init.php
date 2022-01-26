<?php
$file_name = "data.json";
$data = [
    ["name" => "Backfire", "rarity" => "Common", "difficulty" => 2, "id" => 1, "imgLink" => "/image/image1"],
    ["name" => "Dominus", "rarity" => "Common", "difficulty" => 3, "id" => 2, "imgLink" => "/image/image2"],
    ["name" => "Zippy", "rarity" => "Very Rare", "difficulty" => 2, "id" => 3, "imgLink" => "/image/image3"],
    ["name" => "Fennec", "rarity" => "Import", "difficulty" => 5, "id" => 4, "imgLink" => "/image/image4"]
];
file_put_contents($file_name, json_encode($data));