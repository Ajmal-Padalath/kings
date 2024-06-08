<?php
include 'config.php';
include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "user name or email already exist";
        ?>
            <br>
            <a href="register.php">
                <button type="button" class="btn btn-info">Register</button>
            </a>
        <?php
        exit();
    }
    $sql = "INSERT INTO users (username,email, password) VALUES ('$username', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful";
        header('Location: login.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form method="post">
        Username: <input type="text" name="username" required><br><br>
        Email: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="email" name="email" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        <input type="submit" value="Register">
    </form>
    <div>
        Login ? 
        <a href="login.php">
            <button type="button" class="btn btn-success">Login</button>
        </a>
    </div>
</body>
</html>