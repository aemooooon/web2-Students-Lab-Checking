<?php
/*
   * Project name: In612 Web 2 final project
   * Author: Hua WANG
   * Lectuer: Dale
   * CreatedAt: 2018-11-07
   * Description: The student dash-board main interface
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
  <script src="https://www.gstatic.com/charts/loader.js"></script>
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/project/css/style.css">
  <script src="<?php echo URLROOT; ?>/project/js/script.js"></script>
  <script>
    google.charts.load("current", {
      packages: ["corechart"]
    });

    // donut chart 2
    google.charts.setOnLoadCallback(drawChart2);

    function drawChart2() {
      var data2 = google.visualization.arrayToDataTable([
        ['Status', 'Number of Checkpoints'],
        ['Completed', <?php echo $numberOfCPCountByStudent; ?> ],
        ['Not completed', <?php echo($numberOfCPCount-$numberOfCPCountByStudent);?> ]
      ]);
      var options2 = {
        title: 'Completion Checkpoints',
        pieHole: 0.55,
        backgroundColor: '#f9f9f9'
      };
      var chart2 = new google.visualization.PieChart(document.getElementById('donutchart2'));
      chart2.draw(data2, options2);
    }


    google.charts.load('current', {
      packages: ['corechart', 'line']
    });

    // line chart 1 - easy hard
    google.charts.setOnLoadCallback(drawLineColors);

    function drawLineColors() {
      var data = new google.visualization.DataTable();
      data.addColumn('number', 'x');
      data.addColumn('number', 'Difficulty');
      data.addRows([
        <?php
          foreach ($dataXYValue['posts_XYValue'] as $value) {
              echo('['.$value->labID.', '.$value->xValue.'],');
          }
          ?>
      ]);
      var options = {
        title: 'All Labs Difficulty Rating for <?php echo $dataSingleStudent['post_student']->lastName ." ".$dataSingleStudent['post_student']->firstName ; ?>',
        hAxis: {
          title: 'Lab Number'
        },
        vAxis: {
          title: 'Easy - Hard'
        },
        colors: ['#CC00FF'],
        backgroundColor: '#f0f0f0'
      };
      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }

    // line chart 2 - boring interst
    google.charts.setOnLoadCallback(drawLineColors2);

    function drawLineColors2() {
      var data = new google.visualization.DataTable();
      data.addColumn('number', 'X');
      data.addColumn('number', 'Interest');


      data.addRows([
        <?php
          foreach ($dataXYValue['posts_XYValue'] as $value) {
              echo('['.$value->labID.', '.$value->yValue.'],');
          }
          ?>
      ]);

      var options = {
        title: 'All Labs Interest Rating for <?php echo $dataSingleStudent['post_student']->lastName ." ".$dataSingleStudent['post_student']->firstName ; ?>',
        hAxis: {
          title: 'Lab Number'
        },
        vAxis: {
          title: 'Boring - interesting'
        },
        colors: ['#CC0000'],
        backgroundColor: '#f0f0f0'
      };

      var chart2 = new google.visualization.LineChart(document.getElementById('chart_div2'));
      chart2.draw(data, options);
    }

    // line chart 1 - new familiar
    google.charts.setOnLoadCallback(drawLineColors3);

    function drawLineColors3() {
      var data = new google.visualization.DataTable();
      data.addColumn('number', 'X');
      data.addColumn('number', 'Familiarity');


      data.addRows([
        <?php
          foreach ($dataXYValue2['posts_XYValue2'] as $value) {
              echo('['.$value->labID.', '.$value->xValue.'],');
          }
          ?>
      ]);

      var options = {
        title: 'All Labs Familiarity Rating for <?php echo $dataSingleStudent['post_student']->lastName ." ".$dataSingleStudent['post_student']->firstName ; ?>',
        hAxis: {
          title: 'Lab Number'
        },
        vAxis: {
          title: 'All new - Familiar'
        },
        colors: ['#FF0099'],
        backgroundColor: '#f0f0f0'
      };

      var chart = new google.visualization.LineChart(document.getElementById('chart_div3'));
      chart.draw(data, options);
    }

    // line chart 4 - plan no-plan
    google.charts.setOnLoadCallback(drawLineColors4);

    function drawLineColors4() {
      var data = new google.visualization.DataTable();
      data.addColumn('number', 'X');
      data.addColumn('number', 'Plan');


      data.addRows([
        <?php
          foreach ($dataXYValue2['posts_XYValue2'] as $value) {
              echo('['.$value->labID.', '.$value->yValue.'],');
          }
          ?>
      ]);

      var options = {
        title: 'All Labs Plan Rating for <?php echo $dataSingleStudent['post_student']->lastName ." ".$dataSingleStudent['post_student']->firstName ; ?>',
        hAxis: {
          title: 'Lab Number'
        },
        vAxis: {
          title: 'No plan - Clear plan'
        },
        colors: ['#996600'],
        backgroundColor: '#f0f0f0'
      };

      var chart = new google.visualization.LineChart(document.getElementById('chart_div4'));
      chart.draw(data, options);
    }

    // line char 5 improved
    google.charts.setOnLoadCallback(drawLineColors5);

    function drawLineColors5() {
      var data = new google.visualization.DataTable();
      data.addColumn('number', 'X');
      data.addColumn('number', 'Improvement');


      data.addRows([
        <?php
          foreach ($dataXYValue3['posts_XYValue3'] as $value) {
              echo('['.$value->labID.', '.$value->xValue.'],');
          }
          ?>
      ]);

      var options = {
        title: 'All Labs Improvement Rating for <?php echo $dataSingleStudent['post_student']->lastName ." ".$dataSingleStudent['post_student']->firstName ; ?>',
        hAxis: {
          title: 'Lab Number'
        },
        vAxis: {
          title: 'Not improved - improved'
        },
        colors: ['#009900'],
        backgroundColor: '#f0f0f0'
      };

      var chart = new google.visualization.LineChart(document.getElementById('chart_div5'));
      chart.draw(data, options);
    }

    // line chart 6  frustrated triumphant
    google.charts.setOnLoadCallback(drawLineColors6);

    function drawLineColors6() {
      var data = new google.visualization.DataTable();
      data.addColumn('number', 'X');
      data.addColumn('number', 'Satisfaction');


      data.addRows([
        <?php
          foreach ($dataXYValue3['posts_XYValue3'] as $value) {
              echo('['.$value->labID.', '.$value->yValue.'],');
          }
          ?>
      ]);

      var options = {
        title: 'All Labs Satisfaction Rating for <?php echo $dataSingleStudent['post_student']->lastName ." ".$dataSingleStudent['post_student']->firstName ; ?>',
        hAxis: {
          title: 'Lab Number'
        },
        vAxis: {
          title: 'Frustrated - Triumphant'
        },
        colors: ['#6600FF'],
        backgroundColor: '#f0f0f0'
      };

      var chart = new google.visualization.LineChart(document.getElementById('chart_div6'));
      chart.draw(data, options);
    }


    // Chart 7
    google.charts.setOnLoadCallback(drawVisualization7);

    function drawVisualization7() {
      // Some raw data (not necessarily accurate)
      var data = google.visualization.arrayToDataTable([
        ['Lab', 'Individual', 'Whole Class'],
        <?php
                if (count($dataXValue['posts_XValue'])==0) {
                    echo("['0',0,0]");
                }
          foreach ($dataXValue['posts_XValue'] as $value) {
              echo('["'.$value->labName.'", '.$value->individualAvg.', '.$value->wholeAvg.'],');
          }
          ?>
      ]);

      var options = {
        width: 1235,
        height: 520,
        title: 'Individual vs Whole class about Easy - Hard tool',
        vAxis: {
          title: 'Easy Hard - Avg'
        },
        hAxis: {
          title: 'Lab Name'
        },
        seriesType: 'bars',
        series: {
          5: {
            type: 'line'
          }
        },
        backgroundColor: '#f0f0f0'
      };

      var chart7 = new google.visualization.ComboChart(document.getElementById('chart_div7'));
      chart7.draw(data, options);
    }


    // Chart 8
    google.charts.setOnLoadCallback(drawVisualization8);

    function drawVisualization8() {
      // Some raw data (not necessarily accurate)
      var data = google.visualization.arrayToDataTable([
        ['Lab', 'Individual', 'Whole Class'],
        <?php
                if (count($dataYValue['posts_YValue'])==0) {
                    echo("['0',0,0]");
                }
          foreach ($dataYValue['posts_YValue'] as $value) {
              echo('["'.$value->labName.'", '.$value->individualAvg.', '.$value->wholeAvg.'],');
          }
          ?>
      ]);

      var options = {
        width: 1235,
        height: 520,
        title: 'Individual vs Whole class about Boring - Interesting tool',
        vAxis: {
          title: 'Boring - Interesting'
        },
        hAxis: {
          title: 'Lab Name'
        },
        seriesType: 'bars',
        series: {
          5: {
            type: 'line'
          }
        },
        backgroundColor: '#f0f0f0'
      };

      var chart8 = new google.visualization.ComboChart(document.getElementById('chart_div8'));
      chart8.draw(data, options);
    }



    // Chart 9
    google.charts.setOnLoadCallback(drawVisualization9);

    function drawVisualization9() {
      // Some raw data (not necessarily accurate)
      var data = google.visualization.arrayToDataTable([
        ['Lab', 'Individual', 'Whole Class'],
        <?php
                if (count($dataXValue2['posts_XValue2'])==0) {
                    echo("['0',0,0]");
                }
          foreach ($dataXValue2['posts_XValue2'] as $value) {
              echo('["'.$value->labName.'", '.$value->individualAvg.', '.$value->wholeAvg.'],');
          }
          ?>
      ]);

      var options = {
        width: 1235,
        height: 520,
        title: 'Individual vs Whole class about All New - Familiar tool',
        vAxis: {
          title: 'All New - Familiar Avg'
        },
        hAxis: {
          title: 'Lab Name'
        },
        seriesType: 'bars',
        series: {
          5: {
            type: 'line'
          }
        },
        backgroundColor: '#f0f0f0'
      };

      var chart9 = new google.visualization.ComboChart(document.getElementById('chart_div9'));
      chart9.draw(data, options);
    }

    // Chart 10
    google.charts.setOnLoadCallback(drawVisualization10);

    function drawVisualization10() {
      // Some raw data (not necessarily accurate)
      var data = google.visualization.arrayToDataTable([
        ['Lab', 'Individual', 'Whole Class'],
        <?php
                if (count($dataYValue2['posts_YValue2'])==0) {
                    echo("['0',0,0]");
                }
          foreach ($dataYValue2['posts_YValue2'] as $value) {
              echo('["'.$value->labName.'", '.$value->individualAvg.', '.$value->wholeAvg.'],');
          }
          ?>
      ]);

      var options = {
        width: 1235,
        height: 520,
        title: 'Individual vs Whole class about No plan - Clear plan tool',
        vAxis: {
          title: 'No Plan - Clear Avg'
        },
        hAxis: {
          title: 'Lab Name'
        },
        seriesType: 'bars',
        series: {
          5: {
            type: 'line'
          }
        },
        backgroundColor: '#f0f0f0'
      };

      var chart10 = new google.visualization.ComboChart(document.getElementById('chart_div10'));
      chart10.draw(data, options);
    }



    // Chart 11
    google.charts.setOnLoadCallback(drawVisualization11);

    function drawVisualization11() {
      // Some raw data (not necessarily accurate)
      var data = google.visualization.arrayToDataTable([
        ['Lab', 'Individual', 'Whole Class'],
        <?php
                if (count($dataXValue3['posts_XValue3'])==0) {
                    echo("['0',0,0]");
                }
          foreach ($dataXValue3['posts_XValue3'] as $value) {
              echo('["'.$value->labName.'", '.$value->individualAvg.', '.$value->wholeAvg.'],');
          }
          ?>
      ]);

      var options = {
        width: 1235,
        height: 520,
        title: 'Individual vs Whole class about Not improved - Improved tool',
        vAxis: {
          title: 'Not improved - Improved AVG'
        },
        hAxis: {
          title: 'Lab Name'
        },
        seriesType: 'bars',
        series: {
          5: {
            type: 'line'
          }
        },
        backgroundColor: '#f0f0f0'
      };

      var chart11 = new google.visualization.ComboChart(document.getElementById('chart_div11'));
      chart11.draw(data, options);
    }



    // Chart 12
    google.charts.setOnLoadCallback(drawVisualization12);

    function drawVisualization12() {
      // Some raw data (not necessarily accurate)
      var data = google.visualization.arrayToDataTable([
        ['Lab', 'Individual', 'Whole Class'],
        <?php
        if (count($dataYValue3['posts_YValue3'])==0) {
            echo("['0',0,0]");
        }
          foreach ($dataYValue3['posts_YValue3'] as $value) {
              echo('["'.$value->labName.'", '.$value->individualAvg.', '.$value->wholeAvg.'],');
          }
          ?>
      ]);

      var options = {
        width: 1235,
        height: 520,
        title: 'Individual vs Whole class about Frustrated - Triumphant tool',
        vAxis: {
          title: 'Frustrated - Triumphant AVG'
        },
        hAxis: {
          title: 'Lab Name'
        },
        seriesType: 'bars',
        series: {
          5: {
            type: 'line'
          }
        },
        backgroundColor: '#f0f0f0'
      };

      var chart12 = new google.visualization.ComboChart(document.getElementById('chart_div12'));
      chart12.draw(data, options);
    }
  </script>
  <title>Student Dashboard</title>
</head>

<body>
  <div class="container-fluid bg-dark">
    <div class="row">
      <div class="col-8">
        <div class="row text-left" style="background-color:#f9f9f9;">
          <div class="col">
            <img class="dblogo" src="./images/logo.png" alt="Otago Polytechnic">
            <div class="daoying">
              <br>
              &nbsp;&nbsp;<i class="fab fa-btc"></i><i class="fas fa-info"></i><i class="fab fa-tumblr"></i> Student
              Center - Dash Board
            </div>
          </div>
        </div>


        <div class="row" style="margin:auto;">

          <button class="tablink" onclick="openPage('individual', this, 'green')" id="defaultOpen">Individual</button>
          <button class="tablink" onclick="openPage('wholetool1', this, 'green')">Whole Class Tool 1</button>
          <button class="tablink" onclick="openPage('wholetool2', this, 'green')">Whole Class Tool 2</button>
          <button class="tablink" onclick="openPage('wholetool3', this, 'green')">Whole Class Tool 3</button>

          <div id="individual" class="tabcontent">

            <div class="row">
              <div class="col">
                <div id="chart_div" class="chart-size"></div>
                <div class="emoj"><img src="./images/<?php echo $img1; ?>"
                    alt=""></div>
              </div>
              <div class="col">
                <div id="chart_div2" class="chart-size"></div>
                <div class="emoj"><img src="./images/<?php echo $img2; ?>"
                    alt=""></div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col">
                <div id="chart_div3" class="chart-size"></div>
                <div class="emoj"><img src="./images/<?php echo $img3; ?>"
                    alt=""></div>
              </div>
              <div class="col">
                <div id="chart_div4" class="chart-size"></div>
                <div class="emoj"><img src="./images/<?php echo $img4; ?>"
                    alt=""></div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col">
                <div id="chart_div5" class="chart-size"></div>
                <div class="emoj"><img src="./images/<?php echo $img5; ?>"
                    alt=""></div>
              </div>
              <div class="col">
                <div id="chart_div6" class="chart-size"></div>
                <div class="emoj"><img src="./images/<?php echo $img6; ?>"
                    alt=""></div>
              </div>
            </div>
            <br>
          </div>

          <div id="wholetool1" class="tabcontent">
            <div id="chart_div7"></div><br><br>
            <div id="chart_div8"></div><br>
          </div>

          <div id="wholetool2" class="tabcontent">
            <div id="chart_div9"></div><br><br>
            <div id="chart_div10"></div><br>
          </div>

          <div id="wholetool3" class="tabcontent">
            <div id="chart_div11"></div><br><br>
            <div id="chart_div12"></div><br>
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


      <div class="col-4 rightside">
        <p class="welcome"><i class="fab fa-weebly"></i>elcome, <?php echo $dataSingleStudent['post_student']->lastName ." ".$dataSingleStudent['post_student']->firstName ; ?>
          (<span class="font-g"><?php echo $dataSingleStudent['post_student']->studentNumber; ?></span>)
          &nbsp;&nbsp;<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Password</a>&nbsp;&nbsp;<a
            href="./securelogout.php" class="btn btn-primary">Logout</a></p>

        <?php
            $slab;
            if (empty($dataSingleslln['posts_slln'])) {
                $slab="Nothing";
            } else {
                $slab=$dataSingleslln['posts_slln']->labName;
            }
        ?>
        <br><br>
        <div class="row container shadow">
          <div class="col-8">
            <p>&nbsp;</p>
            <h3><i class="fab fa-cuttlefish"></i>heckpoint</h3>
            <p></p>
            <h3><span class="badge badge-success sl-size">Completed</span>&nbsp;&nbsp;<span class="font-g"><?php echo $numberOfCPCountByStudent." / ".$numberOfCPCount ?></span></h3>
            <h3><span class="badge badge-primary sl-size">Latest of You</span>&nbsp;&nbsp;<span class="font-g"><?php echo $slab; ?></span></h3>
            <h3><span class="badge badge-danger sl-size">Latest of Class</span>&nbsp;&nbsp;<span class="font-g"><?php echo $dataSingleclln['posts_clln']->labName; ?></span></h3>
            <p></p>
          </div>

          <div class="col-4">
            <br><br>
            <?php
            $imgs;

            if ($slab==$dataSingleclln['posts_clln']->labName) {
                $imgs="happy.png";
            } else {
                $imgs="worry.png";
            }
            echo('<img src="./images/'.$imgs.'" alt="">');
            ?>
          </div>
        </div>
        <br>

        <div class="row container shadow">
          <div id="donutchart2" style="min-width:480px;height:320px;"></div>
        </div>
        <br>

        <div class="row container shadow">
          <div class="col">
            <br>
            <h3>Checkpoint status</h3>
            <?php foreach ($dataLabCP['posts_lab_CP'] as $post_lab) : ?>
            <?php
              $cn="lab-container";
              foreach ($dataMarkedLabs['posts_markedLabs'] as $value) {
                  if ($post_lab->labID==$value->labID) {
                      $cn="lab-container-a";
                  }
              }
              ?>
            <div class="<?php echo $cn; ?>">
              <span><?php echo $post_lab->labName; ?></span>
            </div>
            <?php endforeach; ?>
            <div style="height:20px; clear:both;"></div>
          </div>
        </div>

        <br>
        <div class="row container shadow">
          <div class="col">
            <br>
            <h3>Lab status</h3>

            <?php foreach ($dataLab['posts_lab'] as $post_lab) : ?>

            <?php
              $cn="lab-container";
              foreach ($dataMarkedLabs['posts_markedLabs'] as $value) {
                  if ($post_lab->labID==$value->labID) {
                      $cn="lab-container-a";
                  }
              }
              ?>
            <div class="<?php echo $cn; ?>">
              <span><?php echo $post_lab->labName; ?></span>
            </div>
            <?php endforeach; ?>
            <div style="height:20px; clear:both;"></div>
          </div>
        </div>
        <br>
      </div>
    </div>



  </div>


  <footer class="bg-light text-center">
    <br><br>
    Copyright &copy; 2018. All rights reserved.
    <br><br>
  </footer>


  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-key"></i>&nbsp;Update Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action='<?php echo $self; ?>' method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="oldpwd" class="col-form-label">Current Password:</label>
              <input type="password" class="form-control" id="oldpwd" name="oldpwd" required>
            </div>
            <div class="form-group">
              <label for="newpwd" class="col-form-label">New Password:</label>
              <input type="password" class="form-control" id="newpwd" name="newpwd" required>
            </div>
            <div class="form-group">
              <label for="newpwd1" class="col-form-label">Re New Password:</label>
              <input type="password" class="form-control" id="newpwd1" name="newpwd1" required>
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="sid" value="<?php echo $studentID;?>">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" name="updatepwd" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>



  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
    crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"
    crossorigin="anonymous"></script>

</body>

</html>