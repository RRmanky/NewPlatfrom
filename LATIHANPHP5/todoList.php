<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'koneksi.php';

$username = $_SESSION['username'];

// Query ambil todo list
$sql = "SELECT * FROM todo WHERE user_id = (SELECT id FROM user WHERE username = '$username')";
$result = mysqli_query($conn, $sql);

// Menampilkan todo list
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('mesir.jpg'); 
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0;
            padding: 20px;
        }

        .todo-item {
            background-color: #fff;
            border-radius: 5px;
            margin-bottom: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 15px;
        }

        .todo-item.completed {
            background-color: #d4edda;
        }

        .todo-action {
            display: flex;
            align-items: center;
        }

        .todo-action button {
            margin-left: 10px;
        }

        #selesai {
            text-decoration: line-through;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .list-group {
            border-radius: 10px;
        }

        .btn {
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">Todo List</h1>
        <div class="row">
            <div class="col-md-8 mx-auto">
                <ul class="list-group">
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <li class="list-group-item todo-item <?php echo ($row['status'] == 'Selesai') ? 'completed' : ''; ?>">
                            <div id="<?php echo $row['status']; ?>" class="todo-content"><?php echo $row['todolist']; ?></div>
                            <div class="todo-action">
                                <?php if ($row['status'] != 'Selesai') : ?>
                                    <form method="post" action="todoList.php">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="selesai" class="btn btn-success btn-sm">Selesai</button>
                                        <button type="submit" name="hapus" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                <?php endif; ?>
                                <span class="badge badge-primary badge-pill ml-auto"><?php echo $row['status']; ?></span>
                            </div>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-8 mx-auto text-center">
                <a href="tambahTodo.php" class="btn btn-primary">Tambah Todo</a>
                <a href="logout.php" class="btn btn-danger ml-2">Logout</a>
            </div>
        </div>
    </div>

    <?php
    // Memproses penandaan tugas sebagai selesai
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['hapus'])) {
        $id = $_POST['id'];

        // Query hapus todo dari database
        $sql_delete = "DELETE FROM todo WHERE id = $id";

        if (mysqli_query($conn, $sql_delete)) {
            // Refresh halaman
            echo "<meta http-equiv='refresh' content='0'>";
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['selesai'])) {
        $id = $_POST['id'];

        // Query hapus todo dari database
        $sql_delete = "UPDATE todo SET status = 'selesai' WHERE  id = $id";

        if (mysqli_query($conn, $sql_delete)) {
            // Refresh halaman
            echo "<meta http-equiv='refresh' content='0'>";
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    }
    ?>
</body>
</html>
