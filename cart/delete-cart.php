<?php
session_start();
require_once '../helper/connection.php';

if (isset($_GET['id'])) {
    $cartId = $_GET['id'];

    $query = "DELETE FROM cart WHERE id = ?";

    if ($stmt = mysqli_prepare($connection, $query)) {
        mysqli_stmt_bind_param($stmt, "s", $cartId);
        
        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            header("Location: cart.php");
            exit();
        } else {
            echo "Error: Could not execute the delete statement.";
        }
        
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: Could not prepare the delete statement.";
    }
} else {
    header("Location: cart.php");
    exit();
}

// Close the database connection
mysqli_close($connection);
?>
