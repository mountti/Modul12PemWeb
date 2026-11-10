<?php
session_start();
require_once "koneksiMVC.php";

if (isset($_SESSION['jabatan'])) {
    header("Location: index.php");
    exit;
}

$pesan = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $mysqli->prepare(
        "SELECT * FROM pengguna WHERE username = ?"
    );
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['jabatan'] = $user['jabatan'];

        header("Location: index.php");
        exit;
    } else {
        $pesan = "Username atau password salah!";
    }
}
?>

<h2>Login BEM</h2>

<form method="POST">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit" name="login">Login</button>
</form>

<p><?php echo htmlspecialchars($pesan); ?></p>
