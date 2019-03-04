<!DOCTYPE html>
<html lang="en">

  <head>
    <script>
    var cams = ["7th Wing Gym",
                    "MacDonough Gym 1",
                    "Barbershop"];
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <script type="text/JavaScript" src ="js/functions.js"></script>
    <script src ="js/Chart.js/chart.min.js"></script>

    <title>Live feeds</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

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
            <li class="nav-item active">
              <a class="nav-link" href="#">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
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

          <script>
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

      function changeFrame(title, frame)
      {
        if(!cams.includes(title))
        {
          return;
        }
        var butter = document.getElementById(frame);
        butter.innerHTML = title;
        frame += "_if";
        getIP(title, frame);
      }
      </script>

    <!-- Page Content -->
    <div class="container">

      <!-- Page Heading -->
      <h1 class="my-4">Life in a Building
        <small>Manage Feed</small>
      </h1>

      <hr />

      <!-- Project One -->
      <div class="container" style="text-align:center;">
      <div class="row">
        <div class="col-md-6">
          <a href=#><iframe src="" width="75%" height="350" id='frame_one_if'></iframe></a>
          <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="frame_one" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            MacDonough Gym
            </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <a class="dropdown-item" href="#" onclick="changeFrame('7th Wing Gym', 'frame_one')">7th Wing Gym</a>
      <a class="dropdown-item" href="#" onclick="changeFrame('MacDonough Gym 1', 'frame_one')">MacDonough Gym</a>
      <a class="dropdown-item" href="#" onclick="changeFrame('Barbershop', 'frame_one')">Barbershop</a>
    </div>
          </div>
                </div>
<div class="col-md-6">
  <a href=#><iframe src ="" width="75%" height="350" id='frame_two_if'></iframe></a>
  <script>
    getIP('MacDonough Gym 1', 'frame_one_if')
    getIP('Barbershop', 'frame_two_if');
  </script>
  <div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" id="frame_two" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Barbershop
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <a class="dropdown-item" href="#" onclick="changeFrame('7th Wing Gym', 'frame_two')">7th Wing Gym</a>
      <a class="dropdown-item" href="#" onclick="changeFrame('MacDonough Gym 1', 'frame_two')">MacDonough Gym</a>
      <a class="dropdown-item" href="#" onclick="changeFrame('Barbershop', 'frame_two')">Barbershop</a>
    </div>
  </div>
        </div>
      </div>
  </div>
  <br>
  <hr>

      <!-- /.row -->

      <!-- AVAILABLE FOR EASY EXTENSION -->
      <div class="row">
        <div class="col-md-10" style="display:inline-block">
            <canvas id="line-chart" width="800" height="450" style="text-align:center;"></canvas>
        </div>
      </div>
          <script type="text/javascript">
            new Chart(document.getElementById("line-chart"), {
  type: 'line',
  data: {
    labels: [5,10,15,20,25,30],
    datasets: [{
        data: [0,0,10,25,20,19,18,25,24,23,12,21],
        label: "Mac D",
        borderColor: "#3e95cd",
        fill: false
      }, {
        data: [2,5,7,1,2,5,6,10,19,20,18,18],
        label: "Barbershop",
        borderColor: "#8e5ea2",
        fill: false
      }, {
        data: [10,9,4,5,6,7,8,11,3,5,3,9],
        label: "7th Wing",
        borderColor: "#3cba9f",
        fill: false
      }
    ]
  },
  options: {
    title: {
      display: true,
      text: 'Trends of Persons per Space'
    },
    layout: {
      padding: {
          left: 200,
          right: 0,
          top: 0,
          bottom: 0
      }
    }
  }
});
          </script>
      <!-- /.row -->

      <!-- Pagination: Implement when more pages needed (if)
      <ul class="pagination justify-content-center">
        <li class="page-item">
          <a class="page-link" href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#">1</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#">2</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#">3</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>
      </ul>
    -->
    <!-- /.container -->
    <br> <!-- used for cleanliness -->
    <!-- Footer -->
    <footer class="py-5 bg-dark">
        <p class="m-0 text-center text-white">Copyright &copy; Life in a Building 2018-2019</p>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
