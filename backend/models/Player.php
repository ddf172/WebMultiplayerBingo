<?php 
class Player {
    private $conn;
    private $table = 'player';

    //properties
    public $player_id;
    public $nickname;
    
    //constructor
    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){
        $query = 'SELECT player_id,nickname from '.$this->table. ' Where player_id='.$this->pID;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create(){
        $this->player_id = htmlspecialchars(strip_tags($this->player_id));
        $this->nickname = htmlspecialchars(strip_tags($this->nickname));

        // database query

        $query = 'INSERT INTO '. $this->table. ' (player_id,nickname) VALUES 
        ('. $this->player_id .','.":nickname".')';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nickname', $this->nickname);
        try{
            if($stmt->execute()){
            return true;
            }
        }
        catch(Exception $e){
            print ($e);
        }
        return false;
    }
}