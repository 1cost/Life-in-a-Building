  <?php
  require_once("../scripts/mysql.inc.php");
  require_once("functions.php");
  $db = new myConnectDB();

  if (mysqli_connect_errno()) {
  echo "<h5>ERROR: " . mysqli_connect_errno() . ": " . mysqli_connect_error() . " </h5><br>";
  }
  $query = "SELECT IpAddress FROM IpAddresses WHERE FeedName = ?";
  $stmt = build_query($db, $query, array($_POST['ipaddr']));
  $resArr = stmt_to_assoc_array($stmt);
  foreach($resArr as $key => $arr)
  {
    echo $arr["IpAddress"];
  }
?>
