<?php
    //List of all approved quotes.
    function get_quotes() {
        global $db;
        $query = 'SELECT * FROM quotes ORDER BY category ASC';
        $statement = $db->prepare($query);
        $statement->execute();
        $quotes = $statement->fetchAll();
        $statement->closeCursor();
        return $quotes;
    }

    //Select distinct authors
    function get_authors() {
        global $db;
        $query = 'SELECT DISTINCT author FROM quotes ORDER BY author ASC';
        $statement = $db->prepare($query);
        $statement->execute();
        $quotes = $statement->fetchAll();
        $statement->closeCursor();
        return $quotes;
    }

    //Select distinct categories
    function get_categories() {
        global $db;
        $query = 'SELECT DISTINCT category FROM quotes ORDER BY category ASC';
        $statement = $db->prepare($query);
        $statement->execute();
        $quotes = $statement->fetchAll();
        $statement->closeCursor();
        return $quotes;
    }
    
    //Select every thing for selected author
    function sort_author($authorName) {
        global $db;
        $query = 'SELECT * FROM quotes WHERE author = :authorName';
        $statement = $db->prepare($query);
        $statement->bindValue(':authorName',$authorName);
        $statement->execute();
        $quotes = $statement->fetchAll();
        $statement->closeCursor();
        return $quotes;
    }

    //Select every thing for selected category
    function sort_category($categoryName) {
        global $db;
        $query = 'SELECT * FROM quotes WHERE category = :categoryName';
        $statement = $db->prepare($query);
        $statement->bindValue(':categoryName',$categoryName);
        $statement->execute();
        $quotes = $statement->fetchAll();
        $statement->closeCursor();
        return $quotes;
    }
    
    //Select every thing for selected category/author
    function sort_both($authorName, $categoryName) {
        global $db;
        $query = 'SELECT * FROM quotes WHERE author = :authorName AND category = :categoryName';
        $statement = $db->prepare($query);
        $statement->bindValue(':authorName',$authorName);
        $statement->bindValue(':categoryName',$categoryName);
        $statement->execute();
        $quotes = $statement->fetchAll();
        $statement->closeCursor();
        return $quotes;
    }

    //Delete the selected quote
    function delete($quoteId) {
        global $db;
        $query = 'DELETE FROM quotes WHERE id = :quoteId';
        $statement = $db->prepare($query);
        $statement->bindValue(':quoteId', $quoteId);
        $statement->execute();
    }
/*------------------------------------------------------------ Functions for submitted quotes-------------------------------------------*/
    //Select distinct authors amoung submitted
    function get_submitted_authors() {
        global $db;
        $query = 'SELECT DISTINCT author FROM submittedquotes ORDER BY author ASC';
        $statement = $db->prepare($query);
        $statement->execute();
        $quotes = $statement->fetchAll();
        $statement->closeCursor();
        return $quotes;
    }

    //Select distinct categories amoung submitted
    function get_submitted_categories() {
        global $db;
        $query = 'SELECT DISTINCT category FROM submittedquotes ORDER BY category ASC';
        $statement = $db->prepare($query);
        $statement->execute();
        $quotes = $statement->fetchAll();
        $statement->closeCursor();
        return $quotes;
    }    


    //List of all submitted quotes.
    function get_submitted_quotes() {
        global $db;
        $query = 'SELECT * FROM submittedquotes ORDER BY category ASC';
        $statement = $db->prepare($query);
        $statement->execute();
        $quotes = $statement->fetchAll();
        $statement->closeCursor();
        return $quotes;
    }


    //Select every thing for selected author in submitted
    function sort_submitted_author($authorName) {
        global $db;
        $query = 'SELECT * FROM submittedquotes WHERE author = :authorName';
        $statement = $db->prepare($query);
        $statement->bindValue(':authorName',$authorName);
        $statement->execute();
        $quotes = $statement->fetchAll();
        $statement->closeCursor();
        return $quotes;
    }

    //Select every thing for selected category in submitted
    function sort_submitted_category($categoryName) {
        global $db;
        $query = 'SELECT * FROM submittedquotes WHERE category = :categoryName';
        $statement = $db->prepare($query);
        $statement->bindValue(':categoryName',$categoryName);
        $statement->execute();
        $quotes = $statement->fetchAll();
        $statement->closeCursor();
        return $quotes;
    }

    //Select every thing for selected category/author
    function sort_both_submitted($authorName, $categoryName) {
        global $db;
        $query = 'SELECT * FROM submittedquotes WHERE author = :authorName AND category = :categoryName';
        $statement = $db->prepare($query);
        $statement->bindValue(':authorName',$authorName);
        $statement->bindValue(':categoryName',$categoryName);
        $statement->execute();
        $quotes = $statement->fetchAll();
        $statement->closeCursor();
        return $quotes;
    }

    //Approve a quote to the main quote database
    function approve_quote($text, $author, $category, $authorId, $categoryId) {
        global $db;
        $query= 'INSERT INTO quotes (text, author, category, authorId, categoryId) VALUES (:text, :author, :category, :authorId, :categoryId)';
        $statement = $db->prepare($query);
        $statement->bindValue(':text', $text);
        $statement->bindValue(':author', $author);
        $statement->bindValue(':category', $category);
        $statement->bindValue(':authorId', $authorId);
        $statement->bindValue(':categoryId', $categoryId);
        $statement->execute();
        $statement->closeCursor();
    }

    //Delete a quote from the submitted list
    function delete_quote($quoteId) {
        global $db;
        $query = 'DELETE FROM submittedquotes WHERE id = :quoteId';
        $statement = $db->prepare($query);
        $statement->bindValue(':quoteId', $quoteId);
        $statement->execute();
    }

    //Gets submitted quote from ID
    function get_submitted_by_id($id) {
        global $db;
        $query = 'SELECT * FROM submittedquotes WHERE id = :id';
        $statement = $db->prepare($query);
        $statement -> bindValue(':id', $id);
        $statement->execute();
        $quotes = $statement->fetchAll();
        $statement->closeCursor();
        return $quotes;
    }
?>