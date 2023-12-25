<?php
include 'functions.php';

// Initialize product to avoid undefined variable error
$product = null;

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    // Attempt to get product details by ID
    $product = getProductById($_GET['id']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="design.css">
</head>

<body>
    <div class="container">
        <h2>Edit Product</h2>

        <?php if ($product): ?>
            <form action="functions.php" method="post" onsubmit="return validateForm()">
                <input type="hidden" name="id" value="<?php echo $product['ID']; ?>">
                
                <label for="product_name">Product Name:</label>
                <input type="text" name="product_name" value="<?php echo $product['product_name']; ?>" pattern="[A-Za-z\s]+" title="Only letters and spaces are allowed" required><br>

                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" value="<?php echo $product['quantity']; ?>" required><br>

                <label for="price">Price:</label>
                <input type="number" name="price" value="<?php echo $product['price']; ?>" required><br>

                <label for="category">Category:</label>
                <input type="text" name="category" value="<?php echo $product['category']; ?>" pattern="[A-Za-z\s]+" title="Only letters and spaces are allowed" required><br>

                <label for="description">Description:</label>
                <textarea name="description" pattern="[A-Za-z\s]+" title="Only letters and spaces are allowed" required><?php echo $product['description']; ?></textarea><br>

                <input type="submit" name="edit_product" value="Edit Product">
            </form>
        <?php else: ?>
            <p>Product not found</p>
        <?php endif; ?>

        <div class="options">
            <a href="index.php">Back to Product List</a>
        </div>

        <script>
            function validateForm() {
                var productName = document.forms["editProductForm"]["product_name"].value;
                var quantity = document.forms["editProductForm"]["quantity"].value;
                var price = document.forms["editProductForm"]["price"].value;
                var category = document.forms["editProductForm"]["category"].value;
                var description = document.forms["editProductForm"]["description"].value;

                if (productName === "" || quantity === "" || price === "" || category === "" || description === "") {
                    alert("All fields must be filled out");
                    return false;
                }

                return true;
            }
        </script>
    </div>
</body>

</html>
