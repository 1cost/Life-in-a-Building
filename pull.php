
  <?php
  if (!defined('WEB_PATH')) { define('WEB_PATH', 'http://midn.cs.usna.edu/~m195466/IT452/Error_Visualization/web/');}
  require_once("scripts/mysql.inc.php");
  require_once("php/functions.php");
  $db = new myConnectDB();

  if (mysqli_connect_errno()) {
  echo "<h5>ERROR: " . mysqli_connect_errno() . ": " . mysqli_connect_error() . " </h5><br>";
  }
  $stmt;
  $start = $_POST["start_date"]." ".$_POST["start_time"]."00";
  $end = $_POST["end_date"]." ".$_POST["end_time"]."00";
  $args = array($start, $end);
  $query = "SELECT * FROM CameraData WHERE date >= ? AND date <= ?";
  if($_POST["location"] != "*")
  {
    $query = $query." AND location = ?";
    array_push($args,$_POST["location"]);
  }
  if($_POST["typeid"] != "*")
  {
    $query = $query." AND object = ?";
    array_push($args,$_POST["typeid"]);
  }

  $stmt = build_query($db, $query, $args);

  $resArr = stmt_to_assoc_array($stmt);
  $build = [];
  foreach($resArr as $key => $arr)
  {
    $build[] = $arr;
  }
  if(sizeof($build) < 1)
  {
    $build[] = -1;
  }

  echo json_encode($build);
?>
