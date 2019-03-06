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

    <title>Live feeds</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="datepicker/bootstrap-datepicker.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="timepicker/bootstrap-clockpicker.min.css">

    <!-- src: https://thenounproject.com/term/big-brother/38042/ -->
    <link rel="icon" href="imgs/surv_favicon.png">

    <!-- Custom styles for this template -->
    <link href="css/1-col-portfolio.css" rel="stylesheet">
  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">Life in a Building</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="dat.php">Data Management</a>
            </li>
            <!--
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
          -->
          </ul>
        </div>
      </div>
    </nav>
<!-- End Navigation -->
<div class="container">

<!-- Contained in Jumbotron -->

<h1 style="text-align:center;">Data Query</h1>

<div style="text-align:center;">
  <div class="container">
    <div class="row"/>
      <div class="col-md">
        <div id="title">
        </div>
        <div id="placement">
        </div>
      </div>
      <div cl￼End
ass="col-md">
        <span id="pic"></span>
      </div>
    </div>
  </div>
</div>
<script> var myChart; </script>

<hr>
<div id="placeholder">
  <form method='POST' action='pull.php' onsubmit="return goForm(this,myChart);">
  <div class = 'container'>
    <div class='form-group' style='text-align:center;' align="center">
        <canvas id ="canv" width = "1000   " height= "500"></canvas>
    </div>
    </div>
  <div class = "row">
    <div class = "col-lg-2">
    </div>
    <div class = "col-lg-2 col-lg-offset-4"><span class = "label label-primary">Search Start Time: </span></div>
    <div class = "col-lg-4 col-lg-offset-2">
      <div class="well span12 main" style="text-align:center;">
        <input type="text" id="start_date" class="span2 datepicker" placeholder="Date..."
           name="start_date"> <br>
      </div>
    </div>
    <div class = "col-md-1 col-lg-offset-2">
      <div class="well span12 main" style="text-align:center;">
        <div class="input-group clockpicker">
          <input type="text" class="form-control" value="09:30" name = "start_time">
          <span class="input-group-addon">
          <span class="glyphicon glyphicon-time"></span>
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class = "row">
    <div class = "col-lg-2">
    </div>
    <div class = "col-lg-2 col-lg-offset-4"><span class = "label label-primary">Search End Time: </span></div>
    <div class = "col-lg-4 col-lg-offset-2">
      <div class="well span12 main" style="text-align:center;">
        <input type="text" id="end_date" class="span2 datepicker" placeholder="Date..."
           name="end_date"> <br>
      </div>
    </div>
    <div class = "col-md-1 col-lg-offset-2">
      <div class="well span12 main" style="text-align:center;">
        <div class="input-group clockpicker">
          <input type="text" class="form-control" value="09:30" name ="end_time">
          <span class="input-group-addon">
          <span class="glyphicon glyphicon-time"></span>
          </span>
        </div>
      </div>
    </div>
  </div>
  <bR />
  <div class="row">
    <div class = "col-lg-5 col-lg-offset-2"></div>
    <!-- Example single danger button -->
    <div class= "col-lg-4 col-lg-offset 4">
      <script>
        function modifyTitle(item)
        {
          var b = document.getElementById ("dropB");
          b.textContent = item.textContent;
          var x = document.getElementById("hid");
          x.value = locMap[item.textContent];
        }
      </script>
<div class="btn-group">
  <input type ="hidden" name = "location" id = "hid" value = "macd"/>
  <button type="button" id="dropB" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name = "location">
    MacDonough Hall
  </button>
  <div class="dropdown-menu" style="text-align:center;">
    <a class="dropdown-item" href="#" onclick="modifyTitle(this);">MacDonough Hall</a>
    <a class="dropdown-item" href="#" onclick="modifyTitle(this);">7th Wing Gym</a>
    <a class="dropdown-item" href="#" onclick="modifyTitle(this);">Barbershop</a>
    <div class="dropdown-divider" onclick="modifyTitle(this);"></div>
    <a class="dropdown-item" href="#" onclick="modifyTitle(this);">All</a>
  </div>
</div>
</div>
  </div>
    <hr>

    <div class='form-group' style='text-align:center;'>
      <button type='submit' class='btn btn-success'>Submit</button>
    </div>
  </form>
</div>

<div class='container'>
    <div id='err' style='text-algin:center;'></div>
</div>
<!-- Placeholder for Resubmit button -->
<div id="resubmitLoc"></div>
    <!-- Footer -->
    <footer class="py-5 bg-dark">
        <p class="m-0 text-center text-white">Copyright &copy; Life in a Building 2018-2019</p>
      <!-- /.container -->
    </footer>
  </div>
</div>
<script>
$('.clockpicker').clockpicker();

$(function(){
   $('.datepicker').datepicker({
      format: 'yyyy-mm-dd'
    });
});
</script>

  </body>

  <script>
var ctx = document.getElementById("canv");
myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["12:20", "12:30", "12:40", "12:50", "13:00", "13:10"],
        datasets: [{
            label: '# Detected Midshipman',
            data: [1, 6, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]

        },
        responsive: false

    }
});
</script>

</html>
