<?php 
    require 'koneksi.php';

    session_start();
    if (!isset($_SESSION["regis"])) {
        header("Location: login.php");
        exit(); 
    }

    if (isset($_POST['submitbtn'])) {
        tambahAkun($_POST);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="regis.css">
</head>
<body>
    <form action="" method="post">
        <div class="container">
            <h6>Register</h6>
            <div class="grup">
                <label for="name">Nama</label>
                <input type="text" name="nama" placeholder="Username">
            </div>
            <div class="grup">
                <label for="password1">Password</label>
                <input type="text" name="password1" placeholder="Password">
            </div>
            <div class="grup">
                <label for="password2">Password</label>
                <input type="text" name="password2" placeholder="Password">
            </div>

            <button type="submit" class="submitbtn" name="submitbtn">Submit</button>
        </div>
    </form>
</body>
</html>