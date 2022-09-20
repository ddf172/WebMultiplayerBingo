<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Player.php';

$database = new Database();
$db = $database->connect();
////////
$player = new Player($db);
$data = json_decode(file_get_contents("php://input",true));
(is_null($data)) ? die() : "";
foreach($data as $index){
    $row = (array)$index;
    $rowKeys = array_keys($row);

    if($rowKeys[0]!='player_id'){print("invalid input");continue;}
    if($rowKeys[1]!='nickname'){print("invalid input");continue;}

    $player->player_id = $row['player_id'];
    $player->nickname = $row['nickname'];
    $player->create();
}
?>