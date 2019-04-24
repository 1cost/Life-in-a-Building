
<html>

<?php

  foreach($_POST as $filename => $raw_contents)
  {
    file_put_contents("../../images/annot/".$filename.".jpg", $raw_contents);
    echo "Successfully received $filename";
  }

?>
</html>
