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
$room = $_POST["exam_room"];
$exam = $_POST["exam"];
if($room && $exam && $exam>0){
  $cexam = "c".$exam;
  $sql = "SELECT user_id FROM `privilege` WHERE rightstr='$cexam' 
          AND user_id NOT IN 
          (SELECT user_id FROM `exam_arrange` WHERE contest_id='$exam')";
  // @die($sql);
  $result=mysql_query($sql) or die(mysql_error());
  $users = array();
  while($row = mysql_fetch_object($result)){
    $users[] = $row->user_id;
  }
  // print_r($row->number);
  mysql_free_result($result);

  //应该考虑不同考试的座位冲突，根据时间段查出可用的座位
  $arr_string = join(',', $room);
  $sql = "SELECT seat_id FROM `seat` WHERE room_id IN ($arr_string)
          AND seat_id NOT IN 
          (SELECT seat_id FROM `exam_arrange` WHERE contest_id='$exam')";
  // @die($sql);
  $result=mysql_query($sql) or die(mysql_error());
  $seats = array();
  while($row = mysql_fetch_object($result)){
    $seats[] = $row->seat_id;
  }
  // print_r($row->number);
  mysql_free_result($result);

  // 开始分配考场
  $values = "";
  // print_r(count($seats));
  $is_enough = count($users)<=count($seats)?true:false; //座位是否足够
  for($i=0;$i<count($users) && $i<count($seats);$i++){
    // @die("999");
    $user=$users[$i]; $seat = $seats[$i];
    $values = $values."('$exam','$user','$seat')";
    if($i<count($users)-1 && $i<count($seats)-1)
      $values = $values.",";
  }
  // @die($values);
  if($values){
    $sql = "INSERT INTO exam_arrange (contest_id,user_id,seat_id) values $values";
    // @die($sql);
    @mysql_query ( $sql ) or die ( mysql_error () );
  }
  //如果考场座位不够则提示
  if(!is_enough){
    echo "考场座位不够，请增加要分配的教室<a href='exam_arrange_page.php?id=$exam'>点击跳转到分配考场页面</a>";
  }
  

  header("location: exam_arrange_page.php?id=$exam");
  exit;
}
else{
  echo "还没有选择考场或考试<a href='exam_arrange_page.php'>点击跳转到分配考场页面</a>";
}
?>