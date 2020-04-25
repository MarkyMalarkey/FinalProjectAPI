<?php
    require('model/database.php');
    require('model/quote.php');
    require('model/admin_db.php');


    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL) {
        $action = filter_input(INPUT_GET, 'action');
        if ($action == NULL) {
            $action = 'list';
        }
    }

    if ($action == 'list') {
        $quote = get_quotes();
        $author = get_authors();
        $category = get_categories();
        include('list.php');
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
            include('list.php');
        } else if ($sortA == "None" && $sortC != "None") {
            //We sort by category
            $quote = sort_category($sortC);
            $author = get_authors();
            $category = get_categories();
            include('list.php');
        } else if ($sortA !="None" && $sortC !="None" ) {
            //We sort by both
            $quote = sort_both($sortA, $sortC);
            $author = get_authors();
            $category = get_categories();
            include('list.php');
        } else {
            //Mean both sortA and sortC are none. 
            $quote = get_quotes();
            $author = get_authors();
            $category = get_categories();
            include('list.php');
        }
    } 
    
?>