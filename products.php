<?php
include 'config.php';
include 'header.php';

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Listing</title>
    <script>
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this product?")) {
                document.getElementById('deleteForm' + id).submit();
            }
        }
    </script>
</head>
<body>
    <h2 class="page_header">Products</h2>
    <div class="container">
        <a href="add_product.php">
            <button type="button" class="btn btn-success">Add Products</button>
        </a>
        <?php if ($result->num_rows > 0) { ?>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row["name"] ?></td>
                            <td><?php echo $row["price"] ?></td>
                            <td>
                                <a href='edit_product.php?id=<?php echo $row["id"] ?>&type=1'>
                                    <button type="button" class="btn btn-primary">View</button>
                                </a>
                                <a href='edit_product.php?id=<?php echo $row["id"] ?>&type=2'>
                                    <button type="button" class="btn btn-warning">Edit</button>
                                </a>
                                <form id='deleteForm<?php echo $row["id"] ?>' method='post' action='delete_product.php' style='display:inline;'>
                                    <input type='hidden' name='id' value='<?php echo $row["id"] ?>'>
                                    <a href='#' onclick='confirmDelete(<?php echo $row["id"] ?>)'>
                                        <button type="button" class="btn btn-danger">Delete</button>
                                    </a>
                                </form>

                            </td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
        <?php
            } else {
                echo "<br><br>No products available.";
            }
        ?>
    </div>
</body>
</html>