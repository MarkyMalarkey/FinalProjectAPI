<?php
class Quotes{
    //I will use this class to read data from my database
    //Database connection
    private $conn;
  
    //Object properties
    public $id;
    public $text;
    public $author;
    public $category;
    public $lim;
    public $categoryId;
    public $authorId;
  
    //Constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    //Read quotes
    function read(){
        //Select all query
        $query = "SELECT * FROM quotes ORDER BY category ASC";
    
        //Prepare query statement
        $statement = $this->conn->prepare($query);
    
        //Execute query
        $statement->execute();
    
        return $statement;
    }
    
    //Creates Quotes
    function create(){
  
        //Query to insert record
        $query = "INSERT INTO submittedquotes SET text=:text, author=:author, category=:category";
      
        //Prepare query
        $statement = $this->conn->prepare($query);
      
        //Strips html tags off of the data (Just learned about this). Precautionary measure
        $this->text=htmlspecialchars(strip_tags($this->text));
        $this->author=htmlspecialchars(strip_tags($this->author));
        $this->category=htmlspecialchars(strip_tags($this->category));

      
        //Bind values
        $statement->bindParam(":text", $this->text);
        $statement->bindParam(":author", $this->author);
        $statement->bindParam(":category", $this->category);
      
        //Execute
        if($statement->execute()){
            return true;
        }
      
        return false;
          
    }

    //Used when filling up the update quote form
    function readOne(){
        //Query to read single record
        $query = "SELECT text, author, category FROM quotes WHERE id = ?";
    
        // Query statement
        $statement = $this->conn->prepare( $query );
    
        //Bind id of product to be updated
        $statement->bindParam(1, $this->id);
    
        // execute query
        $statement->execute();
    
        //Get retrieved row
        $row = $statement->fetch(PDO::FETCH_ASSOC);
    
        //If there is text at the given id, then we will display the quote information
        if (isset($row['text'])) {
            //Set values to object properties
            $this->text = $row['text'];
            $this->author = $row['author'];
            $this->category = $row['category'];
        } else {
            //Does nothing if nothing exists for the given id
        }

    }

    //Searches for both authorId and categoryId
    function both() {
        $query = "SELECT id, text, author, category FROM quotes WHERE categoryId = :categoryId AND authorId = :authorId";
        $statement = $this->conn->prepare( $query );
        $this->categoryId=htmlspecialchars(strip_tags($this->categoryId));
        $this->authorId=htmlspecialchars(strip_tags($this->authorId));
        $statement->bindParam(":authorId", $this->authorId);
        $statement->bindParam(":categoryId", $this->categoryId);
        $statement->execute();
        return $statement;
    }

    //Displays a random quote
    function limit() {
        $query = "SELECT id, text, author, category FROM quotes ORDER BY RAND ( ) LIMIT 1";
        $statement = $this->conn->prepare( $query );
        $statement->execute();
        return $statement;
    }
}
?>