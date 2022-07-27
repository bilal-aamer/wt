<?php

include 'config/db_connect.php';

// write quesry for all users
$sql = 'SELECT id, name , email FROM userdata order by id';

//make quesry and get results
$result = mysqli_query($conn, $sql);


//fecth resukting rows as array
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);

//close conn
mysqli_close($conn);

// print_r($users);
?>

<!DOCTYPE html>
<html>
<?php include 'templates/header.php' ?>

<div class="container">
    <div class="row">
        <?php foreach ($users as $u) : ?>
            <div class="col s6 m4">
                <div class="card z-depth-0">
                    <div class="card-content center">
                        <h5><?php echo $u['name'] ?></h5>
                        <ul class="grey-text">
                            <li><?php echo $u['email'] ?></li>
                        </ul>
                    </div>
                    <div class="card-action right-align">
                        <a class="brand-text" href="info.php?id=<?php echo $u['id']?>" name= info >User Info</a>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>

<?php include 'templates/footer.php' ?>

</html>