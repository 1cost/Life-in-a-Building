<html>

<?php
 $myfile = fopen("testfile.txt", "w");
 fwrite($myfile,print_r($_FILES));
?>
</html>
