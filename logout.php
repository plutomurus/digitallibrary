<?php
session_start();

if(!isset($_SESSION['login'])){
    header("location: index.php");
}

// Logout
$_SESSION = [];
session_unset();
session_destroy();

header("location: index.php?logout");
