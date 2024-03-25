<?php
session_start();

class JobEditor {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function updateJob($job_id, $kompania, $qyteti, $orari, $pozita, $about_us, $paga) {
        try {
            $stmt = $this->conn->prepare("UPDATE employee SET `Emri Kompanise` = ?, `Qyteti` = ?, `Orari` = ?, `Pozita` = ?, `Pershkrimi` = ?, `salary` = ? WHERE id = ?");
            $stmt->execute([$kompania, $qyteti, $orari, $pozita, $about_us, $paga, $job_id]);
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}

class Database {
    private $conn;

    public function __construct($servername, $db, $username, $password) {
        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit();
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit();
}

$servername = "localhost";
$db = "tc_db";
$username = "root";
$password = "";

try {
    $database = new Database($servername, $db, $username, $password);
    $conn = $database->getConnection();

    $jobEditor = new JobEditor($conn);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['job_id'], $_POST['kompania'], $_POST['Qyteti'], $_POST['orari'], $_POST['pozita'], $_POST['about_us'], $_POST['paga'])) {
            $job_id = $_POST['job_id'];
            $kompania = $_POST['kompania'];
            $qyteti = $_POST['Qyteti'];
            $orari = $_POST['orari'];
            $pozita = $_POST['pozita'];
            $about_us = $_POST['about_us'];
            $paga = $_POST['paga'];

            if ($jobEditor->updateJob($job_id, $kompania, $qyteti, $orari, $pozita, $about_us, $paga)) {
                header("Location: dashboard.php");
                exit();
            } else {
                echo "Error updating job.";
            }
        } else {
            echo "Missing required parameters.";
        }
    } else {
        header("Location: dashboard.php");
        exit();
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}
?>
