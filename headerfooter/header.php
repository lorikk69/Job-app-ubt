<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>asd</title>
    <link rel="stylesheet" type="text/css" href="index.css" />
    <link href='https://fonts.googleapis.com/css?family=Kanit' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="../headerfooter/footeri.css"/>
    <link rel="stylesheet" type="text/css" href="../headerfooter/hdr.css" />
</head>

<body>
    <nav>
        <div class="content">
            <div class="logo">
                <a href="/tcweb/Index/index.php">TalentCraft</a>
            </div>
            <ul class="items">
                <li><a href="/tcweb/Shpalljet/Apliko.php">Kërko punë</a></li>
                <?php
                if (isset($_SESSION['logged_in'])) {
                    echo '<li><a href="/tcweb/Forma/posto_pune.php">Shpall Punë</a></li>';
                    echo '<li class="dropdown">
                            <a href="#" class="dropbtn">Account</a>
                            <div class="dropdown-content">
                                <a href="/tcweb/Shpalljet/shpalljetu.php">Punët e listuara</a>
                                <a href="/tcweb/loginsignup/logout.php" onclick="return confirmLogout();">Sign Out</a>
                            </div>
                          </li>';
                } elseif (isset($_SESSION['admin_logged_in'])) {

                    echo '<li class="dropdown">
                            <a href="#" class="dropbtn">Account</a>
                            <div class="dropdown-content">
                                <a href="/tcweb/loginsignup/logout.php" onclick="return confirmLogout();">Sign Out</a>
                            </div>
                          </li>';
                } else {

                    echo '<li><a href="/tcweb/Forma/posto_pune.php">Shpall Punë</a></li>';
                    echo '<li><a href="/tcweb/loginsignup/login.html">Log In</a></li>';
                    echo '<li><a href="/tcweb/loginsignup/signup.html">Sign-Up</a></li>';
                }
                ?>
                <li><a href="/tcweb/exp/exp.php">Partneriteti</a></li>
                <li><a href="/tcweb/About_us/About_us.php">About us</a></li>
                <li><a href="/tcweb/Contact/Contact.php">Contact us</a></li>
            </ul>
        </div>
    </nav>

    <script>
        function confirmLogout() {
            return confirm('Are you sure you want to sign out?');
        }
    </script>
</body>

</html>
