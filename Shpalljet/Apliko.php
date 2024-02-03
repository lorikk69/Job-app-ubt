<?php
session_start();

include('../db/Database.php');

class JobListing {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function displayJobs() {
        $storedJobs = $this->getJobData();

        echo '<ul id="jobList">';

        foreach ($storedJobs as $job) {
            echo '<li>';
            echo '<strong>Emri i kompanisë:</strong> ' . $job['Emri Kompanise'] . '<br>';
            echo '<strong>Qyteti:</strong> ' . $job['Qyteti'] . '<br>';
            echo '<strong>Orari:</strong> ' . $job['Orari'] . '<br>';
            echo '<strong>Pozita:</strong> ' . $job['Pozita'] . '<br>';
            echo '<strong>Përshkrimi i punës:</strong> ' . $job['Pershkrimi'] . '<br>';
            echo '<strong>Paga:</strong> ' . $job['salary'] . ' €<br>';

            if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in']) {
                // Display delete button only if admin is logged in
                echo '<form method="post" action="../api/deleteJob.php">';
                echo '<input type="hidden" name="job_id" value="' . $job['id'] . '">';
                echo '<button type="submit" class="buttoni_forma">Delete</button>';
                echo '</form>';
            } else {
                // Display "Apliko" button for regular users
                echo '<a href="../Forma/forma.php?job_id=' . $job['id'] . '"><button class="buttoni_forma">Apliko</button></a>';
            }

            echo '<hr>';
            echo '</li>';
        }

        echo '</ul>';
    }

    // Get job data from the database
    public function getJobData() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM employee");

            if (!$stmt) {
                print_r($this->conn->errorInfo());
                return array();
            }

            $result = $stmt->execute();

            if (!$result) {
                print_r($stmt->errorInfo());
                return array();
            }

            $jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $jobs;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return array();
        }
    }
}

// Create a new PDO connection
$servername = "localhost";
$db = "tc_db";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Usage example:
    $jobListing = new JobListing($conn);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shpalljet Aktuale të Punës</title>
    <link rel="stylesheet" type="text/css" href="shpalljet.css"/>
    <link href='https://fonts.googleapis.com/css?family=Kanit' rel='stylesheet'>
    <script>
        function redirectForma(jobId) {
            // Redirect logic for "Apliko" button
            window.location.href = "apliko.php?job_id=" + jobId;
        }
    </script>
</head>
<body>
   <?php 
    include '../headerfooter/header.php';
   ?>

    <div class ="Shpalljet_container">
        <h2>Shpalljet Aktuale të Punës</h2>
    </div>

    <div class="JobList_container">
        <?php $jobListing->displayJobs(); ?>
    </div>

    <?php 
    include '../headerfooter/footer.php';
    ?>
</body>
</html>
