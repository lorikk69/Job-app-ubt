<?php

class Job {
    private $id;
    private $companyName;
    private $city;
    private $schedule;
    private $position;
    private $description;
    private $salary;

    public function __construct($id, $companyName, $city, $schedule, $position, $description, $salary) {
        $this->id = $id;
        $this->companyName = $companyName;
        $this->city = $city;
        $this->schedule = $schedule;
        $this->position = $position;
        $this->description = $description;
        $this->salary = $salary;
    }

    public function getId() {
        return $this->id;
    }

    public function getCompanyName() {
        return $this->companyName;
    }

    public function getCity() {
        return $this->city;
    }

    public function getSchedule() {
        return $this->schedule;
    }

    public function getPosition() {
        return $this->position;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getSalary() {
        return $this->salary;
    }
}

class JobList {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getJobs() {
        $jobs = [];

        try {
            $stmt = $this->conn->query("SELECT * FROM employee");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $job = new Job(
                    $row['id'],
                    $row['Emri Kompanise'],
                    $row['Qyteti'],
                    $row['Orari'],
                    $row['Pozita'],
                    $row['Pershkrimi'],
                    $row['salary']
                );
                $jobs[] = $job;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        return $jobs;
    }
}

$servername = "127.0.0.1";
$dbname = "tc_db";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$jobList = new JobList($conn);

?>
