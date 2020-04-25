<?php 
    include('view/header.html');
?>
<!-- the body section -->
<body>
    <header><h1>Quote List</h1></header>

    <main>
        <h1>Database Error</h1>
        <p>There was an error connecting to the database.</p>
        <p>Error message: <?php echo $error_message; ?></p>
        <p>&nbsp;</p>
    </main>
</body>
</html>