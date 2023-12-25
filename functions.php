<?php

function connectDB() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "inventory_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function displayProducts() {
    $conn = connectDB();
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['ID'] . "</td>";
                echo "<td>" . $row['product_name'] . "</td>";
                echo "<td>" . $row['quantity'] . "</td>";
                echo "<td>" . $row['price'] . "</td>";
                echo "<td>" . $row['category'] . "</td>";
                echo "<td>" . $row['description'] . "</td>";
                echo "<td>" . $row['date_added'] . "</td>";
                echo "<td>" . $row['last_updated'] . "</td>";
                echo "<td><a href='edit_product.php?id=" . $row['ID'] . "'>Edit</a> | <a href='functions.php?id=" . $row['ID'] . "&action=delete_product'>Delete</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No products found</td></tr>";
        }
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}

function addProduct($product_name, $quantity, $price, $category, $description) {
    $conn = connectDB();
    $date_added = date("Y-m-d H:i:s");
    $last_updated = $date_added;

    // Validate input
    if (empty($product_name) || !is_numeric($quantity) || !is_numeric($price) || empty($category) || empty($description)) {
        echo "Error: Invalid input";
        return;
    }

    $sql = "INSERT INTO products (product_name, quantity, price, category, description, date_added, last_updated)
            VALUES ('$product_name', $quantity, $price, '$category', '$description', '$date_added', '$last_updated')";

    if ($conn->query($sql) === TRUE) {
        echo "Product added successfully";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}

function getProductById($id) {
    $conn = connectDB();
    $sql = "SELECT * FROM products WHERE ID=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row;
    } else {
        return null;
    }

    $conn->close();
}

function editProduct($id, $product_name, $quantity, $price, $category, $description) {
    $conn = connectDB();
    $last_updated = date("Y-m-d H:i:s");

    // Validate input
    if (!is_numeric($id) || empty($product_name) || !is_numeric($quantity) || !is_numeric($price) || empty($category) || empty($description)) {
        echo "Error: Invalid input";
        return;
    }

    $sql = "UPDATE products SET 
            product_name='$product_name', 
            quantity=$quantity, 
            price=$price, 
            category='$category', 
            description='$description', 
            last_updated='$last_updated' 
            WHERE ID=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Product updated successfully";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}

function deleteProduct($id) {
    $conn = connectDB();

    // Validate input
    if (!is_numeric($id)) {
        echo "Error: Invalid input";
        return;
    }

    $sql = "DELETE FROM products WHERE ID=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Product deleted successfully";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}

if (isset($_POST['add_product'])) {
    $product_name = $_POST['product_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    addProduct($product_name, $quantity, $price, $category, $description);
}

if (isset($_POST['edit_product'])) {
    $id = $_POST['id'];
    $product_name = $_POST['product_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    editProduct($id, $product_name, $quantity, $price, $category, $description);
}

if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'delete_product') {
    $id = $_GET['id'];
    deleteProduct($id);
}

?>
