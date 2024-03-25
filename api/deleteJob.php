<?php

if (isset($_POST['job_id'])) {
    
    include('../db/Database.php');

    try {
        $servername = "localhost";
        $db = "tc_db";
        $username = "root";
        $password = "";

        $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("DELETE FROM employee WHERE id = ?");
        $stmt->execute([$_POST['job_id']]);

        header("Location: ../Shpalljet/Apliko.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    header("Location: ../Shpalljet/Apliko.php");
    exit();
}
?>
