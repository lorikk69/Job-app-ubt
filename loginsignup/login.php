<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['loginemail']) && isset($_POST['loginpassword'])) {
        $servername = "localhost";
        $username = "root";
        $password = ""; 
        $dbname = "tc_db";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $email = $conn->real_escape_string($_POST['loginemail']);
        $password = $conn->real_escape_string($_POST['loginpassword']);

        $sql_check_credentials = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result = $conn->query($sql_check_credentials);

        if ($result->num_rows == 1) {
            echo "<script>alert('U kyçet me sukses.');</script>";
            echo '<script>window.location.href = "../Index/index.html";</script>';
        } else {
            echo "<script>alert('Fjalekalimi ose email jane gabim, provoni perseri.');</script>";
            include("login.html"); 
        }

        $conn->close();
    } else {
        echo "<script>alert('Format duhen te plotesohen!');</script>";
        include("login.html"); 
    }
}
?>
