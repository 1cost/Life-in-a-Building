
  <?php
  if (!defined('WEB_PATH')) { define('WEB_PATH', 'http://midn.cs.usna.edu/~m195466/IT452/Error_Visualization/web/');}
  require_once("scripts/mysql.inc.php");
  require_once("functions.php");
  $db = new myConnectDB();

  if (mysqli_connect_errno()) {
  echo "<h5>ERROR: " . mysqli_connect_errno() . ": " . mysqli_connect_error() . " </h5><br>";
  }
  $query = "SELECT * FROM Test_Times WHERE Time >= ? AND Time <= ? ORDER BY Time ASC";
  $stmt = build_query($db, $query, array($_POST['start'], $_POST['end']));
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

