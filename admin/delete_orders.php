<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

// Add basic admin authentication check (you should implement proper admin authentication)
// For now, we'll just validate the order_del parameter

if(isset($_GET['order_del']) && !empty($_GET['order_del'])) {
    $order_id = mysqli_real_escape_string($db, $_GET['order_del']);
    
    // Check if order exists before deleting
    $check_query = "SELECT * FROM users_orders WHERE o_id = '$order_id'";
    $check_result = mysqli_query($db, $check_query);
    
    if(mysqli_num_rows($check_result) > 0) {
        // Delete the order
        $delete_query = "DELETE FROM users_orders WHERE o_id = '$order_id'";
        if(mysqli_query($db, $delete_query)) {
            // Order deleted successfully
            header("location:all_orders.php?msg=deleted");
        } else {
            // Error deleting order
            header("location:all_orders.php?error=delete_failed");
        }
    } else {
        // Order doesn't exist
        header("location:all_orders.php?error=order_not_found");
    }
} else {
    // Invalid request
    header("location:all_orders.php?error=invalid_request");
}

?>
