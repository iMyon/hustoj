<html>
<head>
<title>添加座位</title>
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
  $id = $_REQUEST["id"] ? $_REQUEST["id"] : -1;
  $sql = "select * from room order by room_id desc"; 
  $result=mysql_query($sql) or die(mysql_error());
  $exam_rooms = array();
  while($row = mysql_fetch_object($result)){
    $exam_rooms[] = $row;
  }
  // print_r($row->number);
  mysql_free_result($result);
?>
<div class="container">
<form class="form-horizontal" role="form" method="POST" action="seat_add.php">
   <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">教室</label>
      <div class="col-sm-10">
        <select name="room" id="room-select" onchange="setSeatTable()">
          <option value="-1">选择要添加的教室</option>
          <?php
          foreach($exam_rooms as $row){
          $flag = $row->room_id==$id?"selected":"";
          echo "<option value='$row->room_id' $flag>$row->name</option>";
          }?>
        </select>
      </div>
   </div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">座位</label>
      <div class="col-sm-10">
         <textarea name="seat" id="seats-taxterea" cols="30" rows="10" placeholder="填写教室座位号，每行输入一个座位"></textarea>
      </div>
   </div>
   <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
         <button type="submit" class="btn btn-default">添加</button>
      </div>
   </div>
</form>

<div>
  <div><label id="room-name-label"></label>教室座位号列表：</div>
    <table class="table table-striped table-hover table-bordered" id="statics">
    <thead>
      <tr>
        <!-- <th>座位id</th> -->
        <th>座位编号</th>
        <th>操作</th>
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
  setSeatTable();
</script>
</html>

