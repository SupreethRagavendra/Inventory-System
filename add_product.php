<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="design.css">
</head>
<body>
    <div class="container">
        <h2>Add New Product</h2>
        <?php include 'functions.php'; ?>
        <form action="functions.php" method="post" onsubmit="return validateForm()">
            <label for="product_name">Product Name:</label>
            <input type="text" name="product_name" pattern="[A-Za-z\s]+" title="Only letters and spaces are allowed" required><br>

            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" required><br>

            <label for="price">Price:</label>
            <input type="number" name="price" required><br>

            <label for="category">Category:</label>
            <input type="text" name="category" pattern="[A-Za-z\s]+" title="Only letters and spaces are allowed" required><br>

            <label for="description">Description:</label>
            <textarea name="description" pattern="[A-Za-z\s]+" title="Only letters and spaces are allowed" required></textarea><br>

            <input type="submit" name="add_product" value="Add Product">
        </form>
        <div class="options">
            <a href="index.php">Back to Product List</a>
        </div>
    </div>

    <script>
        function validateForm() {
            var productName = document.forms["addProductForm"]["product_name"].value;
            var quantity = document.forms["addProductForm"]["quantity"].value;
            var price = document.forms["addProductForm"]["price"].value;
            var category = document.forms["addProductForm"]["category"].value;
            var description = document.forms["addProductForm"]["description"].value;

            if (productName === "" || quantity === "" || price === "" || category === "" || description === "") {
                alert("All fields must be filled out");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
