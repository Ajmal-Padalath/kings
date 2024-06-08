<?php
include 'config.php';
include 'header.php';
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];

    $productSql = "SELECT * FROM products WHERE name = '$name'";
    $result = $conn->query($productSql);
    if ($result->num_rows > 0) {
        echo "This product is already exist";
        ?>
            <br>
            <a href="add_product.php">
                <button type="button" class="btn btn-success">Add Products</button>
            </a>
        <?php
        exit();
    }
    $sql = "INSERT INTO products (name, price) VALUES ('$name', '$price')";

    if ($conn->query($sql) === TRUE) {
        echo "Product added successfully";
        ?>
            <br>
            <a href="products.php"><button type="button" class="btn btn-primary">View</button></a>
        <?php
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
</head>
<body>
    <h2>Add Product</h2>
    <form method="post">
        Name: <input type="text" name="name" required><br> <br>
        Price: <input type="number" step="0.01" name="price" required><br> <br>
        <input type="submit" value="Add Product">
    </form>
</body>
</html>