<?php
# ensure proper permissions are set for the file and the web server
# get contents of file
$file_lines = file('motion.txt');
foreach ($file_lines as $line) {
    echo $line."<br>";
}
# clear file
$fh = fopen( 'motion.txt', 'w' );
fclose($fh);
 ?>
