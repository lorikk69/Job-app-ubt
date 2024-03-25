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

    // Get the employee ID
    $employeeId = $_GET['id'];

    // Delete the employee record
    $delete_employee_sql = "DELETE FROM employee WHERE id = $employeeId";

    if ($conn->query($delete_employee_sql) === TRUE) {
        // Redirect back to the dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error deleting employee: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Unauthorized access or employee ID not specified";
}
?>
