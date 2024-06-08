<?php
include 'config.php';
include 'header.php';
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];

    $productSql = "SELECT * FROM products WHERE name = '$name' AND id != '$id'";
    $result = $conn->query($productSql);
    if ($result->num_rows > 0) {
        echo "This name is already exist";
        ?>
            <br>
            <a href='edit_product.php?id=<?php echo $id ?>'>
                <button type="button" class="btn btn-warning">Edit Product</button>
            </a>
        <?php
        exit();
    }

    $sql = "UPDATE products SET name='$name', price='$price' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        header('Location: products.php');
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    $id = $_GET['id'];
    $type = $_GET['type'];
    $headerName = 'Edit';
    $readonly = '';
    if ($type == 1) {
        $headerName = 'View';
        $readonly = 'readonly';
    }
    $sql = "SELECT * FROM products WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No product found.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $headerName ?> Product</title>
</head>
<body>
    <div class="page_header">
        <h2><?php echo $headerName ?> Product</h2>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            Name: <input type="text" name="name" value="<?php echo $row['name']; ?>" required <?php echo $readonly ?>><br> <br>
            Price: <input type="number" step="0.01" name="price" value="<?php echo $row['price']; ?>" required <?php echo $readonly ?>><br> <br>
            <?php if ($type == 2) { ?>
                <input type="submit" value="Update Product">
            <?php } ?>
        </form>
    </div>
</body>
</html>