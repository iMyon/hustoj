<?php require_once ("admin-header.php");
if (!(isset($_SESSION['administrator'])||isset($_SESSION['problem_editor']))){
  echo "<a href='../loginpage.php'>Please Login First!</a>";
  exit(1);
}
?>
<?php require_once ("../include/db_info.inc.php");
?>
<?php // contest_id
$room_name = $_POST["room_name"];
$room_id = $_POST["room_id"];
if($room_name){
  $sql = "UPDATE `room`
          SET `name`='$room_name'
          WHERE `room_id`='$room_id'";
  @mysql_query ( $sql ) or die ( mysql_error () );
  header("location: exam_room_add_page.php");
  exit;
}
else{
  echo "考场名称不能为空";
}
?>