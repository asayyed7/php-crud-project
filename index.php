<!DOCTYPE html>
<html lang="en">
<head>
<title>Project</title>
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php require_once 'execute.php'; ?>

    <?php
        if (isset($_SESSION['message'])): ?>

    <?php 
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    ?>
    <?php endif; ?>

    <div class="container">
    <?php 
        $mysqli = new mysqli('localhost', 'root', '', 'documents') or die(mysqli_error($mysli));
        $result = $mysqli->query("SELECT * FROM docs") or die($mysqli->error);        
    ?>

    <div class="row justify-content-center">
        <table class="table">
            <thead>
                <tr>
                    <th>Personal Documents</th>
                    <th>Canadian Entity Documents</th>
                    <th>Current Entity Documents</th>
                    <th colspan="3">Action</th>
                </tr>
            </thead>
    <?php
        while ($row = $result->fetch_assoc()):?>
            <tr>
                <td><?php echo $row['perDoc'];?></td>
                <td><?php echo $row['canDoc'];?></td>
                <td><?php echo $row['curDoc'];?></td>
                <td>
                    <a href="index.php?edit=<?php echo $row['id']; ?>"
                    class="btn btn-info">Edit</a>
                    <a href="execute.php?delete=<?php echo $row['id']; ?>"
                    class="btn btn-danger">Delete</a>
                </td>
            </tr>  
            <?php endwhile; ?>
        </table>
    </div>

    <?php

        function before_res($array){
            echo '<before>';
            print_r($array);
            echo '</before>';
        }
    ?>

    <div class="row justify-content-center">
        <form action="execute.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="from-group">
            <label>Personal Documents</label>
            <input type="text" name="perDoc" class="form-control" value="<?php echo $perDoc; ?>">
        </div>
        <div class="from-group">
            <label>Canadian Entity Documents</label>
            <input type="text" name="canDoc" class="form-control" value="<?php echo $canDoc; ?>">
        </div>
        <div class="from-group">
            <label>Current Entity Documents</label>
            <input type="text" name="curDoc" class="form-control" value="<?php echo $curDoc; ?>">
        </div>
        <div class="from-group">
    <?php
    if ($update == true):  ?>  
        <button type="submit" class="btn btn-info" name="update">Update</button>
    <?php else: ?>
        <br>
    <button type="submit" class="btn btn-primary" name="add">Add</button>
    <?php endif; ?>
    </div>
    </form>
    </div>
    </div>
</body>
</html>