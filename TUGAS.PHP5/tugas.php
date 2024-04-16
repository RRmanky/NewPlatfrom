<?php
// Inisialisasi session
session_start();

// Koneksi ke database (sesuaikan dengan konfigurasi database Anda)
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database_name";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fungsi untuk melakukan enkripsi password
function encryptPassword($password) {
    return md5($password); // Misalnya menggunakan MD5, sesuaikan dengan kebutuhan
}

// Fungsi untuk menambahkan user baru ke database
function addUser($username, $password) {
    global $conn;
    $encryptedPassword = encryptPassword($password);
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$encryptedPassword')";
    $conn->query($sql);
}

// Fungsi untuk melakukan login
function login($username, $password) {
    global $conn;
    $encryptedPassword = encryptPassword($password);
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$encryptedPassword'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // Login berhasil
        $_SESSION['username'] = $username;
        return true;
    } else {
        // Login gagal
        return false;
    }
}

// Fungsi untuk menambahkan task baru
function addTask($task) {
    global $conn;
    $username = $_SESSION['username'];
    $sql = "INSERT INTO tasks (username, task) VALUES ('$username', '$task')";
    $conn->query($sql);
}

// Fungsi untuk menyelesaikan task
function completeTask($taskId) {
    global $conn;
    $sql = "DELETE FROM tasks WHERE id=$taskId";
    $conn->query($sql);
}

// Fungsi untuk menghapus task
function deleteTask($taskId) {
    global $conn;
    $sql = "DELETE FROM tasks WHERE id=$taskId";
    $conn->query($sql);
}

// Logout
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Tambah task
if (isset($_POST['task'])) {
    addTask($_POST['task']);
}

// Selesai task
if (isset($_GET['complete'])) {
    completeTask($_GET['complete']);
}

// Hapus task
if (isset($_GET['delete'])) {
    deleteTask($_GET['delete']);
}

?>
<?php
$server = "localhost";
$user = "username_database";
$pass = "password_database";
$database = "nama_database";
$conn = mysqli_connect($server, $user, $pass, $database);
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>
<?php
  session_start();
  require_once "koneksi.php"; // Memuat file koneksi ke database
  
  // Cek jika pengguna belum login, redirect ke halaman login
  if (!isset($_SESSION['username'])) {
      header("Location: login.php");
      exit;
  }
  
  $username = $_SESSION['username'];
  
  // Proses form jika disubmit
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (!empty($_POST['task'])) {
          $task = $_POST['task'];
          $stmt = $conn->prepare("INSERT INTO tasks (username, task) VALUES (?, ?)");
          $stmt->bind_param("ss", $username, $task);
          $stmt->execute();
          $stmt->close();
      }
  }
  
  // Hapus task jika ada parameter delete di URL
  if (isset($_GET['delete'])) {
      $deleteId = $_GET['delete'];
      $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ? AND username = ?");
      $stmt->bind_param("is", $deleteId, $username);
      $stmt->execute();
      $stmt->close();
  }
  
  // Tandai task sebagai selesai jika ada parameter complete di URL
  if (isset($_GET['complete'])) {
      $completeId = $_GET['complete'];
      $stmt = $conn->prepare("UPDATE tasks SET completed = 1 WHERE id = ? AND username = ?");
      $stmt->bind_param("is", $completeId, $username);
      $stmt->execute();
      $stmt->close();
  }
  
  // Ambil daftar task
  $sql = "SELECT * FROM tasks WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();
  
  ?>