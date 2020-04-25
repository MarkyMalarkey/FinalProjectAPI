<?php
    //Checks login info to see if it is valid
    function is_valid($username, $password) {
        global $db;
        $password = sha1($username . $password);
        $query = 'SELECT id FROM administrators WHERE username = :username AND password = :password';
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $password);
        $statement->execute();
        $valid = $statement->fetchAll();
        $statement->closeCursor();
        return $valid;
    }

    //checks to see if username already exists
    function does_exist($username) {
        global $db;
        $query = 'SELECT * FROM administrators WHERE username = :username';
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->execute();
        $exists = $statement->fetchAll();
        $statement->closeCursor();
        return $exists;
    }

?>