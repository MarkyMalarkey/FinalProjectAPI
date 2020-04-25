<?php
class Database{
  
    //Specify database credentials
    
    private $host = "mysql:host=localhost;dbname=api_db";
    private $username = "mgs_user";
    private $password = "pa55word";
    public $conn;
  
    //Get the database connection
    public function getConnection(){
  
        $this->conn = null;
  
        try{
            $this->conn = new PDO($this->host, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
  
        return $this->conn;
    }
}
?>