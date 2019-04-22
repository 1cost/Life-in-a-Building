<?php
  require_once("../scripts/mysql.inc.php");
  require_once("functions.php");
  $db = new myConnectDB();
function parseDATE($date, $db)
{
	$year = substr($date, 0, 4);
	$month = substr($date, 4, 2);
	$day = substr($date,6,2);
	$hr = substr($date,8,2);
	$min = substr($date,10,2);

	$query = "INSERT INTO MotionData (date) VALUES (?)";
	$arg = $year . "-" . $month . "-". $day . " " . $hr . ":" . $min . ":00";
  echo $arg;
	$args = array($arg);
	$stmt = build_query($db, $query, $args);
}
while(true)
{
  $xml = file_get_contents("http://www.thistle-tech.com/piget.pl");
  parseDATE($xml, $db);
  sleep(10);
}

?>
