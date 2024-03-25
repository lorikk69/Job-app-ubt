<?php
session_start();

if ($_SESSION['admin_logged_in'] == true && isset($_GET['id'])) {
    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tc_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the user has associated records in the employee table
    $userId = $_GET['id'];
    $check_sql = "SELECT * FROM employee WHERE user_id = $userId";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        // Delete associated records in the employee table first
        $delete_employee_sql = "DELETE FROM employee WHERE user_id = $userId";
        if ($conn->query($delete_employee_sql) === FALSE) {
            echo "Error deleting associated employee records: " . $conn->error;
            exit;
        }
    }

    // Now delete the user
    $delete_user_sql = "DELETE FROM users WHERE id = $userId";
    if ($conn->query($delete_user_sql) === TRUE) {
        // Redirect back to the dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error deleting user: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Unauthorized access or user ID not specified";
}
?>
