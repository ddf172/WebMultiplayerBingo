<?php 
class Board {
    private $conn;
    private $table = 'board';

    //properties
    public $field_id;
    public $field_value;
    public $checked;
    public $player_id;

    //constructor
    public function __construct($db){
        $this->conn = $db;
    }

    //Get all board table
    public function readAll(){
        $query = 'SELECT field_id,field_value,checked,player_id from '.$this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function readField(){
        $query = 'SELECT field_id,field_value,checked,player_id from '.$this->table. ' Where field_id='.$this->id;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

}
?>