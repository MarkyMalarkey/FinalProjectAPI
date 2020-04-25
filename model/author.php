<?php
    //Checks to see if author already exists in the author table
    function check_author($author) {
        global $db;
        $query = 'SELECT author FROM author WHERE author = :author';
        $statement = $db->prepare($query);
        $statement->bindValue(':author', $author);
        $statement->execute();
        return $statement;
    }

    //Adds author to the author table
    function add_author($author) {
        global $db;
        $query = 'INSERT INTO author (author) VALUES (:author)';
        $statement = $db->prepare($query);
        $statement->bindValue(':author', $author);
        $statement->execute();
        $statement->closeCursor();
    }

    //Get authorId from name
    function get_auth_id($author) {
        global $db;
        $query = 'SELECT authorId FROM author WHERE author = :author';
        $statement = $db->prepare($query);
        $statement->bindValue(':author', $author);
        $statement->execute();
        $auth = $statement->fetchAll();
        return $auth;
    }
?>