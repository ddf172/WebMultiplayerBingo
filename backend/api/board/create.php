<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Board.php';

$database = new Database();
////////
$board = new Board($database->connect());
$data = json_decode(file_get_contents("php://input"));

(is_null($data)) ? die() : "";
foreach($data as $index){
    $row = (array)$index;
    $rowKeys = array_keys($row);

    if($rowKeys[0]!='player_id')continue;
    if($rowKeys[1]!='game_id')continue;
    if($rowKeys[2]!='field_id')continue;
    if($rowKeys[3]!='content')continue;
    if($rowKeys[4]!='checked')continue;

    $board->player_id = $row['player_id'];
    $board->game_id = $row['game_id'];
    $board->field_id = $row['field_id'];
    $board->content = $row['content'];
    $board->checked = $row['checked'];
    $board->create();
}
$board->closeConnection();
?>