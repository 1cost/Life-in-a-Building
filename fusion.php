<!DOCTYPE html>
<html lang="en">

  <head>
    <script>
    var cams = ["7th Wing Gym",
                    "MacDonough Gym 1",
                    "Barbershop"];
    var locMap = {
      "MacDonough Hall": "macd",
      "7th Wing Gym": "7",
      "Barbershop": "barb",
      "All": "*"
    };

    var typeMap = {
      "Persons" : "p",
      "Backpacks" : "b",
      "All": "*"
    };
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <script type="text/JavaScript" src ="js/functions.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src ="js/Chart.js/chart.min.js"></script>
    <script src ="js/functions.js"></script>
    <script src ="datepicker/datepicker.js"></script>
    <script type="text/javascript" src="timepicker/bootstrap-clockpicker.min.js"></script>
    <script src="tables/dt.js"></script>


    <title>Live feeds</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="datepicker/bootstrap-datepicker.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="timepicker/bootstrap-clockpicker.min.css">
    <link rel="stylesheet" href="tables/dt.css">

    <!-- src: https://thenounproject.com/term/big-brother/38042/ -->
    <link rel="icon" href="imgs/surv_favicon.png">

    <!-- Custom styles for this template -->
    <link href="css/1-col-portfolio.css" rel="stylesheet">
  </head>

  <body>

<?php
	require_once("php/navbar.php");
?>

<br><br><br>
<form method='POST' action='php/getDate.php' onsubmit="return goRadar(this,myChart);">
<div class="container">
  <div class = "row">
    <div class = "col-lg-2">
    </div>
    <div class = "col-lg-2 col-lg-offset-4"><span class = "label label-primary">Date to Compare: </span></div>
    <div class = "col-lg-4 col-lg-offset-2">
      <div class="well span12 main" style="text-align:center;">
      	
        <input type="text" id="start_date" class="span2 datepicker" placeholder="2019-04-01"
           name="start_date"> 
        <br>
      </div>
    </div>
  </div>
</div>
<div class="container" style="text-align:center;">
	<br>
  <button type='submit' class='btn btn-success'>Submit</button>
  <br>
  </form>
</div>
<hr>
<div class="container">
  <div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-4">
      <canvas id ="left" width = "500" height= "500"></canvas>
    </div>
    <div class="col-md-4">
      <canvas id ="right" width = "500" height= "500"></canvas>
    </div>
    <div class="col-md-2">
    </div>
  </div>
</div>
<div class='container'>
    <div id='err' style='text-align:center;'></div>
</div>
<hr>

<div class="container" style = "text-align:center;">
	<h3>For <span id="DATE_INSERT">2019-04-01</span>:</h3>
	00:00:00 -> 06:00:00 <b id="A">43% busier</b> than emperical average.<br>
	06:00:00 -> 12:00:00 <b id="B">12% busier</b> than emperical average.<br>
	12:00:00 -> 18:00:00 <b id="C">8% quieter</b> than emperical average.<br>
	18:00:00 -> 24:00:00 <b id="D">30% busier</b> than emperical average.<br>
</div>
<hr>
<br>

  </body>
  <!-- Footer -->
  <footer class="py-5 bg-dark">
      <p class="m-0 text-center text-white">Copyright &copy; Life in a Building 2018-2019</p>
    <!-- /.container -->
  </footer>
  <script>
$(function(){
   $('.datepicker').datepicker({
      format: 'yyyy-mm-dd'
    });
});

var myChart = new Chart(document.getElementById("left"),
{"type":"radar",
"data":
  {
    "labels":["0000-0600","0600-1200","1200-1800","1800-2400"],
    "datasets":[{"label":"# Mids","data":[65,59,90,81],
    "fill":true,
    "backgroundColor":"rgba(255, 99, 132, 0.2)",
    "borderColor":"rgb(255, 99, 132)",
    "pointBackgroundColor":"rgb(255, 99, 132)",
    "pointBorderColor":"#fff",
    "pointHoverBackgroundColor":"#fff",
    "pointHoverBorderColor":"rgb(255, 99, 132)"}]},
    "options":
      {"elements":{"line":{"tension":0,"borderWidth":3}}}});
var lChart = new Chart(document.getElementById("right"),
{"type":"radar",
"data":
  {
    "labels":["0000-0600","0600-1200","1200-1800","1800-2400"],
    "datasets":[{"label":"# Detections","data":[30,28,45,40],
"fill":true,"backgroundColor":"rgba(54, 162, 235, 0.2)","borderColor":"rgb(54, 162, 235)","pointBackgroundColor":"rgb(54, 162, 235)","pointBorderColor":"#fff","pointHoverBackgroundColor":"#fff","pointHoverBorderColor":"rgb(54, 162, 235)"}]},"options":{"elements":{"line":{"tension":0,"borderWidth":3}}}});
</script>


</html>
