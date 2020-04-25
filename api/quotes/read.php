<?php
    //The code below shows who can read this file and which type of content it will return.
    //The file can be read by anyone (asterisk * means all) and will return data in JSON format.
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    //I must use the getConnection() method of the Database class to get a database connection in order to read content.
    //I do this by including database and object files
    include_once '../config/database.php';
    include_once '../objects/quotes.php';
    include_once '../objects/categories.php';
    include_once '../objects/authors.php';
    
    //Start the database connection
    $database = new Database();
    $db = $database->getConnection();
    
    //Initialize objects
    $quotes = new Quotes($db);
    $authors = new Author($db);
    $categories = new Category($db);

    //Get posted data
    $json = file_get_contents('php://input');
    $data = json_decode($json);

    if($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($data)) {
        //If there is no authorId or categoryId passed, then we return all quotes.
        if(!isset($_GET['authorId']) && !isset($_GET['categoryId']) && !isset($_GET['limit'])) {
            //Query all the Quotes
            $statement = $quotes->read();
            $num = $statement->rowCount();
            
            //If num is > 0, then quotes db table is not empty
            if($num > 0){
                //Make an array of Quotes
                $quotes_arr = array();
                $quotes_arr["lines"] = array();
            
                //Retrieve contents
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
                    //Extract row; this will make $row['name'] to just $name only
                    extract($row);
            
                    $quotes_line = array(
                        "id" => $id,
                        "text" => $text,
                        "author" => $author,
                        "category" => $category
                    );
            
                    array_push($quotes_arr["lines"], $quotes_line);
                }
            
                // set response code - 200 OK
                http_response_code(200);
            
                // show data in json format
                echo json_encode($quotes_arr);

            } else{ 
                // no quotes found
                // set response code - 404 Not found
                http_response_code(404);
            
                // tell the user no quotes found
                echo json_encode(
                    array("message" => "No quotes found.")
                );
            }
        //If an authorId is passed without a categoryId then we show all authors or the selected author.  
        } else if (isset($_GET['authorId']) && !isset($_GET['categoryId']) && !isset($_GET['limit'])) {
            $auth = $_GET['authorId'];

            //If authors=all, show all authors
            if($auth == "all" || $auth == "All") {
                //Query all author quotes
                $statement = $authors->readAll();
                $num = $statement->rowCount();
                
                //If num is > 0, then the table is not empty
                if($num > 0){
                    //Make an array of authors
                    $authors_arr = array();
                    $authors_arr["Authors"] = array();
                
                    //Retrieve contents
                    while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
                        //Extract row; this will make $row['name'] to just $name only
                        extract($row);
                
                        $authors_line = array(
                            "authorId" => $authorId,
                            "author" => $author,
                        );
                
                        array_push($authors_arr["Authors"], $authors_line);
                    }
                
                    // set response code - 200 OK
                    http_response_code(200);
                
                    // show data in json format
                    echo json_encode($authors_arr);

                } else { 
                    // no authors found
                    // set response code - 404 Not found
                    http_response_code(404);
                
                    // tell the user no authors found
                    echo json_encode(
                        array("message" => "No authors found.")
                    );
                }
            } else if($auth != "all" || $auth != "All") {
                //Query specific author quotes
                $authors->authorId = $auth;
                $statement = $authors->authorIdQuote();
                $num = $statement->rowCount();
                //If num is > 0, then the table is not empty
                if($num > 0){
                    //Make an array of authors
                    $authors_arr = array();
                    $authors_arr["Authors"] = array();
                
                    //Retrieve contents
                    while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
                        //Extract row; this will make $row['name'] to just $name only
                        extract($row);
                
                        $authors_line = array(
                            "Quote ID" => $id,
                            "text" => $text,
                            "author" => $author,
                            "category" => $category
                        );
                
                        array_push($authors_arr["Authors"], $authors_line);
                    }
                
                    // set response code - 200 OK
                    http_response_code(200);
                
                    // show data in json format
                    echo json_encode($authors_arr);

                } else { 
                    // no authors found
                    // set response code - 404 Not found
                    http_response_code(404);
                
                    // tell the user no authors found
                    echo json_encode(
                        array("message" => "No authors found.")
                    );
                }
            }
        //If an categoryId is passed without a author Id then we show all categories or the selected category.  
        } else if (isset($_GET['categoryId']) && !isset($_GET['authorId']) && !isset($_GET['limit'])) {
            $cat = $_GET['categoryId'];

            //If category=all, show all categories
            if($cat == "all" || $cat == "All") {
                //Query all category quotes
                $statement = $categories->readAll();
                $num = $statement->rowCount();
                
                //If num is > 0, then the table is not empty
                if($num > 0){
                    //Make an array of categories
                    $categories_arr = array();
                    $categories_arr["Categories"] = array();
                
                    //Retrieve contents
                    while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
                        //Extract row; this will make $row['name'] to just $name only
                        extract($row);
                
                        $categories_line = array(
                            "categoryId" => $categoryId,
                            "category" => $category
                        );
                
                        array_push($categories_arr["Categories"], $categories_line);
                    }
                
                    // set response code - 200 OK
                    http_response_code(200);
                
                    // show data in json format
                    echo json_encode($categories_arr);

                } else { 
                    // no categories found
                    // set response code - 404 Not found
                    http_response_code(404);
                
                    // tell the user no categories found
                    echo json_encode(
                        array("message" => "No categories found.")
                    );
                }
            } else if($cat != "all" || $cat != "All") {
                //Query specific category quotes
                $categories->categoryId = $cat;
                $statement = $categories->categoryIdQuote();
                $num = $statement->rowCount();
                //If num is > 0, then the table is not empty
                if($num > 0){
                    //Make an array of categories
                    $categories_arr = array();
                    $categories_arr["Categories"] = array();
                
                    //Retrieve contents
                    while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
                        //Extract row; this will make $row['name'] to just $name only
                        extract($row);
                
                        $category_line = array(
                            "Quote ID" => $id,
                            "text" => $text,
                            "author" => $author,
                            "category" => $category
                        );
                
                        array_push($categories_arr["Categories"], $category_line);
                    }
                
                    // set response code - 200 OK
                    http_response_code(200);
                
                    // show data in json format
                    echo json_encode($categories_arr);

                } else { 
                    // no categories found
                    // set response code - 404 Not found
                    http_response_code(404);
                
                    // tell the user no categories found
                    echo json_encode(
                        array("message" => "No categories found.")
                    );
                }
            }   
        } else if (isset($_GET['categoryId']) && !isset($_GET['authorId']) && !isset($_GET['limit'])) {
            $cat = $_GET['categoryId'];

            //If category=all, show all categories
            if($cat == "all" || $cat == "All") {
                //Query all category quotes
                $statement = $categories->readAll();
                $num = $statement->rowCount();
                
                //If num is > 0, then the table is not empty
                if($num > 0){
                    //Make an array of categories
                    $categories_arr = array();
                    $categories_arr["Categories"] = array();
                
                    //Retrieve contents
                    while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
                        //Extract row; this will make $row['name'] to just $name only
                        extract($row);
                
                        $categories_line = array(
                            "categoryId" => $categoryId,
                            "category" => $category
                        );
                
                        array_push($categories_arr["Categories"], $categories_line);
                    }
                
                    // set response code - 200 OK
                    http_response_code(200);
                
                    // show data in json format
                    echo json_encode($categories_arr);

                } else { 
                    // no categories found
                    // set response code - 404 Not found
                    http_response_code(404);
                
                    // tell the user no categories found
                    echo json_encode(
                        array("message" => "No categories found.")
                    );
                }
            }
        //If both categoryId and authorId are passed
        } else if (isset($_GET['authorId']) && isset($_GET['categoryId']) && !isset($_GET['limit'])) {
            $auth = $_GET['authorId'];
            $cat = $_GET['categoryId'];

            //Change the cat and auth ID
            $quotes->authorId = $auth;
            $quotes->categoryId = $cat;
            
            //Query all category and author quotes
            $statement = $quotes->both();
            $num = $statement->rowCount();
            
            //If num is > 0, then the table is not empty
            if($num > 0){
                //Make an array of quotes
                $quotes_arr = array();
                $quotes_arr["Quote(s)"] = array();
            
                //Retrieve contents
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
                    //Extract row; this will make $row['name'] to just $name only
                    extract($row);
            
                    $quotes_line = array(
                        "id" => $id,
                        "text" => $text,
                        "author" => $author,
                        "category" => $category
                    );
            
                    array_push($quotes_arr["Quote(s)"], $quotes_line);
                }
            
                // set response code - 200 OK
                http_response_code(200);
            
                // show data in json format
                echo json_encode($quotes_arr);

            } else { 
                // no quotes found
                // set response code - 404 Not found
                http_response_code(404);
            
                // tell the user no quotes found
                echo json_encode(
                    array("message" => "No quotes found.")
                );
            }
        //Limits the number of quotes displayed. The quote is picked at random
        } else if(isset($_GET['limit'])) {
            //Query all category and author quotes
            $statement = $quotes->limit();
            $num = $statement->rowCount();
            
            //If num is > 0, then the table is not empty
            if($num > 0){
                //Make an array of quotes
                $quotes_arr = array();
                $quotes_arr["Quote"] = array();
            
                //Retrieve contents
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
                    //Extract row; this will make $row['name'] to just $name only
                    extract($row);
            
                    $quotes_line = array(
                        "id" => $id,
                        "text" => $text,
                        "author" => $author,
                        "category" => $category
                    );
            
                    array_push($quotes_arr["Quote"], $quotes_line);
                }
            
                // set response code - 200 OK
                http_response_code(200);
            
                // show data in json format
                echo json_encode($quotes_arr);

            } else { 
                // no quotes found
                // set response code - 404 Not found
                http_response_code(404);
            
                // tell the user no quotes found
                echo json_encode(
                    array("message" => "No quotes found.")
                );
            }
        }
    } else if(isset($data)) {
        //Makes sure data is not empty
        if(!empty($data->text) && !empty($data->author) && !empty($data->category)) {
        
            //Set quote values
            $quotes->text = $data->text;
            $quotes->author = $data->author;
            $quotes->category = $data->category;
        
            //Creates the quote
            if($quotes->create()){
        
                //Set response code - 201 created
                http_response_code(201);
        
                //Then tell the user
                echo json_encode(array("message" => "Quote was created."));
            } else{    //If if it doesn't work, tell the user
        
                //Set response code - 503 service unavailable
                http_response_code(503);
        
                //Tell the user
                echo json_encode(array("message" => "Unable to create quote."));
            }
        } else{ //Tell the user data is incomplete
        
            //Set response code - 400 bad request
            http_response_code(400);
        
            //Tell the user
            echo json_encode(array("message" => "Unable to create quote. Data is incomplete."));
        }
    }
?>