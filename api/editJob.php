<?php

$kompania = '';
$qyteti = '';
$orari = '';
$pozita = '';
$about_us = '';
$paga = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kompania = $_POST['kompania'];
    $qyteti = $_POST['Qyteti'];
    $orari = $_POST['orari'];
    $pozita = $_POST['pozita'];
    $about_us = $_POST['about_us'];
    $paga = $_POST['paga'];

    include('../db/Database.php');

    try {
        $servername = "localhost";
        $db = "tc_db";
        $username = "root";
        $password = "";

        $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("UPDATE employee SET `Emri Kompanise` = ?, `Qyteti` = ?, `Orari` = ?, `Pozita` = ?, `Pershkrimi` = ?, `salary` = ? WHERE id = ?");
        $stmt->execute([$kompania, $qyteti, $orari, $pozita, $about_us, $paga, $_GET['job_id']]);

        header('Location: ../Shpalljet/Apliko.php');
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    if (isset($_GET['job_id'])) {
        $job_id = $_GET['job_id'];

        include('../db/Database.php');

        try {
          
            $servername = "localhost";
            $db = "tc_db";
            $username = "root";
            $password = "";

            $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("SELECT * FROM employee WHERE id = ?");
            $stmt->execute([$job_id]);
            $job = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($job) {
                $kompania = $job['Emri Kompanise'];
                $qyteti = $job['Qyteti'];
                $orari = $job['Orari'];
                $pozita = $job['Pozita'];
                $about_us = $job['Pershkrimi'];
                $paga = $job['salary'];
            } else {
                echo "Job not found.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        header("Location: ../Shpalljet/Apliko.php");
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job App</title>
    <link rel="stylesheet" type="text/css" href="editjob.css"/>
</head>
<body>

<div class="container">
    <div class="box">
        <div class="f_css">
            <h1>Ndrysho punën</h1>
            <div class="fcontainer" id="forma">
                <form method="post" action="">
                    <div class="form_design">  
                        <label for="kompania">Emri i kompanisë:</label>
                        <input id="kompania" name="kompania" placeholder="Shkruani emrin e kompanisë" value="<?php echo $kompania; ?>" required>
                    </div>
                    
                    <div class="form_design">
                        <label for="Qyteti">Qyteti:</label>
                        <input id="Qyteti" name="Qyteti" placeholder="Shkruani qytetin" value="<?php echo $qyteti; ?>" required>
                    </div>

                    <div class="form_design">
                        <label for="orari">Orari:</label>
                        <select id="orari" name="orari" required>
                            <option value="full-time" <?php echo ($orari == 'full-time') ? 'selected' : ''; ?>>Orarë i plotë</option>
                            <option value="part-time" <?php echo ($orari == 'part-time') ? 'selected' : ''; ?>>Gjysmë orari</option>
                        </select>
                    </div>

                    <div class="form_design">
                        <label for="pozita">Pozita:</label>
                        <input id="pozita" name="pozita" placeholder="Shkruani poziten e punës" value="<?php echo $pozita; ?>" required>
                    </div>

                    <div class="form_design">
                        <label for="about_us">Përshkrimi i punës</label>
                        <textarea id="about_us" name="about_us" rows="5" cols="50" placeholder="Shkruaj diqka rreth kompanisë" required><?php echo $about_us; ?></textarea>
                    </div>

                    <div class="form_design">
                        <label for="paga">Paga:</label>
                        <span class="cmimi"><input type="number" id="paga" name="paga" placeholder="Shkruani pagën €" value="<?php echo $paga; ?>" required>€</span> 
                    </div>

                    <div class="button_container">
                        <button type="submit" name="update_job">Update Job</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    
</body>
</html>
