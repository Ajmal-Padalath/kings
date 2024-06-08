<?php
include 'config.php';
include 'header.php';
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2 class="page_header">Welcome, <?php echo $_SESSION['username']; ?></h2>
    <div id="index_div">
        <a href="logout.php"><button type="button" class="btn btn-danger">Logout</button></a> <br> <br>
        <a href="products.php"><button type="button" class="btn btn-info">Products</button></a>
    </div>
</body>
</html>