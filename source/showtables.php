<?php
/*
   * Project name: In612 Web 2 final project
   * Author: Hua WANG
   * Lectuer: Dale
   * CreatedAt: 2018-11-07
   * Description: Show all original data
   */
include 'model/Database.php';
include 'model/Model.php';

$model=new Model();

// Get all data
$dataList=$model->displayAllData();
$datas=['posts_data'=>$dataList];

// Get all completion
$completionList=$model->displayAllCompletion();
$dataC=['posts_c'=>$completionList];

// Get all lab
$labList=$model->displayAllLab();
$datalab=['posts_lab'=>$labList];

// Get all students
$studentsList=$model->displayAllStudents();
$dataStudents=['posts_students'=>$studentsList];

// Get all tool
$toolList=$model->displayAllTool();
$dataTool=['posts_tool'=>$toolList];

// Get all admin
$adminList=$model->displayAllAdmin();
$dataAdmin=['posts_admin'=>$adminList];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M"
    crossorigin="anonymous">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
    crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
    crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/project/css/style.css">
  <script src="<?php echo URLROOT; ?>/project/js/script.js"></script>
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/project/css/showtable.css">
  <title>BIT Students Affect Tool - Home</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="<?php echo URLROOT; ?>/project/index.php"><img
          class="logo-img" src="https://www.op.ac.nz/themes/op/images/225x105-op-logo.png" alt="BIT Students Affect Tool"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
        aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/project/index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/project/marking.php">Marking</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/project/studentdashboard.php">Student
              center</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/project/staffmanagement.php">Staff
              login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="row">
      <div class="col">

        <button class="tablink" onclick="openPage('Data', this, 'green')" id="defaultOpen">Data</button>
        <button class="tablink" onclick="openPage('Completion', this, 'green')">Completion</button>
        <button class="tablink" onclick="openPage('Students', this, 'green')">Students</button>
        <button class="tablink" onclick="openPage('Lab', this, 'green')">Lab</button>
        <button class="tablink" onclick="openPage('Tool', this, 'green')">Tool</button>
        <button class="tablink" onclick="openPage('Admin', this, 'green')">Admin</button>

        <div id="Data" class="tabcontent">
          <h2>Data table</h2>
          <table>
            <tr>
              <th>Data ID</th>
              <th>Tool ID</th>
              <th>Student ID</th>
              <th>Lab ID</th>
              <th>X Value</th>
              <th>Y Value</th>
            </tr>
            <?php
        foreach ($datas['posts_data'] as $post_data) {
            echo("<tr><td>$post_data->dataID</td><td>$post_data->toolID</td><td>$post_data->studentID</td><td>$post_data->labID</td><td>$post_data->xValue</td><td>$post_data->yValue</td></tr>");
        }
        ?>
          </table>
        </div>

        <div id="Completion" class="tabcontent">
          <h2>Completion table</h2>
          <table>
            <tr>
              <th>Completion ID</th>
              <th>Student ID</th>
              <th>Lab ID</th>
              <th>Response Time</th>
            </tr>
            <?php
        foreach ($dataC['posts_c'] as $post_data) {
            $d=strtotime($post_data->responseTime);
            $time=date("Y-m-d", $d);
            echo("<tr><td>$post_data->completionID</td><td>$post_data->studentID</td><td>$post_data->labID</td><td>$time</td></tr>");
        }
        ?>
          </table>
        </div>


        <div id="Students" class="tabcontent">
          <h2>Students table</h2>
          <table>
            <tr>
              <th>Student ID</th>
              <th>Student Number</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>User Name</th>
              <th>Password</th>
            </tr>
            <?php
        foreach ($dataStudents['posts_students'] as $post_data) {
            echo("<tr><td>$post_data->studentID</td><td>$post_data->studentNumber</td><td>$post_data->firstName</td><td>$post_data->lastName</td><td>$post_data->userName</td><td>$post_data->password</td></tr>");
        }
        ?>
          </table>
        </div>

        <div id="Lab" class="tabcontent">
          <h2>Lab table</h2>
          <table>
            <tr>
              <th>Lab ID</th>
              <th>Lab Name</th>
              <th>Is Checkpoint</th>
            </tr>
            <?php
        foreach ($datalab['posts_lab'] as $post_data) {
            echo("<tr><td>$post_data->labID</td><td>$post_data->labName</td><td>$post_data->isCheckpoint</td></tr>");
        }
        ?>
          </table>
        </div>

        <div id="Tool" class="tabcontent">
          <h2>Tool table</h2>
          <table>
            <tr>
              <th>Tool ID</th>
              <th>TableName X</th>
              <th>TableName Y</th>
              <th>North Label</th>
              <th>South Label</th>
              <th>East Label</th>
              <th>West Label</th>
            </tr>
            <?php
        foreach ($dataTool['posts_tool'] as $post_data) {
            echo("<tr><td>$post_data->toolID</td><td>$post_data->tableNamex</td><td>$post_data->tableNameY</td><td>$post_data->northLabel</td><td>$post_data->southLabel</td><td>$post_data->eastLabel</td><td>$post_data->westLabel</td></tr>");
        }
        ?>
          </table>
        </div>

        <div id="Admin" class="tabcontent">
          <h2>Tool Admin</h2>
          <table style="width:50%;">


 <tr> 
              <th>Admin ID</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>User Name</th>
              <th>Password</th>
              <th>Admin Password</th>
              <th>Course Sub</th>
              <th>Tab</th>
            </tr>
            <?php
        foreach ($dataAdmin['posts_admin'] as $post_data) {
            echo("<tr><td>$post_data->adminID</td><td>$post_data->firstName</td><td>$post_data->lastName</td><td>$post_data->userName</td><td>$post_data->password</td><td></td><td>$post_data->courseSub</td><td>$post_data->tab</td></tr>");
        }
        ?> 
          </table>
          
        </div>

        <script>
          function openPage(pageName, elmnt, color) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
              tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablink");
            for (i = 0; i < tablinks.length; i++) {
              tablinks[i].style.backgroundColor = "";
            }
            document.getElementById(pageName).style.display = "block";
            elmnt.style.backgroundColor = color;

          }
          // Get the element with id="defaultOpen" and click on it
          document.getElementById("defaultOpen").click();
        </script>




      </div>

    </div>
  </div>








  <footer class="bg-dark text-center color-white">
    <br><br><br>
    Copyright &copy; 2018. All rights reserved.
    <br><br><br>
  </footer>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
    crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"
    crossorigin="anonymous"></script>
</body>

</html>