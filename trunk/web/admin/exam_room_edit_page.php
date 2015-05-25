<html>
<head>
<title>修改考场</title>
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Content-Language" content="zh-cn">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/exam_room.js"></script>
</head>
<body leftmargin="30" >

<?php require_once("../include/db_info.inc.php");?>
<?php require_once("admin-header.php");
if (!(isset($_SESSION['administrator'])||isset($_SESSION['problem_editor']))){
  echo "<a href='../loginpage.php'>Please Login First!</a>";
  exit(1);
}
?>
<?php
  $room_id = $_REQUEST["id"];
  if($room_id){
    $sql = "SELECT * FROM room 
            WHERE `room_id`='$room_id'";
    $result=mysql_query($sql) or die(mysql_error());
    $exam_room=mysql_fetch_object($result);
  }
  else{
    echo "未指定考场";
  }
?>
<div class="container">
<form action="exam_room_edit.php" method="post">
  <div class="row">
    <div class="col-lg-5">
      <div class="input-group">
        <span class="input-group-addon">教室名称：</span>
        <input name="room_name" type="text" class="form-control" placeholder="填写教室的名称" aria-describedby="sizing-addon1" value="<?= $exam_room->name ?>">
      </div>
    </div>
    <div class="col-lg-6">
      <input name="room_id" type="hidden" value="<?= $exam_room->room_id ?>">
      <input class="btn btn-default" type="submit" value="修改">
    </div>
  </div>
</form>

</div>
<?php require_once("../oj-footer.php");?>
</body></html>