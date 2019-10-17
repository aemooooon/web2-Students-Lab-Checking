<?php
session_start();

include 'model/Database.php';
include 'model/Model.php';

$model=new Model();

// Get all lab
$labList=$model->displayAllLab();
$dataLab=['posts_lab'=>$labList];

// Get all Checkpoint lab
$labListCP=$model->displayAllLabBycp();
$dataLabCP=['posts_lab_CP'=>$labListCP];

// Get all students
$studentList=$model->displayAllStudents();
$dataStudent=['posts_student'=>$studentList];

$numberOfCPCount; // The number of Checkpoints
$numberOfCPCountByStudent; // The number of Checkpoints by Student completed

$numberOfTodo=0;
$numberOfDue=0;

$studentID;

if (isset($_POST['studentName'])) {
    $studentID=strip_tags($_POST['studentName']);
} elseif (isset($_SESSION['studentID'])) {
    $studentID=$_SESSION['studentID'];
}

if (isset($_POST['spwd'])) {
    $password=strip_tags($_POST['spwd']);
} elseif (isset($_SESSION['password'])) {
    $password=$_SESSION['password'];
}

if (isset($_POST['login'])) {
    $studentID=$_POST['studentName'];
    $_SESSION['studentID'] = $studentID;
    $password=$_POST['spwd'];
    
    $singleStudent=$model->displayStudentByID($studentID);
    $dataSingleStudent=['post_student'=>$singleStudent];

    $markedLabs=$model->displayCompletionByStudentID($dataSingleStudent['post_student']->studentID);
    $dataMarkedLabs=['posts_markedLabs'=>$markedLabs];
    
    // Get all labs which is checkpoint, and how many completed
    $numberOfCPCount=$model->getCheckpointCount();
    $numberOfCPCountByStudent=$model->getCompletedCheckpointCount($studentID);

    $studentLatestLabName=$model->displayLatestLabNameByStudent($studentID);
    $dataSingleslln=['posts_slln'=>$studentLatestLabName];

    $classLatestLabName=$model->displayLatestLabNameByClass();
    $dataSingleclln=['posts_clln'=>$classLatestLabName];

    $toolXYValue=$model->displayXYValue($studentID, 1);
    $dataXYValue=['posts_XYValue'=>$toolXYValue];
 
    $toolXYValue2=$model->displayXYValue($studentID, 2);
    $dataXYValue2=['posts_XYValue2'=>$toolXYValue2];

    $toolXYValue3=$model->displayXYValue($studentID, 3);
    $dataXYValue3=['posts_XYValue3'=>$toolXYValue3];

    $img1=$img2=$img3=$img4=$img5=$img6="";
    $sum1=$sum2=$sum3=$sum4=$sum5=$sum6=0;
    $avg1=$avg2=$avg3=$avg4=$avg5=$avg6=0;

    #region tool 1 emoj
    for ($i=0; $i <count($dataXYValue['posts_XYValue']) ; $i++) {
        $sum1=$sum1+$dataXYValue['posts_XYValue'][$i]->xValue;
    }
    if (count($dataXYValue['posts_XYValue'])!=0) {
        $avg1=$sum1/count($dataXYValue['posts_XYValue']);
    }
    if ($avg1<-4) {
        $img1="happy.png";
    } elseif ($avg1<-8) {
        $img1="joy.png";
    } elseif ($avg1<2) {
        $img1="worry.png";
    } elseif ($avg1<=6) {
        $img1="sadness.png";
    } elseif ($avg2<=10) {
        $img1="fear.png";
    }

    for ($i=0; $i <count($dataXYValue['posts_XYValue']) ; $i++) {
        $sum2=$sum2+$dataXYValue['posts_XYValue'][$i]->yValue;
    }
    if (count($dataXYValue['posts_XYValue'])!=0) {
        $avg2=$sum2/count($dataXYValue['posts_XYValue']);
    }
    if ($avg2<-4) {
        $img2="fear.png";
    } elseif ($avg2<-8) {
        $img2="sadness.png";
    } elseif ($avg2<2) {
        $img2="worry.png";
    } elseif ($avg2<=6) {
        $img2="joy.png";
    } elseif ($avg2<=10) {
        $img2="happy.png";
    }
    #endregion

    #region tool 2 emoj
    for ($i=0; $i <count($dataXYValue2['posts_XYValue2']) ; $i++) {
        $sum3=$sum3+$dataXYValue2['posts_XYValue2'][$i]->xValue;
    }
    if (count($dataXYValue2['posts_XYValue2'])!=0) {
        $avg3=$sum3/count($dataXYValue2['posts_XYValue2']);
    }
    if ($avg3<-4) {
        $img3="fear.png";
    } elseif ($avg3<-8) {
        $img3="sadness.png";
    } elseif ($avg3<2) {
        $img3="worry.png";
    } elseif ($avg3<=6) {
        $img3="joy.png";
    } elseif ($avg3<=10) {
        $img3="happy.png";
    }

    for ($i=0; $i <count($dataXYValue2['posts_XYValue2']) ; $i++) {
        $sum4=$sum4+$dataXYValue2['posts_XYValue2'][$i]->yValue;
    }
    if (count($dataXYValue2['posts_XYValue2'])!=0) {
        $avg4=$sum4/count($dataXYValue2['posts_XYValue2']);
    }
    if ($avg4<-4) {
        $img4="fear.png";
    } elseif ($avg4<-8) {
        $img4="sadness.png";
    } elseif ($avg4<2) {
        $img4="worry.png";
    } elseif ($avg4<=6) {
        $img4="joy.png";
    } elseif ($avg4<=10) {
        $img4="happy.png";
    }
    #endregion

    #region tool 3 emoj
    for ($i=0; $i <count($dataXYValue3['posts_XYValue3']) ; $i++) {
        $sum5=$sum5+$dataXYValue3['posts_XYValue3'][$i]->xValue;
    }
    if (count($dataXYValue3['posts_XYValue3'])!=0) {
        $avg5=$sum5/count($dataXYValue3['posts_XYValue3']);
    }
    if ($avg5<-4) {
        $img5="fear.png";
    } elseif ($avg5<-8) {
        $img5="sadness.png";
    } elseif ($avg5<2) {
        $img5="worry.png";
    } elseif ($avg5<=6) {
        $img5="joy.png";
    } elseif ($avg5<=10) {
        $img5="happy.png";
    }

    for ($i=0; $i <count($dataXYValue3['posts_XYValue3']) ; $i++) {
        $sum6=$sum6+$dataXYValue3['posts_XYValue3'][$i]->yValue;
    }
    if (count($dataXYValue3['posts_XYValue3'])!=0) {
        $avg6=$sum6/count($dataXYValue3['posts_XYValue3']);
    }
    if ($avg6<-4) {
        $img6="fear.png";
    } elseif ($avg6<-8) {
        $img6="sadness.png";
    } elseif ($avg6<2) {
        $img6="worry.png";
    } elseif ($avg6<=6) {
        $img6="joy.png";
    } elseif ($avg6<=10) {
        $img6="happy.png";
    }
    #endregion

    #region Whole class data list
    $toolXValue=$model->displayXValueAvg($studentID, 1);
    $dataXValue=['posts_XValue'=>$toolXValue];
 
    $toolXValue2=$model->displayXValueAvg($studentID, 2);
    $dataXValue2=['posts_XValue2'=>$toolXValue2];

    $toolXValue3=$model->displayXValueAvg($studentID, 3);
    $dataXValue3=['posts_XValue3'=>$toolXValue3];

    $toolYValue=$model->displayYValueAvg($studentID, 1);
    $dataYValue=['posts_YValue'=>$toolYValue];
 
    $toolYValue2=$model->displayYValueAvg($studentID, 2);
    $dataYValue2=['posts_YValue2'=>$toolYValue2];

    $toolYValue3=$model->displayYValueAvg($studentID, 3);
    $dataYValue3=['posts_YValue3'=>$toolYValue3];
    #endregion

    // here to validate login
    if ($model->checkStudentLogin($studentID, $password)) {
        // Create session
        $_SESSION['studentID'] = $studentID;
        $_SESSION['password']=$password;

        include 'studentdashboard.html.php';
        exit;
    } else {
        $error="Password wrong...";
        include 'error.html.php';
        exit;
    }
} elseif ((isset($_POST['updatepwd']))) {
    $studentID=$_POST['sid'];
    $oldpwd=strip_tags(trim($_POST['oldpwd']));
    $newpwd=strip_tags(trim($_POST['newpwd']));
    $newpwd1=strip_tags(trim($_POST['newpwd1']));

    $passwordMatch="/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)^.{8,}$/";

    if (!$model->checkStudentLogin($studentID, $oldpwd)) {
        $error="Current password wrong...";
        include 'error.html.php';
        exit;
    }

    if (!preg_match($passwordMatch, $newpwd)) {
        $error="Password is not Match security requirements";
        include 'error.html.php';
        exit;
    }

    if ($newpwd1!=$newpwd) {
        $error="Two times password input is inconsistent";
        include 'error.html.php';
        exit;
    }

    try {
        $model->changePasswordByStudent($studentID, $newpwd1);
        $success_message="Congratulations, Password updated!";
        include 'success.html.php';
    } catch (PDOException $e) {
        $error='Update password faild';
        include 'error.html.php';
        exit();
    }
} elseif (!isset($_POST['studentName'])||!isset($_POST['spwd'])) {
    include 'login.html.php';
    exit;
}
