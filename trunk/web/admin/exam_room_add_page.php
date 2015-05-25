<html>
<head>
<title>添加考场</title>
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
  $page_count = 30;
  $pager = $_REQUEST["p"] ? $_REQUEST["p"] : 1;
  $pager = $pager>0 ? $pager-1 : 0;
  $limit_start = $page_count * $page;
  $sql = "select * from room order by room_id desc limit $limit_start,$page_count"; 
  $result=mysql_query($sql) or die(mysql_error());
  $exam_rooms = array();
  while($row = mysql_fetch_object($result)){
    $exam_rooms[] = $row;
  }
  // print_r($row->number);
  mysql_free_result($result);
?>
<div class="container">
<form action="exam_room_add.php" method="post">
  <div class="row" style="margin-top:10px;">
    <div class="col-lg-5">
      <div class="input-group">
        <lable>添加考场：</lable>
        <textarea type="text" name="room_name" rows="5" cols="25" style="width:464px;height:200px;" placeholder="每行填写一个考场"></textarea>
      </div>
    </div>
    <div class="col-lg-6">
      <!-- <input class="btn btn-default" type="submit" value="添加"> -->
    </div>
  </div>
  <input class="btn btn-default" type="submit" value="添加">
  <div style="margin-top:20px;">
    <div>考场列表：</div>
    <table class="table table-striped table-hover table-bordered" id="statics">
      <tr>
        <th>考场编号</th>
        <th>考场名称</th>
        <th>操作</th>
      </tr>
      <?php
        foreach($exam_rooms as $row){
        echo "<tr>
                <td>".$row->room_id."</td>
                <td>".$row->name."</td>
                <td>"."<a id='room_edit' href='exam_room_edit_page.php?id=$row->room_id'>编辑</a><a id='room_delete' href='#' onclick='delete_room($row->room_id)' style='margin-left:10px;'>删除</a>"."</td>
              </tr>";
      }?>
    </table>
  </div>
</form>

</div>
<?php require_once("../oj-footer.php");?>
</body></html>

