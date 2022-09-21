<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Player.php';

$database = new Database();
$db = $database->connect();

$player = new Player($db);
// Conditonal tests 
if(isset($_GET['pID'])){
    $player->pID = $_GET['pID'];
    $player->delete();
}
else die();
?>