<?php

    session_start();

    if ((array_key_exists("id", $_SESSION) AND $_SESSION) OR (array_key_exists("id", $_COOKIE) AND $_COOKIE)) {
        header("Location: index.php");
    }

    include("connection.php");

    if (array_key_exists('email', $_POST) OR array_key_exists('password', $_POST)) {
        if ($_POST['email'] == '') {
            echo "<p>Email address is required.</p>";
        } else if ($_POST['password'] == '') {
            echo "<p>Password is required.</p>";
        } else {

            $query = "SELECT * FROM `users` WHERE `email` = '".mysqli_real_escape_string($link, $_POST['email'])."'";
            $result = mysqli_query($link, $query);
            $row = mysqli_fetch_array($result);

            if (array_key_exists("id", $row)) {
                $hashedPass = md5(md5($row['id']).$_POST['password']);
                if ($hashedPass == $row['password']) {
                    $_SESSION['id'] = $row['id'];
                    if ($_POST['stayLoggedIn'] == '1') {
                        setcookie("id", $row['id'], time() + 60*60*24*3);
                    }
                    header("Location: index.php");
                    echo "<p>You have been logged in.</p>";

                } else {
                    echo "<p>Incorrect password associated with that email address.</p>";
                }
            } else {
                echo "<p>Could not find an account associated with that email address.</p>";
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
    <h1 id="form-title">Login Form</h1>

    <form method="post">
        <fieldset class="form-group">
            <input class="form-control" name="email" type="text" placeholder="Email address">
        </fieldset>
        <fieldset class="form-group">
            <input class="form-control" name="password" type="password" placeholder="Password">
        </fieldset>
        <fieldset class="form-check">
            <input class="form-check-input wi-side" id="checkbox1" name="stayLoggedIn" type="checkbox" value=1>
            <label class="form-check-label wi-side" for="checkbox1">Stay Logged In</label>
        </fieldset>
        <fieldset class="form-group">
            <input class="btn btn-danger wb-top wb-side" name="submit" type="submit" value="Login">
        </fieldset>
    </form>

    <a href="signup.php"><h2 class="btn btn-danger">New? Sign Up Here</h2></a>
</div>

<script src="js/pull-list.js"></script>
</body>
</html>
