<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Board.php';

$database = new Database();

$board = new Board($database->connect());
// Conditonal tests 
if(isset($_GET['pID'])&&isset($_GET['gID'])){
    $board->pID = $_GET['pID'];
    $board->gID = $_GET['gID'];
    $board->deletePlayer();
}
else die();
$board->closeConnection();
?>