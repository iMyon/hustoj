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
$room = $_POST["room"];
$seat = $_POST["seat"];
if($seat && $room && $room > 0){
  $seats = preg_replace('/^\\s*$\n/m', '',$seat);
  // @die('<textarea name="" id="" cols="30" rows="10">'.$seats.'</textarea>');
  $seats = explode("\n", $seats);
  $insert_string = "";
  foreach ($seats as $key => $name) {
    $insert_string .="('$room','$name')";
    if ($key<count($seats)-1)
      $insert_string.=",";
  }
  $sql = "INSERT into `seat` (`room_id`,`number`)
          VALUES $insert_string";
  // @die($sql);
  @mysql_query ( $sql ) or die ( mysql_error () );
  header("location: seat_add_page.php?id=$room");
  exit;
}
else{
  echo "考场和座位不能为空";
}
?>