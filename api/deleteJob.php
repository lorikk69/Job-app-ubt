<?php
// Check if job_id is provided in the POST request
if (isset($_POST['job_id'])) {
    // Include necessary files
    include('../db/Database.php');

    try {
        // Create a new PDO connection
        $servername = "localhost";
        $db = "tc_db";
        $username = "root";
        $password = "";

        $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare and execute the SQL statement to delete the job
        $stmt = $conn->prepare("DELETE FROM employee WHERE id = ?");
        $stmt->execute([$_POST['job_id']]);

        // Redirect to the front page after successful deletion
        header("Location: ../Shpalljet/Apliko.php");
        exit();
    } catch (PDOException $e) {
        // Display error message
        echo "Error: " . $e->getMessage();
    }
} else {
    // Redirect if job_id is not provided
    header("Location: ../Shpalljet/Apliko.php");
    exit();
}
?>
