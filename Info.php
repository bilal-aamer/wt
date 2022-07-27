<?php
include 'config/db_connect.php';

if (isset($_POST['delete'])) {
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

    $sql = "DELETE FROM userdata WHERE id = $id_to_delete";

    if(mysqli_query($conn, $sql)){
        header("Location: home.php");
    }else{
        echo 'Query Error: ' . mysqli_error($conn);
    }
}

if (isset($_GET['id'])) {

    // escape sql chars
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM userdata WHERE id = $id";

    $result = mysqli_query($conn, $sql);

    $user = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<?php include 'templates/header.php' ?>

<div class="container center">
    <?php if ($user) : ?>
        <h1>User: <b><?php echo $user['name'] ?></b></h1>
        <h4>Email: <?php echo $user['email'] ?></h4>
        <h3>Password: <?php echo $user['password'] ?></h3>
        <form action="info.php" method="POST">
            <input type="hidden" name="id_to_delete" value="<?php echo $id?>">
            <input type="submit" name="delete" value="Delete User" class="btn brand z-depth-0">
        </form>
    <?php else : ?>
        <h3><b>No such User Exists!</b></h3>
    <?php endif ?>
</div>

<?php include 'templates/footer.php' ?>

</html>