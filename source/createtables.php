<?php
/*
   * Project name: In612 Web 2 final project
   * Author: Hua WANG
   * Lectuer: Dale
   * CreatedAt: 2018-11-07
   * Description: Ajax back end handle process to accept send from createtables.html.php
   */

  // include data model and configuration file
  include 'model/Database.php';
  include 'model/Model.php';


  try {
      $model=new Model(); // Instantiation Model object

      // create tables, import original data
      $model->createAdmin();
      $model->initializeAdmin("inc/admin.csv");
      $model->createStudents();
      $model->initializeStudents("inc/students.csv");
      $model->createCompletion();
      $model->initializeCompletion("inc/completion.csv");
      $model->createData();
      $model->initializeData("inc/data.csv");
      $model->createLab();
      $model->initializeLab("inc/lab.csv");
      $model->createTool();
      $model->initializeTool("inc/tool.csv");
      $success_message='Congratulations, Database initialize success!';
      echo "1"; // return 1 if all successfully
    //   include 'success.html.php';
    //   exit;
  } catch (PDOException $e) {
    //   $error='Initialize database failed';
    //   include 'error.html.php';
    //   exit();
    echo $e;
  }
  ?>
