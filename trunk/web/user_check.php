<?php
  require_once("include/db_info.inc.php");
  $sql = "select * from users"; 
  $result=mysql_query($sql) or die(mysql_error());
  $users = array();
  while($row = mysql_fetch_object($result)){
    $users[] = $row;
  }
  // print_r($row->number);
  $user = $_REQUEST["user"];
  foreach ($users as $row) {
    if($row->user_id == $user)
      {
        echo "1";
        exit();
      }
  }
  mysql_free_result($result);
  echo "-1";
?>