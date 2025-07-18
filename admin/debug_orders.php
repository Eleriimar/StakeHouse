<?php
include("../connection/connect.php");
error_reporting(E_ALL);
session_start();

echo "<h2>Database Connection Test</h2>";

// Test database connection
if($db) {
    echo "<p style='color: green;'>✓ Database connected successfully</p>";
} else {
    echo "<p style='color: red;'>✗ Database connection failed: " . mysqli_connect_error() . "</p>";
    exit;
}

echo "<h3>Orders Table Content:</h3>";

// Check orders table
$query = "SELECT * FROM users_orders ORDER BY date DESC LIMIT 10";
$result = mysqli_query($db, $query);

if(!$result) {
    echo "<p style='color: red;'>Query failed: " . mysqli_error($db) . "</p>";
} else {
    $count = mysqli_num_rows($result);
    echo "<p>Total orders found: " . $count . "</p>";
    
    if($count > 0) {
        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr style='background: #f0f0f0;'>";
        echo "<th>Order ID</th><th>User ID</th><th>Title</th><th>Quantity</th><th>Price</th><th>Status</th><th>Date</th>";
        echo "</tr>";
        
        while($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['o_id'] . "</td>";
            echo "<td>" . $row['u_id'] . "</td>";
            echo "<td>" . $row['title'] . "</td>";
            echo "<td>" . $row['quantity'] . "</td>";
            echo "<td>" . $row['price'] . "</td>";
            echo "<td>" . $row['status'] . "</td>";
            echo "<td>" . $row['date'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}

echo "<h3>Join Query Test:</h3>";

// Test the join query used in all_orders.php
$sql="SELECT users.username, users.f_name, users.l_name, users.email, users.phone, users.address, users_orders.* FROM users INNER JOIN users_orders ON users.u_id=users_orders.u_id ORDER BY users_orders.date DESC LIMIT 5";
$query=mysqli_query($db,$sql);

if(!$query) {
    echo "<p style='color: red;'>Join query failed: " . mysqli_error($db) . "</p>";
} else {
    $count = mysqli_num_rows($query);
    echo "<p>Join query results: " . $count . " records</p>";
    
    if($count > 0) {
        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr style='background: #f0f0f0;'>";
        echo "<th>Username</th><th>Full Name</th><th>Title</th><th>Quantity</th><th>Price</th><th>Status</th><th>Date</th>";
        echo "</tr>";
        
        while($row = mysqli_fetch_array($query)) {
            echo "<tr>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['f_name'] . " " . $row['l_name'] . "</td>";
            echo "<td>" . $row['title'] . "</td>";
            echo "<td>" . $row['quantity'] . "</td>";
            echo "<td>" . $row['price'] . "</td>";
            echo "<td>" . $row['status'] . "</td>";
            echo "<td>" . $row['date'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}

echo "<h3>Users Table Check:</h3>";
$users_query = "SELECT COUNT(*) as user_count FROM users";
$users_result = mysqli_query($db, $users_query);
$users_row = mysqli_fetch_array($users_result);
echo "<p>Total users: " . $users_row['user_count'] . "</p>";

?>
