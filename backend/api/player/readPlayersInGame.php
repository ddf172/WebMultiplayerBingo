<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Player.php';

$database = new Database();

$player = new Player($database->connect());
$player->gID = isset($_GET['gID']) ? $_GET['gID'] : die();

$result = $player->readPlayersInGame();
if($result->rowCount()){
    $playerArr = array();
    $playerArr['data'] = array();
    // Putting data to array
    while($row=$result->fetch(PDO::FETCH_ASSOC)){
        array_push($playerArr['data'],$row);
    }
    // to JSON
    echo json_encode($playerArr);
}
else echo json_encode(array('message'=>'No data found'));
$player->closeConnection();
?>