<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Player.php';

$database = new Database();
$player = new Player($database->connect());
$player->pID = isset($_GET['pID']) ? $_GET['pID'] : die();

$result = $player->readOne();
if($result->rowCount()){

    $playerArr = array();
    $playerArr['data'] = array();
    array_push($playerArr['data'],$result->fetch(PDO::FETCH_ASSOC));
    // to JSON
    echo json_encode($playerArr);
}
else json_encode(array('message'=>'No data found'));
$player->closeConnection();