<?php 
class myConnectDB extends mysqli{
    public function __construct($hostname="localhost",
        $user="patternsoflife",
        $password="JonIsBETA",
        $dbname="patternsoflife") {
      parent::__construct($hostname, $user, $password, $dbname);
  	}
}
?>