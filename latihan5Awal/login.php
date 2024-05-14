<?php 
    session_start();
    require 'koneksi.php';
    
    if (isset($_POST['regiss'])) {
        $_SESSION["regis"] = true;
        header("Location: register.php");
        exit();
    } elseif(isset($_POST['loginbtn'])){
        login($_POST);
    }
    

    function login($data){
        global $conn;
        $x = '';
        $username = $data['username'];
        $password = $data['password'];

        $result = mysqli_query($conn,"SELECT * FROM user WHERE Username = '$username'");

        if(mysqli_num_rows($result) == 0){
            echo "<script>
                     alert('Username tidak ditemukan pastikan ada memasukan username dengan benar');
                  </script>";
        } else {
            $row = mysqli_fetch_assoc($result);

            if (password_verify($password,$row["password"])) {
                $_SESSION["login"] = true;
                header("Location: todoList.php");
                exit();
            } else {
                echo "<script>
                     alert('Password salah');
                  </script>";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Login.css">
</head>
<body>
    <form action="" method="post">
        <div class="container">
            <h6> LOGIN </h6>
            <div class="grup">
                <label for="username"> Username </label>
                <input type="text" id="username" name="username" placeholder="Username">
            </div>
            <div class="grup">
                <label for="password"> password </label>
                <input type="text" id="password" name="password" placeholder="password">
            </div>

            <button class="regis" name="regiss">Registrasi</button>
            <button type="submit" class="Loginbtn" name="loginbtn"> Login </button>
        </div>
    </form>
</body>
</html>