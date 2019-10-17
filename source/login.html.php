<?php
/*
   * Project name: In612 Web 2 final project
   * Author: Hua WANG
   * Lectuer: Dale
   * CreatedAt: 2018-11-07
   * Description: The student login system entrance
   */
$self = htmlentities($_SERVER['PHP_SELF']);
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
  <title>BIT Students Affect Tool - Student Login</title>
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


  <div class="container bg_white">
    <br><br><br><br><br><br><br>
    <div class="row">
      <div class="col-sm">
        &nbsp;
      </div>
      <div class="col-sm">
        <div class="card shadow" style="width: 36rem;">
          <div class="card-header">
            <h2><i class="fas fa-sign-in-alt"></i>&nbsp;&nbsp;Student Login</h2>
          </div>
          <div class="card-body">
            <form action='<?php echo $self; ?>' method="post">
              <div class="form-group">
                <label for="studentName">Student Name</label>
                <select class="form-control" id="studentName" name="studentName">
                  <option value='0'>Please select Student Name</option>
                  <?php foreach ($dataStudent['posts_student'] as $post_student) : ?>
                  <option value='<?php echo($post_student->studentID); ?>'>
                    <?php echo($post_student->lastName.' '.$post_student->firstName); ?>
                  </option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="form-group">
                <label for="tpwd">Student Password</label>
                <input type="password" class="form-control" name="spwd" id="tpwd" placeholder="Password"
                  required>
              </div>
              <br>
              <button type="submit" name="login" class="btn btn-primary btn-lg btn-block hand">Login</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-sm">
        &nbsp;
      </div>
    </div>
    <br><br><br><br><br><br><br>
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