<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Board.php';

$database = new Database();
////////
$board = new Board($database->connect());
$board->gID = isset($_GET['gID']) ? $_GET['gID'] : die();
//////
$result = $board->readAll();
if($result->rowCount()){
    $boardArr = array();
    $boardArr['data'] = array();
    // Putting data to array
    while($row=$result->fetch(PDO::FETCH_ASSOC)){
        array_push($boardArr['data'],$row);
    }
    // to JSON
    echo json_encode($boardArr);
}
else echo json_encode(array('message'=>'No data found'));
$board->closeConnection();
?>