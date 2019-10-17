<?php
include 'model/Database.php';
include 'model/Model.php';
$model=new Model();
if (isset($_POST['reset'])) {
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
}