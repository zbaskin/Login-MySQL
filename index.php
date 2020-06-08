<?php

    session_start();

    if (array_key_exists("id", $_COOKIE)) {
        $_SESSION['id'] = $_COOKIE['id'];
    }

    if (array_key_exists("id", $_SESSION)) {
        echo "<p><a href='logout.php'>Log out</a></p>";
    } else {
        header("Location: login.php");
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
<!--
<div class="container">
    <div id="signup" class="float-left">
        <a href="signup.php"><button>Sign Up</button></a>
    </div>
    <div id="login">
        <a href="login.php"><button>Login</button></a>
    </div>
</div>
-->
<div class="container">

    <div id="myDIV" class="header">
        <h1 id="name">My Pull List</h1>
        <input type="text" id="myInput" placeholder="Title...">
        <span onclick="newElement()" class="addBtn">Add</span>
    </div>

    <ul id="myUL">

    </ul>

</div>

<script src="js/pull-list.js"></script>
</body>
</html>
