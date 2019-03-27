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
    <script src="tables/dt.js"></script>


    <title>Annotation Feed</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="datepicker/bootstrap-datepicker.css" rel="stylesheet">
    <link href="css/page_wrapper.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="timepicker/bootstrap-clockpicker.min.css">
    <link rel="stylesheet" href="tables/dt.css">

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
            <li class="nav-item">
              <a class="nav-link" href="dat.php">Data Management</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="imgs.php">Live Annotations</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  <!-- End Navigation -->

  <br>
  <div class="container" style = "text-align:center;">
    <h1> Live Annotations on Live Feeds </h1>
  </div>
  <hr>
  <div class="page-wrapper">
    <div class="row">
      <div class="col-lg-4 col-md-offset-2">
        <iframe src="" width="100%" height="350" id='frame_one_if'></iframe>
      </div>
      <div class="col-lg-4 col-md-offset-2">
        <iframe src="" width="100%" height="350" id='frame_two_if'></iframe>
      </div>
      <div class="col-lg-4 col-md-offset-2">
        <iframe src="" width="100%" height="350" id='frame_three_if'></iframe>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4 col-md-offset-2">
        <img src="imgs/annot/pic0.jpg" width="100%" height="350" id="macd">
      </div>
      <div class="col-lg-4 col-md-offset-2">
        <img src="imgs/annot/pic1.jpg" width="100%" height="350" id="barbershop">
      </div>
      <div class="col-lg-4 col-md-offset-2">
        <img src="imgs/annot/pic2.jpg" width="100%" height="350" id="7th">
      </div>
    </div>
  </div>

  <script type="text/javascript">
      function getIP(camera, element) {
        var data = new FormData();
        data.append('ipaddr', camera);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            var ipaddr = xhttp.responseText;
            var butter = document.getElementById(element);
            butter.src = "http://"+(ipaddr.toString()).trim()+"/#view";
          }
        };
        xhttp.open("POST", "scripts/getip.php", true);
        xhttp.send(data);
        return false;
      }

    setInterval(function(){
      var seventh = document.getElementById("7th");
      seventh.src = "imgs/annot/pic2.jpg?rand=" + Math.random();

      var barbershop = document.getElementById("barbershop");
      barbershop.src = "imgs/annot/pic1.jpg?rand=" + Math.random();

      var macd = document.getElementById("macd");
      macd.src = "imgs/annot/pic0.jpg?rand=" + Math.random();

    },1000);
    getIP('MacDonough Gym 1', 'frame_one_if')
    getIP('Barbershop', 'frame_two_if');
    getIP('7th Wing Gym', 'frame_three_if')
  </script>


  </body>

  <footer class="py-5 bg-dark">
      <p class="m-0 text-center text-white">Copyright &copy; Life in a Building 2018-2019</p>
    <!-- /.container -->
  </footer>

</html>
