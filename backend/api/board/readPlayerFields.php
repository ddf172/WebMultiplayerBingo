<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Board.php';

$database = new Database();
$db = $database->connect();

$board = new Board($db);
// Conditonal tests 
$board->pID = isset($_GET['pID']) ? $_GET['pID'] : die();
$board->gID = isset($_GET['gID']) ? $_GET['gID'] : die();

$result = $board->readPlayerFields();

if($result->rowCount()){

    $boardArr = array();
    $boardArr['data'] = array();
    while($row=$result->fetch(PDO::FETCH_ASSOC)){
        array_push($boardArr['data'],$row);
    }
    // to JSON
    echo json_encode($boardArr);
}
else json_encode(array('message'=>'No data found'));
?>