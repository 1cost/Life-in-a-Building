
  <?php
  if (!defined('WEB_PATH')) { define('WEB_PATH', 'http://midn.cs.usna.edu/~m195466/IT452/Error_Visualization/web/');}
  require_once("../scripts/mysql.inc.php");
  require_once("functions.php");
  $db = new myConnectDB();

  if (mysqli_connect_errno()) {
  echo "<h5>ERROR: " . mysqli_connect_errno() . ": " . mysqli_connect_error() . " </h5><br>";
  }
  $first = getCameraSide($_POST["start_date"], "00:00:00", "06:00:00", $db);
  $second = getCameraSide($_POST["start_date"], "06:00:01", "12:00:00", $db);
  $third = getCameraSide($_POST["start_date"], "12:00:01", "18:00:00", $db);
  $fourth = getCameraSide($_POST["start_date"], "18:00:01", "23:59:59", $db);
  $build = [];
  if($first < 1 && $second < 1 && $third < 1 && $fourth < 1)
  {
    $build[] = -1;
  }

  $build["left"] = array($first,$second,$third,$fourth);

  $first = getMotionSide($_POST["start_date"], "00:00:00", "06:00:00", $db);
  $second = getMotionSide($_POST["start_date"], "06:00:01", "12:00:00", $db);
  $third = getMotionSide($_POST["start_date"], "12:00:01", "18:00:00", $db);
  $fourth = getMotionSide($_POST["start_date"], "18:00:01", "23:59:59", $db);

  $build["right"] = array($first,$second,$third,$fourth);

  function getCameraSide($date, $startT, $endT, $db)
  {
    $start = $date. " ". $startT;  
    $end = $date. " ".$endT;
    $args = array($start, $end);
    $query = "SELECT SUM(count) as sum FROM CameraData WHERE date >= ? AND date <= ? AND location = 'barb'";
    $stmt = build_query($db, $query, $args);

    $resArr = stmt_to_assoc_array($stmt);
    if($resArr[0]["sum"] == "")
    {
      return 0;
    }
    return $resArr[0]["sum"];
  }

  function getMotionSide($date, $startT, $endT, $db)
  {
    $start = $date. " ". $startT;  
    $end = $date. " ".$endT;
    $args = array($start, $end);
    $query = "SELECT COUNT(*) as sum FROM MotionData WHERE date >= ? AND date <= ?";
    $stmt = build_query($db, $query, $args);

    $resArr = stmt_to_assoc_array($stmt);
    if($resArr[0]["sum"] == "")
    {
      return 0;
    }
    return $resArr[0]["sum"];
  }

  echo json_encode($build);
?>
