<?php 
class Board {
    private $conn;
    private $table = 'board';

    //properties
    public $player_id;
    public $game_id;
    public $content;
    public $checked;

    //constructor
    public function __construct($db){
        $this->conn = $db;
    }

    //Get all board table
    public function readAll(){
        $query = 'SELECT player_id,game_id,content,checked from '.$this->table. ' Where game_id='.$this->id;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function readField(){
        $query = 'SELECT player_id,game_id,content,checked from '.$this->table. ' Where player_id='.$this->id;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

}
?>