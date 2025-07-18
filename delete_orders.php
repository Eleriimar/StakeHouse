<?php
include("connection/connect.php"); //connection to db
error_reporting(0);
session_start();

// Check if user is logged in
if(empty($_SESSION["user_id"])) {
    header('location:login.php');
    exit;
}

// Validate the order_del parameter
if(isset($_GET['order_del']) && !empty($_GET['order_del'])) {
    $order_id = mysqli_real_escape_string($db, $_GET['order_del']);
    
    // Verify that the order belongs to the current user (security check)
    $check_query = "SELECT * FROM users_orders WHERE o_id = '$order_id' AND u_id = '".$_SESSION["user_id"]."'";
    $check_result = mysqli_query($db, $check_query);
    
    if(mysqli_num_rows($check_result) > 0) {
        // Delete the order
        $delete_query = "DELETE FROM users_orders WHERE o_id = '$order_id' AND u_id = '".$_SESSION["user_id"]."'";
        if(mysqli_query($db, $delete_query)) {
            // Order deleted successfully
            header("location:your_orders.php?msg=deleted");
        } else {
            // Error deleting order
            header("location:your_orders.php?error=delete_failed");
        }
    } else {
        // Order doesn't exist or doesn't belong to user
        header("location:your_orders.php?error=invalid_order");
    }
} else {
    // Invalid request
    header("location:your_orders.php?error=invalid_request");
}

?>
