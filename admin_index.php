<?php
        require_once('util/valid_admin.php');
        require('model/database.php');
        require('model/quote.php');
        require('model/author.php');
        require('model/category.php');
        require_once('model/admin_db.php');


        $action = filter_input(INPUT_POST, 'action');
        if ($action == NULL) {
            $action = filter_input(INPUT_GET, 'action');
            if ($action == NULL) {
                $action = 'admin_list';
            }
        }

        if ($action == 'admin_list') {
            $quote = get_quotes();
            $author = get_authors();
            $category = get_categories();
            include('admin_list.php');
        } else if ($action == 'sortBy') {
            //Sort list for the admin list of approved quotes.
            $sortA = filter_input(INPUT_POST, 'sortA');
            $sortC = filter_input(INPUT_POST, 'sortC');
            //Differentiate between sorting one or both
            if ($sortA !="None" && $sortC =="None" ) {
                //We sort by author
                $quote = sort_author($sortA);
                $author = get_authors();
                $category = get_categories();
                include('admin_list.php');
            } else if ($sortA == "None" && $sortC != "None") {
                //We sort by category
                $quote = sort_category($sortC);
                $author = get_authors();
                $category = get_categories();
                include('admin_list.php');
            } else if ($sortA !="None" && $sortC !="None" ) {
                //We sort by both
                $quote = sort_both($sortA, $sortC);
                $author = get_authors();
                $category = get_categories();
                include('admin_list.php');
            } else {
                //Mean both sortA and sortC are none. 
                $quote = get_quotes();
                $author = get_authors();
                $category = get_categories();
                include('admin_list.php');
            }
        } else if($action == 'delete') {
            //Deletes quote
            $quoteId = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            if ($quoteId == NULL || $quoteId == FALSE) {
                $error = "Invalid item field. Check all fields and try again.";
                include('errors/error.php');
            } else {
                delete($quoteId);
                header("Location: admin_index.php?action=admin_list");
            }
        } else if($action == 'submit_list') {
            //Checks the list of submitted quotes
            $quote = get_submitted_quotes();
            $author = get_submitted_authors();
            $category = get_submitted_categories();
            include('submit_list.php');
        } else if ($action == 'sortBy2') {
            //Sort list for the admin list of submitted quotes.
            $sortA2 = filter_input(INPUT_POST, 'sortA2');
            $sortC2 = filter_input(INPUT_POST, 'sortC2');
            //Differentiate between sorting one or both
            if ($sortA2 !="None" && $sortC2 =="None" ) {
                //We sort by author
                $quote = sort_submitted_author($sortA2);
                $author = get_submitted_authors();
                $category = get_submitted_categories();
                include('submit_list.php');
            } else if ($sortA2 == "None" && $sortC2 != "None") {
                //We sort by category
                $quote = sort_submitted_category($sortC2);
                $author = get_submitted_authors();
                $category = get_submitted_categories();
                include('submit_list.php');
            } else if ($sortA2 !="None" && $sortC2 !="None" ) {
                //We sort by both
                $quote = sort_both_submitted($sortA2, $sortC2);
                $author = get_submitted_authors();
                $category = get_submitted_categories();
                include('submit_list.php');
            } else {
                //Mean both sortA2 and sortC2 are none. 
                $quote = get_submitted_quotes();
                $author = get_submitted_authors();
                $category = get_submitted_categories();
                include('submit_list.php');
            } 
        } else if($action == 'approve_submitted'){
            //Approves the quote and then deletes the quote from the submitted quotes list
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            $subquote = get_submitted_by_id($id);
            foreach ($subquote as $subquotes ) {
                $text = $subquotes['text'];
                $author = $subquotes['author'];
                $category = $subquotes['category'];
            }
            
            //Checks to see if author is in the author database
            if(isset($author)) {
                $auth = check_author($author);
                $num = $auth->rowCount();
                //If num > 0, then there is an author with that name in the database so we will not add it again.
                if( $num > 0 ){
                    //Do nothing
                } else {
                    //Else we add the name to the database
                    add_author($author);
                }
            }
            //Now we do the same for categories
            if(isset($category)) {
                $cat = check_category($category);
                $num = $cat->rowCount();
                //If num > 0, then there is an author with that name in the database so we will not add it again.
                if( $num > 0 ){
                    //Do nothing
                } else {
                    //Else we add the name to the database
                    add_category($category);
                }
            }
            //Adds quote to the approved list
            if (isset($text) || isset($author)|| isset($category)) {
                $a = get_auth_id($author);
                $c = get_cat_id($category);
                
                //Converts array to string to find the author id
                foreach($a as $aa) {
                    $auth = $aa['authorId'];
                }

                //Converts array to string to find the category id
                foreach($c as $cc) {
                    $cat = $cc['categoryId'];
                }

                //Finally adds the quote to the approved quote list
                approve_quote($text, $author, $category, $auth, $cat);
                
                //Run a function to delete the quote after approval
                delete_quote($id);
                $quote = get_submitted_quotes();
                $author = get_submitted_authors();
                $category = get_submitted_categories();
                include('submit_list.php');
            } else {
                $error = "Invalid item field. Check all fields and try again.";
                include('errors/error.php');
            }
        } else if($action == 'delete_submitted') {
            //Deletes the submitted quote
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            if(isset($id)) {
                delete_quote($id);
                $quote = get_submitted_quotes();
                $author = get_submitted_authors();
                $category = get_submitted_categories();
                include('submit_list.php');
            } else {
                $error = "Invalid item field. Check all fields and try again.";
                include('errors/error.php');
            }
        }else if ($action == 'logout') {
            //Logs the admin out of the session
            $_SESSION = array();
            session_destroy();
            header("Location: admin_index.php");
        }
    
?>