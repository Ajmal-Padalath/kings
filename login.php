<?php
include 'config.php';
include 'header.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username' AND email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header('Location: index.php');
            exit();
        } else {
            echo "Invalid password";
        }
    } else {
        echo "No user found";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post">
        Username: <input type="text" name="username" required><br><br>
        Email: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="email" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        <input type="submit" class="btn btn-success" value="Login">
    </form>
    <div>
        New user ? 
        <a href="register.php">
            <button type="button" class="btn btn-info">Register</button>
        </a>
    </div>
</body>
</html>