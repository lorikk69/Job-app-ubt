<?php 
session_start();

if(!isset($_SESSION['logged in'])){
    header("../loginsignup/login.html");
}

include '../headerfooter/header.php';
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="exp.css">
</head>
<body>
    <p id="titulli">Eksperienca me partnerët tanë</p>


    <div class="gallery"> 
        <img src="terren2.jpg" alt="FotoneTerren"> 
        <img src="medicalstaff.jpg" alt="FotoNeSpital">
        <img src="remote.jpg" alt="DukePunuarRemote">
        <img src="upsc.jpg" alt="NeSektorinEMarketeve">

    </div>
<div class="ofrojne">
    <p> Çfarë ofrojnë partnerët tanë?</p>
</div>

    <div class="teksti">
    <p>Partnerët tanë punëdhënës janë motori i inovacionit dhe zhvillimit të vendit tonë! Ne jemi në kërkim të talenteve të shkëlqyera që janë gati të bëjnë ndryshime të mëdha në botën e punës.</p>

<p>Duke ofruar mundësi tërheqëse në sektorë të ndryshëm si puna në distancë, shërbimet shëndetësore, inxhinieri, tregti dhe industri, ne po ndërtojmë një ekip të fuqishëm të profesionistëve të përkushtuar dhe të kualifikuar.</p>

<p>Për ne, puna është më shumë se një detyrë, është një pasion dhe një udhëtim drejt suksesit të përbashkët.</p>

<p>Bashkohuni me ne për të zhvilluar karrierën tuaj në një mjedis stimulues, ku mundësitë janë të pakufizuara dhe suksesi është i sigurt!</p>

    </div>
    <div class="buttoni">
    <button onclick="redirectToApliko()">Kërko punën e duhur!</button>

<script>
  function redirectToApliko() {
    window.location.href = '../Shpalljet/Apliko.php';
  }

</script>
    </div>
   
</body>
</html>

<?php 
include '../headerfooter/footer.php';
?>
