<?php
session_start();
require_once 'model/Database.php';
require_once 'model/Model.php';

$model=new Model();

if (!isset($_POST['username'])||!isset($_POST['spwd'])) {
    include 'staff.form.html.php';
    exit;
}

if (isset($_POST['username'])) {
    $username=strip_tags($_POST['username']);
} elseif (isset($_SESSION['username'])) {
    $username=$_SESSION['username'];
}
    
if (isset($_POST['spwd'])) {
    $password=strip_tags($_POST['spwd']);
} elseif (isset($_SESSION['password'])) {
    $password=$_SESSION['password'];
}


if (isset($_POST['login'])) {
    // $username=$_POST['username'];
    // $password=$_POST['spwd'];

    // Staff login verify
    $loginStaff=$model->checkStaffLogin($username, $password);

    if ($loginStaff) {
        $_SESSION['username'] = $username;
        $_SESSION['password']=$password;
    } else {
        $error="UserName or Password wrong...";
        include 'error.html.php';
        exit;
    }
}
