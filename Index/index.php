<?php
session_start();

if(!isset($_SESSION['logged in'])){
    header("../loginsignup/login.html");
}

include '../headerfooter/header.php';

$servername = "localhost";
$db = "tc_db";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
                echo '</li>';
            }
            echo '</ul>';
        }

        public function getJobData() {
            if ($this->conn === null) {
                return array();
            }
            try {
                $stmt = $this->conn->prepare("SELECT * FROM employee ORDER BY id DESC LIMIT 3");
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

    $jobListing = new JobListing($conn);

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}
?>

<div id="entry">

    <p id="entryt">TalentCraft</p>
    <p id="entryp">Në TalentCraft, ne shpërblejmë talentin dhe inkurajojmë zhvillimin personal dhe profesional. Krijimi i një mjedisi tërheqës dhe i mbështetur për punonjësit dhe punëdhënësit është në qendër të vlerave tona.</p>
</div>
<hr>
<div class="JobList_container">
    <?php $jobListing->displayJobs(); ?>
    <a href="../Shpalljet/Apliko.php" id="buttonish">Shiko më shumë</a>
</div>
<hr>

<?php
include '../headerfooter/footer.php';
?>
