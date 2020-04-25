<?php
    $dsn = 'mysql:host=zj2x67aktl2o6q2n.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;dbname=e9q3zaqmobg4r9kg';
    $username = 'asxybhpo6jm6w8ge';
    $password = 'fnaz3cv3bmwdl8t5';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
?>
