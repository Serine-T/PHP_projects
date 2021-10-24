<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
     <?php require_once 'process.php'; ?> 

    <?php

    if(isset($_SESSION['message'])): ?>


    <div class="alert alert-<?=$_SESSION['msg_type']?>">
        <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        ?>
    </div>
    <?php endif  ?>

    <section>
        <div class="container p-3">
            <form action="process.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="form-group p-2">
                    <label>
                        <span>Name</span>
                        <input class="form-control" type="text" name="name" placeholder="Enter your name" 
                        value="<?php echo $name; ?>">
                    </label>
                </div>

                <div class="form-group p-2">
                    <label>
                        <span>Location</span>
                        <input class="form-control" type="text" name="location" placeholder="Enter your location"
                        value="<?php echo $location; ?>"> 
                    </label>
                </div>

                <div class="form-group p-2">
                    <?php 
                        if($update):
                    ?>
                        <button class="btn btn-info p-2" type="submit" name="update">Update</button>

                    <?php else: ?>
                        <button class="btn btn-primary p-2" type="submit" name="save">Save</button>
                    <?php endif; ?>
                </div> 
            </form>
        </div>
    </section>

    <section>
        <div class="container">
            <?php  
                $mysqli = new mysqli('localhost', 'root', '', 'todolist') or die(mysqli_error($mysqli));
                $result = $mysqli->query("SELECT * FROM crud ") or die($mysqli->error);
            ?>

            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    while($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['location']; ?></td>
                            <td>
                                <a href="index.php?edit=<?php echo $row['id'];?>" class="btn btn-info">Edit</a> 
                                <a href="process.php?delete=<?php echo $row['id'];?>" class="btn btn-danger">Delete</a> 
                            </td>
                        </tr>
                <?php endwhile; ?> 
                </tbody>          
            </table>
        </div>
    </section>
</body>
</html>