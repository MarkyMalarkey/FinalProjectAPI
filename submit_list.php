<?php 
    include('view/header.php');
    require_once('util/valid_admin.php');
?>
        <main class="page lanidng-page">
            <section class="d-inline-block d-lg-flex justify-content-center align-content-center flex-nowrap justify-content-lg-end align-items-lg-center portfolio-block skills" style="height: 10px;padding: 50px;">
                <div class="container d-inline-block d-lg-flex justify-content-center align-items-center align-content-center justify-content-lg-center align-items-lg-center">
                    <form action="admin_index.php" method="POST">
                        <input type="hidden" name="action" value="sortBy2">    
                        <select name="sortA2">
                            <optgroup label="Select Author">
                            <option>None</option>
                                <?php foreach ($author as $authors) :?>
                                    <option value="<?php echo $authors['author'];?>"> <?php echo $authors['author'];?></option>
                                <?php endforeach;?>
                            </optgroup>
                        </select>
                        <select name="sortC2">
                            <optgroup label="Select Category" >
                            <option>None</option>
                                <?php foreach ($category as $categories) :?>
                                    <option value="<?php echo $categories['category'];?>"> <?php echo $categories['category'];?></option>
                                <?php endforeach;?>
                            </optgroup>
                        </select>
                        <input type="submit" value="Sort" />
                    </form>
                </div>
            </section>
        </main>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Text</th>
                        <th class="text-center">Author</th>
                        <th class="text-center">Category</th>
                        <th class="text-center">Approve</th>
                        <th class="text-center">Delete</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($quote as $quotes) : ?>
                    <tr>
                        <td class="text-center"><?php echo $quotes['id']; ?></td>
                        <td class="text-center"><?php echo $quotes['text']; ?></td>
                        <td class="text-center"><?php echo $quotes['author']; ?></td>
                        <td class="text-center"><?php echo $quotes['category']; ?></td>
                        <td><form action="admin_index.php" method="post">
                        <input type="hidden" name="action" value="approve_submitted">
                        <input type="hidden" name="id" value="<?php echo $quotes['id']; ?>">
                        <input type="submit" value="Approve">
                        </form></td>
                        <td><form action="admin_index.php" method="post">
                        <input type="hidden" name="action" value="delete_submitted">
                        <input type="hidden" name="id" value="<?php echo $quotes['id']; ?>">
                        <input type="submit" value="Delete">
                        </form></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/pikaday.min.js"></script>
        <script src="assets/js/script.min.js"></script>
    </body>
</html>