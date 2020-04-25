<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Quotes List</title>
    <link rel="stylesheet" href="view\css\bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/css/pikaday.min.css">
</head>
<body>
        <nav class="navbar navbar-dark navbar-expand-lg fixed-top bg-white portfolio-navbar gradient">
            <div class="container"><button data-toggle="collapse" class="navbar-toggler" data-target="#navbarNav"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item" role="presentation"><a class="nav-link active" href="admin_index.php?action=admin_list">Home</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link active" href="admin_index.php?action=submit_list">Submitted Quotes</a></li>
                        <?php if(isset($_SESSION['is_valid_admin'])) { ?>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="admin_index.php?action=logout">Log out</a></li>
                        <?php } else { ?>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="admin_login.php">Log in</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>