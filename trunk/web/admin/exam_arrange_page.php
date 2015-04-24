<html>
<head>
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Content-Language" content="zh-cn">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>考场安排</title>
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
  $sql = "select * from contest WHERE end_time > now( )"; 
  $result=mysql_query($sql) or die(mysql_error());
  $contest = array();
  while($row = mysql_fetch_object($result)){
    $contest[] = $row;
  }
  // print_r($row->number);
  mysql_free_result($result);

  $sql = "select * from room"; 
  $result=mysql_query($sql) or die(mysql_error());
  $room = array();
  while($row = mysql_fetch_object($result)){
    $room[] = $row;
  }
  // print_r($row->number);
  mysql_free_result($result);
?>
<div class="container">
<form action="exam_arrange.php" method="POST">
  选择考试：<select name="exam" id="exam-select" onchange="setArrangeSeatTable()">
    <option value="-1">请选择考试</option>
    <?php foreach ($contest as $row) {
      $selected=$_REQUEST["id"]==$row->contest_id?"selected":"";
      echo "<option value='$row->contest_id' $selected>$row->title</option>";
    }
    ?>
  </select>
  <br />
  选择教室：<select style="height: 220px;" multiple="multiple" name="exam_room[]">
    <?php foreach ($room as $row) {
      echo "<option value='$row->room_id' selected>$row->name</option>";
    }
    ?>
  </select>
  <br/><label>提示：按住ctrl或shift键可以多选</label>
  <br />
  <input type="submit" value="立即分配考场">
</form>
<div>
  <div><label id="room-name-label"></label>座位安排表：</div>
    <table class="table table-striped table-hover table-bordered" id="statics">
    <thead>
      <tr>
        <th>用户名</th>
        <th>考场</th>
        <th>座位号</th>
        <!-- <th>操作</th> -->
      </tr>
    </thead>
    <tbody id="seats-body">
      
    </tbody>
    
  </table>
</div>

</div>
<?php require_once("../oj-footer.php");?>
</body>
<script>
  setArrangeSeatTable();
</script>
</html>

