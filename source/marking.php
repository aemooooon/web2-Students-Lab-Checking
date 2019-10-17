<?php
include 'model/Database.php';
include 'model/Model.php';


$model=new Model();

// Get all lab
$labList=$model->displayAllLabBycp();
$dataLab=['posts_lab'=>$labList];

// Get all students
$studentList=$model->displayAllStudents();
$dataStudent=['posts_student'=>$studentList];

$labID;
$studentID;

if (isset($_POST['mark'])) {
    $labID=$_POST['labName'];
    $studentID=$_POST['studentName'];
    $tpwd=$_POST['tpwd'];

    if ($labID=='0') {
        $error="Please select Lab Name...";
        include 'error.html.php';
        exit;
    }
    if ($studentID=='0') {
        $error="Please select Student Name...";
        include 'error.html.php';
        exit;
    }
    if (empty($tpwd)) {
        $error="Please enter Password";
        include 'error.html.php';
        exit;
    }
    if ($tpwd!=$labID*5) {
        $error="Tutor Password wrong...";
        include 'error.html.php';
        exit;
    }

    $count=$model->checkIsMarked($labID, $studentID);
    if ($count>0) {
        $error="This lab has been marked!";
        include 'error.html.php';
        exit;
    }

    if (($count==0)&&($tpwd==$labID*5)) {
        include 'question1.form.html.php';
        exit;
    }
} elseif (isset($_POST['sendAnswer1'])) {
    $labID=$_POST['labID'];
    $studentID=$_POST['studentID'];
    $toolID=$_POST['toolID'];
    $xy=$_POST['score'];
    $x=strstr($xy, ',', true);
    $y=substr(strstr($xy, ','), 1);
    // Check whether exists of tool
    if ($model->checkIsSendTool($labID, $studentID, $toolID)==0) {
        $model->addToolRecord($labID, $studentID, $toolID, $x, $y);
    }
    include 'question2.form.html.php';
    exit;
} elseif (isset($_POST['skip1'])) {
    $labID=$_POST['labID'];
    $studentID=$_POST['studentID'];
    include 'question2.form.html.php';
    exit;
} elseif (isset($_POST['sendAnswer2'])) {
    $labID=$_POST['labID'];
    $studentID=$_POST['studentID'];
    $toolID=$_POST['toolID'];
    $xy=$_POST['score'];
    $x=strstr($xy, ',', true);
    $y=substr(strstr($xy, ','), 1);
    // Check whether exists of tool
    if ($model->checkIsSendTool($labID, $studentID, $toolID)==0) {
        $model->addToolRecord($labID, $studentID, $toolID, $x, $y);
    }
    include 'question3.form.html.php';
    exit;
} elseif (isset($_POST['skip2'])) {
    $labID=$_POST['labID'];
    $studentID=$_POST['studentID'];
    include 'question3.form.html.php';
    exit;
} elseif (isset($_POST['sendAnswer3'])) {
    $labID=$_POST['labID'];
    $studentID=$_POST['studentID'];
    $toolID=$_POST['toolID'];
    $xy=$_POST['score'];
    $x=strstr($xy, ',', true);
    $y=substr(strstr($xy, ','), 1);

    // Check this tool whether marked
    // Add new tool record
    if ($model->checkIsSendTool($labID, $studentID, $toolID)==0) {
        $model->addToolRecord($labID, $studentID, $toolID, $x, $y);
    }

    // Add completion of this lab
    if ($model->checkIsMarked($labID, $studentID)==0) {
        $model->addCompletion($studentID, $labID);
    }

    $success_message="Thank you!&nbsp;&nbsp;&nbsp;&nbsp;<a href='studentdashboard.php'>View detail</a>";
    include 'success.html.php';
    exit;
} elseif (isset($_POST['skip3'])) {
    $labID=$_POST['labID'];
    $studentID=$_POST['studentID'];
    // Add completion of this lab
    if ($model->checkIsMarked($labID, $studentID)==0) {
        $model->addCompletion($studentID, $labID);
    }
    $success_message="Thank you!&nbsp;&nbsp;&nbsp;&nbsp;<a href='studentdashboard.php'>View detail</a>";
    include 'success.html.php';
    exit;
} else {
    include 'marklogin.form.html.php';
    exit;
}
