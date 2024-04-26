<?php 
    session_start();
    if (!isset($_SESSION["login"])) {
        header("Location: login.php");
        exit(); 
    }
    require 'koneksi.php';
    $error ='';
    $kls = '';
    if (isset($_POST['tambah'])){
        if (!empty($_POST['todo'])){
            tambahTodo($_POST);
            header("Location: todoList.php");
            exit();
        } else {
            echo "<script> 
                  alert('data harus diisi');
                  </script>";
        }
    }

    foreach ($_POST as $key => $value) {
        if (strpos($key, 'hapus') !== false) {
            $index = substr($key, strlen('hapus')); 
            hapus($_POST, $index);
        }
    }

    
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'selesai') !== false) {
            $index = substr($key, strlen('selesai')); 
            $kls = selesai($_POST, $index);
        }
    }

    $text = query("SELECT todolist FROM todo");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="todo.css">
</head>
<body>
    <form action="" method="post">
        <div class="container">
            <div class="tambah-todo">
                <input type="text" name="todo" placeholder="Teks todo">
                <button class="tambah" name="tambah"> Tambah</button>
            </div>
            <?php foreach ($text as $index => $isi):?>
            <div class="show-todo">
                <input type="text" name = "isi<?php echo $index;?>" value="<?php echo $isi['todolist']; ?>" class="<?php echo $kls;?>" >
                <button class="tambah" name= "selesai<?php echo $index;?>">Selesai</button>
                <button class="tambah" name= "hapus<?php echo $index;?>">Hapus</button>
                <input type="hidden" name="index" value="<?php echo $index; ?>">
            </div>
            <?php endforeach;?>
        </div>
    </form>
</body>
<?php 

?>
</html>