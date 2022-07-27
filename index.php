<?php

include 'config/db_connect.php';

// error_reporting(E_ERROR | E_PARSE);
$email = $name = $password = '';
$errors = array('name' => '', 'email' => '', 'password' => '');

if (isset($_POST["submit"])) {
    // echo $_POST["email"];
    // echo $_POST["name"];
    // echo $_POST["password"];

    // check name
    if (empty($_POST["name"]))
        $errors['name'] =  "A name is required! <br/>";
    else {
        $name = $_POST["name"];
        if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
            $errors['name'] =  "Name contains chars and spaces ONLY!<br/>";
        }
    }

    // check email
    if (empty($_POST["email"]))
        $errors['email'] =  "An email is required! <br/>";
    else {
        $email = $_POST["email"];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] =  "Email must be a valid email address <br/>";
        }
    }

    // check name
    if (empty($_POST["password"]))
        $errors['password'] =   "A password is required! <br/>";
    else {
        $password = $_POST["password"];
        if (!preg_match('/^[a-zA-Z0-9]+$/', $password)) {
            $errors['password'] =  "Password must be alpha numeric ONLY!<br/>";
        }
    }
}

if (array_filter($errors)) {
    echo 'Errors in form!';
} else {

    // $name = mysqli_real_escape_string($conn, $_POST['name']);
    // $email = mysqli_real_escape_string($conn, $_POST['email']);
    // $password = mysqli_real_escape_string($conn, $_POST['password']);

    //create sql
    $sql = "insert into userdata(name, email, password) values('$name', '$email', '$password')";

    //save to DB and check
    if (mysqli_query($conn, $sql)) {
        //success
        // header('Location:  home.php');
    } else {
        echo "Query Error: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html>
<?php include 'templates/header.php' ?>

<section class="container grey-text">
    <h4 class="center">Enter User Data</h4>
    <form class="white" action="index.php" method="POST">
        <label>Name</label>
        <input type="text" name="name" value="<?php echo $name ?>">
        <div class="red-text"><?php echo $errors["name"] ?></div>
        <label>Email</label>
        <input type="text" name="email" value="<?php echo $email ?>">
        <div class="red-text"><?php echo $errors["email"] ?></div>
        <label>Password</label>
        <input type="password" name="password" value="<?php echo $password ?>">
        <div class="red-text"><?php echo $errors["password"] ?></div>
        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
        </div>
    </form>
</section>

<?php include 'templates/footer.php' ?>

</html>