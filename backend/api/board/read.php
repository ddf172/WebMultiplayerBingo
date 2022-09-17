<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Board.php';

$database = new Database();
$db = $database->connect();
////////
$board = new Board($db);
$board->id = isset($_GET['id']) ? $_GET['id'] : die();
$result = $board->readAll();
if($result->rowCount()>0){
    $boardArr = array();
    $boardArr['data'] = array();
    while($row=$result->fetch(PDO::FETCH_ASSOC)){
        array_push($boardArr['data'],$row);
    }
    // to JSON
    echo json_encode($boardArr);
}
else echo json_encode(array('message'=>'No data found'));
?>