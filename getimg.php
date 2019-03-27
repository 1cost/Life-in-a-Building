<html>
<?php
  $file_path = $file_path.basename( $_FILES['file']['name']);
  move_uploaded_file($_FILES['file']['name'],"/imgs/".$file_path);
?>
</html>
