<?php
/*
   * Project name: In612 Web 2 final project
   * Author: Hua WANG
   * Lectuer: Dale
   * CreatedAt: 2018-11-07
   * Description: System initialize page that create database and import original data record
   */
  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BIT Students Affect Tool - Create Tables</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 1rem;
            line-height: 2;
        }

        .loader {
            margin: auto;
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite;
            /* Safari */
            animation: spin 2s linear infinite;
            cursor: pointer;
        }

        .loaders {
            margin: auto;
            border: 16px solid #3498db;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 120px;
            height: 120px;
            /*-webkit-animation: spin 2s linear infinite;

            animation: spin 2s linear infinite;*/
            cursor: pointer;
        }

        .c h3 {
            margin: auto;
            text-align: center;
        }

        #start {
            text-align: center;
        }

        /* Safari */

        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        .c {
            width: 250px;
            height: 300px;
            margin: auto;
            margin-top: 300px;
        }

        .green {
            color: green;
        }
    </style>
    <script>
        function createTables() {

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText == 1) {
                        document.getElementById('loader').className = 'loaders';
                        //alert('Congratulations, Database initialize success!');
                        document.getElementById('hs').innerHTML =
                            'Congratulations!<br> Database has been initialized successfully!';
                        document.getElementById('hs').className = 'green';
                        document.getElementById('start').innerHTML = '<br><a target="_blank" href="showtables.php">Show Tables</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank" href="index.php">Get Start</a>';
                        //window.location.href = 'index.php';
                        return;
                    } else {
                        document.getElementById('loader').style.display = 'none';
                        document.getElementById('hs').innerHTML = this.responseText;

                    }
                }
            };
            xmlhttp.open('GET', 'createtables.php', true);
            xmlhttp.send();

        }
    </script>
</head>

<body onload="createTables();">
    <div class="c">
        <div class="loader" id="loader"></div>
        <br>
        <h3 id="hs">The system is creating tables...</h3>
        <p id="start"></p>

    </div>
</body>

</html>