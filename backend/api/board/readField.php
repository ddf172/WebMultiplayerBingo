<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Board.php';

$database = new Database();
$db = $database->connect();

$board = new Board($db);
$board->id = isset($_GET['id']) ? $_GET['id'] : die();
$result = $board->readField();
if($result->rowCount()){
    //Działania na danych z bazy
    $row=$result->fetch(PDO::FETCH_ASSOC);
    extract($row);

    //Tworzenie struktury
    $boardArr = array();
    $boardArr['data'] = array();
    array_push($boardArr['data'],array(
        'field_id' =>$field_id,
        'field_value' =>$field_value,
        'checked' =>$checked,
        'player_id' =>$player_id
    ));
    
    // to JSON
    echo json_encode($boardArr);
}
else json_encode(array('message'=>'No data found'));
?>