<?php 
// if (!(isset($_SESSION['administrator']))){
//   echo "{error:403, seats:[]}";
//   exit(1);
// }
require_once ("../include/db_info.inc.php");

$id = $_REQUEST["id"];
if($id && $id > 0){
  $sql = "select * from exam_arrange,seat,contest,room
          where exam_arrange.seat_id=seat.seat_id
          AND seat.room_id=room.room_id
          AND exam_arrange.contest_id=contest.contest_id
          AND contest.contest_id='$id'
          GROUP BY exam_arrange.user_id"; 
  $result=mysql_query($sql) or die(mysql_error());
  $seats = array();
  $seats["error"] = 0;
  $seats["arrange"] = array();
  while($row = mysql_fetch_object($result)){
    $seats["arrange"][] = $row;
  }
  @die(json_encode($seats));
  // print_r($row->number);
  mysql_free_result($result);
  header("location: exam_arrange_page.php?id=$id");
  exit;
}
else{
  echo '{"error":-1,"seats":{}}';
}
?>