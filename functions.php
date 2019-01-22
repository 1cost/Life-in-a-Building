<?php
function build_query($db, $query, $bind_fields=array()) {

  # Determine the bind types of variables, and build the string
  $bind_string = '';
  foreach ($bind_fields as $bf) {
    $bind_string .= 's';
  }

  # Build the parameter array
  $mysql_bind_string = array();
  $mysql_bind_string[] = & $bind_string;
  for ($i = 0; $i < count($bind_fields); $i++) {
    $mysql_bind_string[] = & $bind_fields[$i];
  }

  # Initialize a new DB query
  $stmt = $db->stmt_init();
  # Build MySQL PREPARED statement
  $stmt->prepare($query);

  # Bind the fields to the query
  if ($bind_string != '') {
    $result = call_user_func_array(array($stmt, 'bind_param'), $mysql_bind_string);
  }

  # Execute MySQL PREPARE statement
  $result = $stmt->execute();

  # Return the SQL $stmt object.
  return $stmt;
}

  function stmt_to_assoc_array($stmt) {
    # Retrieve associated metadata
    $meta = $stmt->result_metadata();

    # Determine column Names
    while ($field = $meta->fetch_field()) {
      $params[] = &$row[$field->name];
    }

    # Build variables into which data will be placed
    call_user_func_array(array($stmt, 'bind_result'), $params);

    # Retrieve a row of data
    while ($stmt->fetch()) {
      # Retrieve a single column->value pair
      foreach($row as $key => $val) {
        $c[$key] = $val;
      }
      $results[] = $c;
    }

    # If there were no results, then just return an empty array
    if (!isset($results)) {
      return array();
    }

    # Return results
    return $results;
  }
  ?>