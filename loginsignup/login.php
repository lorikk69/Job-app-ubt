<?php
session_start();

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

        $sql_check_user_credentials = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result = $conn->query($sql_check_user_credentials);

        if ($result && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $row['id'];
            header("Location: ../Index/index.php");
            exit;
        }

        $username = $conn->real_escape_string($_POST['loginemail']);
        $password = $conn->real_escape_string($_POST['loginpassword']);

        $sql_check_admin_credentials = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
        $admin_result = $conn->query($sql_check_admin_credentials);

        if ($admin_result && $admin_result->num_rows == 1) {
            $_SESSION['admin_logged_in'] = true;
            header("Location: ../Shpalljet/Apliko.php");
            exit;
        }

        echo "<script>alert('Incorrect username or password. Please try again.');</script>";
        $conn->close();
    } else {
        echo "<script>alert('Please fill out all the fields.');</script>";
    }
}

include("login.html");
?>
