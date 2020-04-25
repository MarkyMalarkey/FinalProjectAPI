<?php
class Database{
  
    //Specify database credentials
    
    private $host = "mysql:host=zj2x67aktl2o6q2n.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;dbname=e9q3zaqmobg4r9kg";
    private $username = "asxybhpo6jm6w8ge";
    private $password = "fnaz3cv3bmwdl8t5";
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
