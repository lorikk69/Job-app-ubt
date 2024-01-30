<?php
// Apliko.php

// Include the Database class
include('../db/Database.php');

class JobListing {
    private $conn;

    // Constructor to initialize the database connection
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Display the list of jobs
    public function displayJobs() {
        // Get job data from the database
        $storedJobs = $this->getJobData();

        // Display jobs in an unordered list
        echo '<ul id="jobList">';

        foreach ($storedJobs as $job) {
            echo '<li>';
            echo '<strong>Emri i kompanisë:</strong> ' . $job['Emri Kompanise'] . '<br>';
            echo '<strong>Qyteti:</strong> ' . $job['Qyteti'] . '<br>';
            echo '<strong>Orari:</strong> ' . $job['Orari'] . '<br>';
            echo '<strong>Pozita:</strong> ' . $job['Pozita'] . '<br>';
            echo '<strong>Përshkrimi i punës:</strong> ' . $job['Pershkrimi'] . '<br>';
            echo '<strong>Paga:</strong> ' . $job['salary'] . ' €<br>';

            // Button to apply for job
            echo '<button class="buttoni_forma" onclick="redirectForma(' . $job['id'] . ')">Apliko</button>';
            
            // Button to edit job (you can replace '#' with the actual edit page URL)
            echo '<a href="../api/editJob.php?job_id=' . $job['id'] . '"><button class="buttoni_forma">Edit</button></a>';
            
            // Button to delete job
            echo '<form method="post" action="../api/deleteJob.php">';
            echo '<input type="hidden" name="job_id" value="' . $job['id'] . '">';
            echo '<button type="submit" class="buttoni_forma">Delete</button>';
            echo '</form>';
            
            echo '<hr>';
            echo '</li>';
        }

        echo '</ul>';
    }

    // Get job data from the database
    public function getJobData() {
        if ($this->conn === null) {
            return array();
        }

        try {
            // Fetch job data
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
    <link rel="stylesheet" type="text/css" href="index.css"/>
    <link href='https://fonts.googleapis.com/css?family=Kanit' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="ftr.css"/>
    <script src="../Shpalljet/crud.js"></script>
</head>
<body>
    <nav>
        <div class="content">
            <div class="logo">
                <a href="/Index/index.html">TalentCraft</a>
            </div>
            <ul class="items">
                <li><a href="../Shpalljet/Shpallje.html">Kërko punë</a></li>
                <li><a href="../loginsignup/login.html">Shpall Punë</a></li>
                <li><a href="../About_us/About_us.html">About us</a></li>
                <li><a href="../loginsignup/login.html">Log In</a></li>
                <li><a href="../loginsignup/signup.html">Sign-Up</a></li>
            </ul>
        </div>
    </nav>

    <div class ="Shpalljet_container">
        <h2>Shpalljet Aktuale të Punës</h2>
    </div>

    <div class="JobList_container">
        <?php $jobListing->displayJobs(); ?>
    </div>

    <footer class="footer">
        <!-- Your footer content here -->
    </footer>
</body>
</html>
