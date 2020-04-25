<?php 
    include('view/header.php');
    require('model/admin_db.php');
    require('model/database.php'); 
?>
    <section>        
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST") { 
                $username = filter_input(INPUT_POST, 'username');
                $password = filter_input(INPUT_POST, 'password');
                if(empty($username)) {
                    $error = "Something is wrong with the username. Check all fields and try again.";
                    include('errors/error.php');
                } else if (empty($password)) {
                    $error = "Something is wrong with the password. Check all fields and try again.";
                    include('errors/error.php');
                } else if(is_valid($username, $password) == FALSE) {
                    $error = "Passwords do not match what is on file. Check all fields and try again.";
                    include('errors/error.php');
                } else {
                    session_start();
                    $_SESSION['is_valid_admin'] = TRUE;
                    header(Location: "admin_index.php");
                }
            }
        ?>
    </section>
    <main class="page contact-page">
        <section class="portfolio-block contact">
            <div class="container">
                <div class="heading">
                    <h2>Log in</h2>
                </div>
                <form style="box-shadow: 0 2px 10px rgba(0,0,0,.1) !important;"action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <input type="hidden">
                    <div class="form-group"><label for="name">Username</label><input class="form-control item" type="text" id="name" name="username" required></div>
                    <div class="form-group"><label for="subject">Password</label><input class="form-control item" type="text" id="subject" name="password" required></div>
                    <div class="form-group"><button class="btn btn-primary btn-block btn-lg" type="submit" value="Log in">Log in</button></div>
                </form>
            </div>
        </section>
    </main>
    <!-- <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/pikaday.min.js"></script>
    <script src="assets/js/script.min.js"></script> -->
</body>

</html>
