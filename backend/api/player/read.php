<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Player.php';

$database = new Database();
$db = $database->connect();

$player = new Player($db);
$player->pID = isset($_GET['pID']) ? $_GET['pID'] : die();

$result = $player->read();
if($result->rowCount()){

    $boardArr = array();
    $boardArr['data'] = array();
    array_push($boardArr['data'],$result->fetch(PDO::FETCH_ASSOC));
    // to JSON
    echo json_encode($boardArr);
}
else json_encode(array('message'=>'No data found'));