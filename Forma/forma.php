<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Form is submitted
    $emri = $_POST['emri'];
    $mbiemri = $_POST['mbiemri'];
    $email = $_POST['email'];
    $qyteti = $_POST['qyteti'];
    $viti_lindjes = $_POST['viti_lindjes'];

    // Create a new PDO connection to the 'aplikuesit' database
    $servername = "localhost"; 
    $db = "tc_db"; 
    $username = "root";
    $password = "";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO aplikuesit (emri, mbiemri, email, qyteti, viti_lindjes) VALUES (?, ?, ?, ?, ?)");

        // Bind parameters
        $stmt->bindParam(1, $emri);
        $stmt->bindParam(2, $mbiemri);
        $stmt->bindParam(3, $email);
        $stmt->bindParam(4, $qyteti);
        $stmt->bindParam(5, $viti_lindjes);

        // Execute the statement
        $stmt->execute();

        // Redirect to Shpalljet/Apliko.php with job_id parameter
        $jobId = isset($_GET['job_id']) ? $_GET['job_id'] : '';
        header('Location: ../Shpalljet/Apliko.php?job_id=' . $jobId);
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
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
                <h1>Apliko për punë</h1>
                <div class="fcontainer" id="forma">
                    <form method="post" action="">
                        <div class="form_design">  
                            <label for="emri">Emri:</label>
                            <input id="emri" name="emri" placeholder="Shkruani emrin" required>
                        </div>
                        
                        <div class="form_design">
                            <label for="mbiemri">Mbiemri:</label>
                            <input id="mbiemri" name="mbiemri" placeholder="Shkruani mbiemrin" required>
                        </div>

                        <div class="form_design">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" placeholder="Shkruani email-in" required>
                        </div>

                        <div class="form_design">
                            <label for="qyteti">Qyteti</label>
                            <input id="qyteti" name="qyteti" placeholder="Shkruani qytetin" required>
                        </div>

                        <div class="form_design">
                            <label for="viti_lindjes">Viti i Lindjes</label>
                            <input type="date" id="viti_lindjes" name="viti_lindjes" required>
                        </div>

                        <div class="button_container">  
                            <button type="submit">Apliko!</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>
