<?php
include 'model/Database.php';
include 'model/Model.php';

$model=new Model();

$self = htmlentities($_SERVER['PHP_SELF']);
// Get all students
$studentList=$model->displayAllStudents();
$dataStudent=['posts_student'=>$studentList];

if (isset($_POST['login'])) {
    $userName=$_POST['username'];
    $password=$_POST['spwd'];
    // Staff login verify
    if ($model->checkStaffLogin($userName, $password)) {
        include 'staffmanagement.php';
    } else {
        $error="Password wrong...";
        include 'error.html.php';
        exit;
    }
} elseif (isset($_POST['reset'])) {
    $studentNumber=$_POST['studentName'];
    if ($studentNumber=='0') {
        $error="Please select Student Name...";
        include 'error.html.php';
        exit;
    }
    try {
        $model->resetStudentPwd($studentNumber);
        $success_message='Congratulations, the password of '.$studentNumber.' has been reset!';
        include 'success.html.php';
    } catch (PDOException $e) {
        $error='Reset student password failed';
        include 'error.html.php';
        exit();
    }
} else {
    include 'staff.form.html.php';
    exit;
}
