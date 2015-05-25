<?php require_once ("admin-header.php");
// require_once("../include/check_post_key.php");
if (!(isset($_SESSION['administrator'])||isset($_SESSION['problem_editor']))){
  echo "<a href='../loginpage.php'>Please Login First!</a>";
  exit(1);
}
?>
<?php require_once ("../include/db_info.inc.php");
?>
<?php // contest_id
$room_name = $_POST["room_name"];
if($room_name){
  $room_names = explode("\n", $room_name);
  $insert_string = "";
  foreach ($room_names as $key => $name) {
    $insert_string .="('".$name."')";
    if ($key<count($room_names)-1)
      $insert_string.=",";
  }
  $sql = "INSERT into `room` (`name`)
          VALUES $insert_string";
  // @die($sql);
  @mysql_query ( $sql ) or die ( mysql_error () );
  header("location: exam_room_add_page.php");
  exit;
}
else{
  echo "考场名称不能为空";
}
?>