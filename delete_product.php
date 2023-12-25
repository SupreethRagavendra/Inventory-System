<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = sanitizeInput($_GET["id"]);

    if (!is_numeric($id) || $id <= 0) {
        // Invalid input, handle the error
        echo "Error: Invalid input";
        // You may also consider redirecting the user to an error page
        exit();
    }

    include('functions.php');
    deleteProduct($id);
}

// Function to sanitize input
function sanitizeInput($input) {
    return htmlspecialchars(trim($input));
}
?>
