<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Game.php';

$database = new Database();
////////
$game = new Game($database->connect());
$data = json_decode(file_get_contents("php://input",true));
print_r($data);
(is_null($data)) ? die() : "";
foreach($data as $index){
    $row = (array)$index;
    $rowKeys = array_keys($row);
    if($rowKeys[0]!='game_id'){print("invalid input");continue;}
    if($rowKeys[1]!='game_status'){print("invalid input");continue;}
    if(count($rowKeys)==3){
        if($rowKeys[2]!='game_code'){print("invalid input");continue;}
    }
    $game->game_id = $row['game_id'];
    $game->game_status = $row['game_status'];

    if(count($rowKeys)==3)$game->game_code = $row['game_code'];

    $game->create();
}
$game->closeConnection();
?>