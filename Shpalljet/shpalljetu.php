<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header("Location: ../loginsignup/login.html");
    exit(); 
}

include('../db/Database.php');

class JobListing {
    private $conn;
    private $userId;

    public function __construct($conn, $userId) {
        $this->conn = $conn;
        $this->userId = $userId;
    }

    public function displayJobs() {
        $storedJobs = $this->getJobData($this->userId);

        echo '<div class="Shpalljet_container">';
        echo '<h2>Shpalljet Tuaja të Punës</h2>';
        echo '</div>';

        echo '<div class="JobList_container">';
        if (empty($storedJobs)) {
            echo '<p>No job listings found.</p>';
        } else {
            echo '<ul id="jobList">';
            foreach ($storedJobs as $job) {
                echo '<li>';
                echo '<strong>Emri i kompanisë:</strong> ' . $job['Emri Kompanise'] . '<br>';
                echo '<strong>Qyteti:</strong> ' . $job['Qyteti'] . '<br>';
                echo '<strong>Orari:</strong> ' . $job['Orari'] . '<br>';
                echo '<strong>Pozita:</strong> ' . $job['Pozita'] . '<br>';
                echo '<strong>Përshkrimi i punës:</strong> ' . $job['Pershkrimi'] . '<br>';
                echo '<strong>Paga:</strong> ' . $job['salary'] . ' €<br>';

                echo '<a href="../api/editJob.php?job_id=' . $job['id'] . '"><button class="buttoni_forma">Edit</button></a>';
                
                echo '<form method="post" action="../api/deleteJob.php">';
                echo '<input type="hidden" name="job_id" value="' . $job['id'] . '">';
                echo '<button type="submit" class="buttoni_forma">Delete</button>';
                echo '</form>';

                echo '</li>';
            }
            echo '</ul>';
        }
        echo '</div>';
    }

    public function getJobData($userId) {
        if ($this->conn === null) {
            return array();
        }

        try {
            $stmt = $this->conn->prepare("SELECT * FROM employee WHERE user_id = :userId");
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return array();
        }
    }
}

$servername = "localhost";
$db = "tc_db";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    $jobListing = new JobListing($conn, $userId);
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
    <title>Shpalljet Tuaja të Punës</title>
    <link rel="stylesheet" type="text/css" href="shpalljet.css"/>
    <link href='https://fonts.googleapis.com/css?family=Kanit' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="ftr.css"/>
</head>
<body>
   <?php include '../headerfooter/header.php'; ?>

    <?php $jobListing->displayJobs(); ?>

    <?php include '../headerfooter/footer.php'; ?>
</body>
</html>
