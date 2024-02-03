<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['usernameadm']) && isset($_POST['passwordadm'])) {
        $servername = "localhost";
        $username = "root";
        $password = ""; 
        $dbname = "tc_db"; 

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $username = $conn->real_escape_string($_POST['usernameadm']);
        $password = $conn->real_escape_string($_POST['passwordadm']);

        $sql_check_credentials = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
        $result = $conn->query($sql_check_credentials);

        if ($result->num_rows == 1) {
            $_SESSION['admin_logged_in'] = true;
            echo "<script>alert('Admin logged in successfully.');</script>";

            header("Location: ../Shpalljet/Apliko.php");

            exit; 
        } else {
            echo "<script>alert('Incorrect username or password. Please try again.');</script>";

            include("admin.html"); 
        }

        $conn->close();
    } else {
        echo "<script>alert('Please fill out all the fields.');</script>";
        
        include("admin.html"); 
    }
}
?>
