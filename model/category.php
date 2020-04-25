<?php
    //Checks to see if category already exists in the category table
    function check_category($category) {
        global $db;
        $query = 'SELECT category FROM categories WHERE category = :category';
        $statement = $db->prepare($query);
        $statement->bindValue(':category', $category);
        $statement->execute();
        return $statement;
    }

    //Adds category to the category table
    function add_category($category) {
        global $db;
        $query = 'INSERT INTO categories (category) VALUES (:category)';
        $statement = $db->prepare($query);
        $statement->bindValue(':category', $category);
        $statement->execute();
        $statement->closeCursor();
    }

    //Get categoryId from name
    function get_cat_id($category) {
        global $db;
        $query = 'SELECT categoryId FROM categories WHERE category = :category';
        $statement = $db->prepare($query);
        $statement->bindValue(':category', $category);
        $statement->execute();
        $cat = $statement->fetchAll();
        return $cat;
    }
?>