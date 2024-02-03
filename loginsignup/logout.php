<?php
session_start();

$_SESSION = array();

session_destroy();

header("Location: ../Index/index.php");
exit;
?>