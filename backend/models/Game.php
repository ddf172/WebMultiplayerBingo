<?php
class Game{
    private $conn;
    private $table = 'game';

    public $game_id;
    public $game_status;
    public $game_code = null;

    public function __construct($db)
    {
        $this->conn= $db;
    }
    public function readAll(){
        $query = "SELECT * FROM '$this->table' ORDER BY game_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function readOne(){
        $this->gID = htmlspecialchars(strip_tags($this->gID));
        
        $query = "SELECT * FROM '$this->table' Where game_id=".$this->gID;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function create(){
        $this->game_id = htmlspecialchars(strip_tags($this->game_id));
        $this->game_status = htmlspecialchars(strip_tags($this->game_status));
        $this->game_code = htmlspecialchars(strip_tags($this->game_code));

        if(is_null($this->game_code)||$this->game_code=='')$this->game_code=$this->game_id;

        $query = "INSERT INTO ".$this->table." (game_id,game_status,game_code)  VALUES (".$this->game_id.",".$this->game_status.",".$this->game_code.")";
        $stmt = $this->conn->prepare($query);
        try{
            if($stmt->execute())return true;
        }
        catch(Exception $e){
            print($e);
        }
        return false;
        
    }
    public function delete(){
        $this->gID = htmlspecialchars(strip_tags($this->gID));

        $query = "DELETE FROM '$this->table' WHERE game_id='$this->gID'";
        $stmt = $this->conn->prepare($query);
        try{
            if($stmt->execute())return true;
        }
        catch(Exception $e){
            print($e);
        }
        return false;
    }
    public function closeConnection(){
        $this->conn=null;
    }

}