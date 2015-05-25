<html>
<head>
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Content-Language" content="zh-cn">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>在线状态</title>
<script type="text/javascript" src="js/jquery.min.js"></script>
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
  $time_interval = $OJ_ONLINE_TIME_INTERVAL;    //设置在db_info_inc.php
  $sql = "select * from online WHERE now() - `update_time_stamp` < $OJ_ONLINE_TIME_INTERVAL"; 
  $result=mysql_query($sql) or die(mysql_error());
  $online = array();
  while($row = mysql_fetch_object($result)){
    $online[] = $row;
  }
  // print_r($row->number);
  mysql_free_result($result);
  // print_r($online);
?>
<div class="container">
  <div>
    <div><label id="room-name-label"></label>用户在线状态：</div>
      <table class="table table-striped table-hover table-bordered" id="statics">
      <thead>
        <tr>
          <th>用户名</th>
          <th>ip</th>
          <th>所在页面</th>
          <!-- <th>操作</th> -->
          <!-- <th>操作</th> -->
        </tr>
      </thead>
      <tbody id="seats-body">
        <?php foreach ($online as $row) {
          // echo "dafsssssssssssssssss";
          echo "<tr>
            <td>".$row->user_id."</td>
            <td>".$row->ip."</td>
            <td>/".$row->url."</td>
          </tr>";
          }
        ?>
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

