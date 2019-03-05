<?php
# get contents of file
$file_lines = file('motion.txt');
foreach ($file_lines as $line) {
    echo $line;
}

# clear file
$fh = fopen( 'filelist.txt', 'w' );
fclose($fh);

 ?>
