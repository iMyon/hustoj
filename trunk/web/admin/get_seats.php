<?php 
// if (!(isset($_SESSION['administrator']))){
//   echo "{error:403, seats:[]}";
//   exit(1);
// }
require_once ("../include/db_info.inc.php");

$room = $_REQUEST["room"];
if($room && $room > 0){
  $sql = "select seat.* from room,seat
          where room.room_id='$room'
          and room.room_id=seat.room_id
          order by number"; 
  $result=mysql_query($sql) or die(mysql_error());
  $seats = array();
  $seats["error"] = 0;
  $seats["seats"] = array();
  while($row = mysql_fetch_object($result)){
    $seats["seats"][$row->seat_id] = $row->number;
  }
  die(json_encode($seats));
  // print_r($row->number);
  mysql_free_result($result);
  header("location: seat_add_page.php?id=$room");
  exit;
}
else{
  echo '{"error":-1,"seats":{}}';
}
?>