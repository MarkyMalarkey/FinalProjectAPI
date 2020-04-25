<?php
class Author{
  
    //Database connection and table name
    private $conn;
  
    //Object properties
    public $authorId;
    public $author;

    public function __construct($db){
        $this->conn = $db;
    }
  
    //Used by select drop-down list
    public function readAll(){
        //Select all data
        $query = "SELECT * FROM author ORDER BY authorId ASC";
        $statement = $this->conn->prepare( $query );
        $statement->execute();
        return $statement;
    }

    //Join and grab quotes by author
    public function authorIdQuote() {
        $query = "SELECT id, text, author, category FROM quotes WHERE authorId = :authorId";
        $statement = $this->conn->prepare( $query );
        $this->authorId=htmlspecialchars(strip_tags($this->authorId));
        $statement->bindParam(":authorId", $this->authorId);
        $statement->execute();
        return $statement;
    }


}
?>