<?php

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


  <div class="container bg_white">
    <form action='<?php echo $self; ?>' method="post">
      <br>
      <h3>QUESTION <span class='font-g'> 3 / 3 </span>: </h3>
      <h4>Use the grid to choose the point that best describes your opinion of today's lab.</h4>
      <br>
      <table class="shadow table-position table_bg">
        <tr>
          <td>
            <div class="easy-container">
              <p class="easy-hard">My skills<br>haven't<br>improved</p>
            </div>
          </td>
          <td>
            <table class="qtable">
              <caption class="ct table-position">
                <h3>I feel triumphant</h3>
              </caption>
              <caption class="cb table-position">
                <h3>I feel frustrated</h3>
              </caption>

              <?php
              for ($y=10;$y>=1;$y--) {
                  echo "<tr>";
                  for ($x=-10; $x<=10; $x++) {
                      $elements=("
                    <td class='each-td'>
                      <label class='radio' for='radio ".$x.",".$y."'>
                        <div class='cell' onclick='tickCell(this);' title='".$x.",".$y."'>
                          <input class='radio' type='radio' name='score' value='".$x.",".$y."' id='radio ".$x.",".$y."' />
                        </div>
                      </label>
                    </td>
                    ");
                      if ($x==0) {
                          $elements=("<td class='axis'></td>");
                      }
                      echo $elements;
                      if ($x==10) {
                          echo "</tr>";
                      }
                  }
                  echo "</tr>";
              }
              ?>
              <tr>
                <?php
                for ($z=-10;$z<=10;$z++) {
                    echo("<td class='axis'></td>");
                }
                ?>
              </tr>
              <?php
              for ($y=-1;$y>=-10;$y--) {
                  echo "<tr>";
              
                  for ($x=-10; $x<=10; $x++) {
                      $elements=("
                    <td>
                      <label class='radio' for='radio ".$x.",".$y."'>
                        <div class='cell' onclick='tickCell(this);' title='".$x.",".$y."'>
                          <input class='radio' type='radio' name='score' value='".$x.",".$y."' id='radio ".$x.",".$y."' />
                        </div>
                      </label>
                    </td>
                    ");
                      if ($x==0) {
                          $elements=("<td class='axis'></td>");
                      }
                      echo $elements;
                      if ($x==10) {
                          echo "</tr>";
                      }
                  }
                  echo "</tr>";
              }
              ?>
            </table>
          </td>
          <td>
            <div class="easy-container">
              <p class="easy-hard">My skills<br>have<br>improved</p>
            </div>
          </td>
        </tr>
      </table>
      <br>
      <div class="btn-area">
        <p>
          <input type="hidden" name="studentID" value="<?php echo $studentID; ?>" />
          <input type="hidden" name="labID" value="<?php echo $labID; ?>" />
          <input type="hidden" name="toolID" value="3" />
          <input type="submit" class="btn btn-primary btn-lg active hand" name="skip3" value="Skip Question" />&nbsp;&nbsp;
          <input type="submit" class="btn btn-primary btn-lg active hand" name="sendAnswer3" value="Send Answer" id="sendAnswer3" />
        </p><br>
      </div>
    </form>
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