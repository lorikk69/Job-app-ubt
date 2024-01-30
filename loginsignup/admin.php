<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['usernameadm']) && isset($_POST['passwordadm'])) {
        $servername = "localhost";
        $username = "root";
        $password = ""; // Enter your MySQL password here
        $dbname = "tc_db"; // Enter your database name here

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $username = $conn->real_escape_string($_POST['usernameadm']);
        $password = $conn->real_escape_string($_POST['passwordadm']);

        $sql_check_credentials = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
        $result = $conn->query($sql_check_credentials);

        if ($result->num_rows == 1) {
            echo "<script>alert('Admin logged in successfully.');</script>";
            // Redirect to index.html
            echo '<script>window.location.href = "../Index/index.html";</script>';
            exit; // Add this line to stop further execution
        } else {
            echo "<script>alert('Incorrect username or password. Please try again.');</script>";
            // Include the admin.html file again for another login attempt
            include("admin.html"); 
        }

        $conn->close();
    } else {
        echo "<script>alert('Please fill out all the fields.');</script>";
        // Include the admin.html file again for another login attempt
        include("admin.html"); 
    }
}
?>
