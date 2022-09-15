<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Board.php';

$database = new Database();
$db = $database->connect();

$board = new Board($db);

$result = $board->readAll();
if($result->rowCount()){
    $boardArr = array();
    $boardArr['data'] = array();
    while($row=$result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $board = array(
            'field_id' =>$field_id,
            'field_value' =>$field_value,
            'checked' =>$checked,
            'player_id' =>$player_id,
        );
        array_push($boardArr['data'],$board);
    }
    // to JSON
    echo json_encode($boardArr);
}
else json_encode(array('message'=>'No data found'));
?>