<?php
class Category{
  
    //Database connection and table name
    private $conn;
  
    //Object properties
    public $categoryId;
    public $category;

    public function __construct($db){
        $this->conn = $db;
    }
  
    //Used by select drop-down list
    public function readAll(){
        //Select all data
        $query = "SELECT * FROM categories ORDER BY category ASC";
  
        $statement = $this->conn->prepare( $query );
        $statement->execute();
  
        return $statement;
    }

    //Grabs quotes by category
    public function categoryIdQuote() {
        $query = "SELECT id, text, author, category FROM quotes WHERE categoryId = :categoryId";
        $statement = $this->conn->prepare( $query );
        $this->categoryId=htmlspecialchars(strip_tags($this->categoryId));
        $statement->bindParam(":categoryId", $this->categoryId);
        $statement->execute();
        return $statement;
    }
}
?>