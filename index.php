<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System</title>
    <link rel="stylesheet" href="design.css">
</head>
<body>
    <div class="container">
    <h1 class="main-heading">Inventory Management System</h1>
<br>
        <h2>Product List</h2>
        <?php include 'functions.php'; ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Category</th>
                <th>Description</th>
                <th>Date Added</th>
                <th>Last Updated</th>
                <th>Action</th>
            </tr>
            <?php displayProducts(); ?>
        </table>

        <br>
        <div class="options">
            <a href="add_product.php">Add New Product</a>
        </div>
    </div>
</body>
</html>
