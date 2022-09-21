<?php 
class Board {
    private $conn;
    private $table = 'board';

    //properties
    public $player_id;
    public $game_id;
    public $field_id;
    public $content;
    public $checked;
    

    //constructor
    public function __construct($db){
        $this->conn = $db;
    }

    /* link: api/board/read.php?gID=x , need to get parameter gID - game_id
       returns 2 dimensional array. First element is 'data' with contains all fields from game with id=x. Currently there is only 'data' element */
    public function readAll(){
        $query = 'SELECT player_id,game_id,field_id,content,checked from '.$this->table. ' Where game_id='.$this->gID.' ORDER BY player_id, field_id';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    /* link: api/board/readPlayerFields.php?pID=x&gID=y, need two parameters pID - player_id and gID - game_id
       returns 2 dimensional array. First element is 'data' with contains all fields from player with id=x and game with id=y.
       Currently there is only 'data' element */
    public function readPlayerFields(){
        $query = 'SELECT player_id,game_id,field_id,content,checked from '.$this->table. ' Where player_id='.$this->pID.' AND game_id='.$this->gID.' ORDER BY field_id';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function create(){
        // Clean data
        $this->player_id = htmlspecialchars(strip_tags($this->player_id));
        $this->game_id = htmlspecialchars(strip_tags($this->game_id));
        $this->field_id = htmlspecialchars(strip_tags($this->field_id));
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->checked = htmlspecialchars(strip_tags($this->checked));

        // database query

        $query = 'INSERT INTO '. $this->table. ' (player_id,game_id,field_id,content,checked) VALUES 
        ('. $this->player_id .','.$this->game_id.','.$this->field_id.','.$this->content.','.$this->checked.')';
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
    public function update(){
        // Clean data
        $this->player_id = htmlspecialchars(strip_tags($this->player_id));
        $this->game_id = htmlspecialchars(strip_tags($this->game_id));
        $this->field_id = htmlspecialchars(strip_tags($this->field_id));
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->checked = htmlspecialchars(strip_tags($this->checked));

        // database query

        $query = 'UPDATE '.
            $this->table. 
        ' SET'.
            ' content='.$this->content.
            ', checked='.$this->checked.
            ' Where player_id='.$this->player_id.' AND game_id='.$this->game_id.' AND field_id='.$this->field_id;
        
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

    public function deleteGame(){
        $this->gID = htmlspecialchars(strip_tags($this->gID));
        $query = 'DELETE FROM '.$this->table.' WHERE game_id='.$this->gID;
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
    
    public function deletePlayer(){
        $this->gID = htmlspecialchars(strip_tags($this->gID));
        $this->pID = htmlspecialchars(strip_tags($this->pID));
        $query = 'DELETE FROM '.$this->table.' WHERE game_id='.$this->gID.' AND player_id='.$this->pID;
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
?>