<?php
session_start();

unset($_SESSION['studentID']);
unset($_SESSION['password']);
session_destroy();
header("location: index.php");
?>
