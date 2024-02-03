<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: ../loginsignup/login.html");
    exit();
}
include('../db/Database.php');

if (isset($_POST['posto_pune'])) {
    $kompania = $_POST['kompania'];
    $qyteti = $_POST['Qyteti'];
    $orari = $_POST['orari'];
    $pozita = $_POST['pozita'];
    $about_us = $_POST['about_us'];
    $paga = $_POST['paga'];

    $user_id = $_SESSION['user_id'];

    try {
        $stmt = $conn->prepare("INSERT INTO employee (`Emri Kompanise`, `Qyteti`, `Orari`, `Pozita`, `Pershkrimi`, `salary`, `user_id`) VALUES (?, ?, ?, ?, ?, ?, ?)");

        $stmt->bindParam(1, $kompania);
        $stmt->bindParam(2, $qyteti);
        $stmt->bindParam(3, $orari);
        $stmt->bindParam(4, $pozita);
        $stmt->bindParam(5, $about_us);
        $stmt->bindParam(6, $paga);
        $stmt->bindParam(7, $user_id);

        $stmt->execute();

        // Redirect to Apliko.php after posting the job
        header('Location: ../Shpalljet/Apliko.php');
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="forma.css"/>
    <title>Job App</title>
</head>
<body>
    <div class="container">
        <div class="box">
            <div class="f_css">
                <h1>Shpallje pune</h1>
                <div class="fcontainer" id="forma">
                    <form method="post" action="">
                        <div class="form_design">  
                            <label for="kompania">Emri i kompanisë:</label>
                            <input id="kompania" name="kompania" placeholder="Shkruani emrin e kompanisë" required>
                        </div>
                        
                        <div class="form_design">
                            <label for="Qyteti">Qyteti:</label>
                            <input id="Qyteti" name="Qyteti" placeholder="Shkruani qytetin" required>
                        </div>

                        <div class="form_design">
                            <label for="orari">Orari:</label>
                            <select id="orari" name="orari" required>
                                <option value="full-time">Orarë i plotë</option>
                                <option value="part-time">Gjysmë orari</option>
                            </select>
                        </div>

                        <div class="form_design">
                            <label for="pozita">Pozita:</label>
                            <input id="pozita" name="pozita" placeholder="Shkruani poziten e punës" required>
                        </div>

                        <div class="form_design">
                            <label for="about_us">Përshkrimi i punës</label>
                            <textarea id="about_us" name="about_us" rows="5" cols="50" placeholder="Shkruaj diqka rreth kompanisë" required></textarea>
                        </div>

                        <div class="form_design">
                            <label for="paga">Paga:</label>
                            <span class="cmimi"><input type="number" id="paga" name="paga" placeholder="Shkruani pagën €" required>€</span> 
                        </div>

                        <div class="button_container">
                            <button type="submit" name="posto_pune">Posto!</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>