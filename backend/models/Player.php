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
    public function readPlayersInGame(){
        $this->gID = htmlspecialchars(strip_tags($this->gID));
        $query = 'SELECT p.player_id, p.nickname FROM board b RIGHT JOIN player p on p.player_id=b.player_id WHERE b.game_id='.$this->gID;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function readOne(){
        $this->pID = htmlspecialchars(strip_tags($this->pID));
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
    public function delete(){
        $this->pID = htmlspecialchars(strip_tags($this->pID));
        $query = 'DELETE FROM '.$this->table.' WHERE player_id='.$this->pID;
        $stmt = $this->conn->prepare($query);
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
    public function closeConnection(){
        $this->conn=null;
    }
}