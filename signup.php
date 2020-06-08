<?php

    include("connection.php");

    if (array_key_exists('email', $_POST) OR array_key_exists('password', $_POST) OR array_key_exists('passwordconfirm', $_POST)) {
        if ($_POST['email'] == '') {
            echo "<p>Email address is required.</p>";
        } else if ($_POST['password'] == '') {
            echo "<p>Password is required.</p>";
        } else if ($_POST['passwordconfirm'] == '') {
            echo "<p>Please confirm your password.</p>";
        } else {
            $query = "SELECT `id` FROM `users` WHERE `email` = '".mysqli_real_escape_string($link, $_POST['email'])."'";
            $result = mysqli_query($link, $query);
            if (mysqli_num_rows($result) > 0) {
                echo "<p>That email address has already been taken.</p>";
            } else if ($_POST['password'] != $_POST['passwordconfirm']) {
                echo "<p>Please enter the same password.</p>";
            } else {
                $query = "INSERT INTO `users` (`email`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."', '".mysqli_real_escape_string($link, $_POST['password'])."')";

                if (mysqli_query($link, $query)) {
                    $query = "UPDATE `users` SET `password` = '".md5(md5(mysqli_insert_id($link)).$_POST['password'])."' WHERE `id` = ".mysqli_insert_id($link)." LIMIT 1";
                    mysqli_query($link, $query);
                    header("Location: login.php");
                    echo "<p>You have been signed up.</p>";

                } else {
                    echo "<p>There was a problem signing you up - please try again later.</p>";
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>Pull List</title>
    <link rel="icon" href="images/capshield.png">

    <link rel="stylesheet" href="css/pull-list.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

</head>
<body>

<div class="container" id="form-align">
    <h1 id="form-title">Sign Up Form</h1>

    <form method="post">
        <fieldset class="form-group">
            <input class="form-control" name="email" type="text" placeholder="Email address">
        </fieldset>
        <fieldset class="form-group">
            <input class="form-control" name="password" type="password" placeholder="Password">
        </fieldset>
        <fieldset class="form-group">
            <input class="form-control" name="passwordconfirm" type="password" placeholder="Confirm Password">
        </fieldset>
        <fieldset class="form-group">
            <input class="btn btn-danger wb-side" type="submit" value="Sign up">
        </fieldset>
    </form>

    <a href="login.php"><h2 class="btn btn-danger">Already A Member? Sign In Here</h2></a>
</div>



<script src="js/pull-list.js"></script>
</body>
</html>
