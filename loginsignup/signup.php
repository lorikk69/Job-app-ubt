<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['email']) && isset($_POST['password'])) {
        $servername = "localhost";
        $username = "root";
        $password = ""; 
        $dbname = "tc_db";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $email = $conn->real_escape_string($_POST['email']);
        $password = $conn->real_escape_string($_POST['password']); // Escape the password input

        if (!preg_match("/^(?=.*[A-Z])(?=.*\d).{8,}$/", $password)) {
            echo "<script>alert('Fjalekalimi duhet te kete nje shkronje te vogel, nje shkronje te madhe, nje numer dhe duhet ti permbaje 8 apo me shume karaktere!');</script>";
            include("signup.html"); 
            exit;
        }

        $sql_check_email = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($sql_check_email);

        if ($result->num_rows > 0) {
            echo "<script>alert('Ky email eshte perdorur me pare, perdor nje tjeter!');</script>";
            include("signup.html"); 
        } else {
            $sql_insert_user = "INSERT INTO users (email, password) VALUES ('$email', '$password')"; // Insert the password without hashing

            if ($conn->query($sql_insert_user) === TRUE) {
                echo "<script>alert('Regjistrimi u krye me sukses.');</script>";
                echo '<script>window.location.href = "login.html";</script>'; 
            } else {
                echo "<script>alert('Error: " . $conn->error . "');</script>";
                include("signup.html"); 
            }
        }

        $conn->close();
    } else {
        echo "<script>alert('Format duhen te plotesohen!');</script>";
        include("signup.html"); 
    }
}
?>
