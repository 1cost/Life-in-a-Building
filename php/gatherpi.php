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
	$sec = substr($date,12,2);
	$arg = $year . "-" . $month . "-". $day . " " . $hr . ":" . $min . ":".$sec;
	$args =array($arg);
	$query = "INSERT IGNORE INTO Motion (date) VALUES (?)";
	$stmt = build_query($db, $query, $args);
	return "Success";
}

  $xml = file_get_contents("http://www.thistle-tech.com/piget.pl");
  echo parseDATE($xml, $db);

?>
