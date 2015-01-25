<?php require_once ("admin-header.php");
require_once("../include/my_func.inc.php");
require_once("../include/check_post_key.php");
require_once("../include/PHPExcel.php");
if (!(isset($_SESSION['administrator']))){
  echo "<a href='../loginpage.php'>Please Login First!</a>";
  exit(1);
}
?>
Import Free Problem Set ... <br>

<?php
function getValue($Node, $TagName) {

  return $Node->$TagName;
}
function hasUser($user_id){
  require("../include/db_info.inc.php");
  $sql="select 1 from users where user_id='$user_id'";  
  $result=mysql_query ( $sql );
  $rows_cnt=mysql_num_rows($result);		
  mysql_free_result($result);
  //echo "row->$rows_cnt";			
  return  ($rows_cnt>0);

}

if ($_FILES ["fps"] ["error"] > 0) {
  echo "Error: " . $_FILES ["fps"] ["error"] . "File size is too big, change in PHP.ini<br />";
} else {
  $tempfile = $_FILES ["fps"] ["tmp_name"];

  $objReader = PHPExcel_IOFactory::createReader('Excel2007' ); //创建一个2007的读取对象
  $objPHPExcel = $objReader->load ($tempfile);             //读取一个xlsx文件
  $sheet_count = $objPHPExcel->getSheetCount(); 
  $cell_values = array(); 
  for ($s = 0; $s < $sheet_count; $s++) 
  {
    $currentSheet = $objPHPExcel->getSheet($s);// 当前页 
    $row_num = $currentSheet->getHighestRow();// 当前页行数 
    $col_max = $currentSheet->getHighestColumn(); // 当前页最大列号 

    // 循环从第二行开始，第一行往往是表头 
    for($i = 1; $i <= $row_num; $i++) 
    { 
      //只遍历A B两列读取学号姓名
      $A = $currentSheet->getCell('A' . $i)->getValue();
      $B = $currentSheet->getCell('B' . $i)->getValue();
      if($A && $B)
        $cell_values[] = array("user_id" => $A, "nick" => $B);
    } 
  } 
  $suc = 0;
  $pass = 0;
  $err = 0;
  // 写入数据库 
  foreach($cell_values as $val)
  {
    $user_id = trim($val["user_id"]);
    $nick = trim($val["nick"]);
    //如果用户不存在则插入表
    if(!hasUser($user_id))
    {
      if(!($user_id && nick))
      {
        echo "学号或姓名为空";
        $err++;
        continue;
      }
      if(strlen($nick)>100)
      {
        echo "$user_id 用户名太长，不能超过100字符";
        $err++;
        continue;
      }
      if(!is_valid_user_name($user_id))
      {
        echo "$user_id 学号只能包含数字";
        $err++;
        continue;
      }
      //插入
      $password=pwGen($user_id);
      $school = "湖南大学";
      $sql="INSERT INTO `users`("
        ."`user_id`,`email`,`ip`,`accesstime`,`password`,`reg_time`,`nick`,`school`)"
        ."VALUES('".$user_id."','','".$_SERVER['REMOTE_ADDR']."',NOW(),'".$password."',NOW(),'".$nick."','".$school."')";
      mysql_query($sql);
      $suc++;
    }
    else{
      echo "$user_id 已存在<br>";
      $pass++;
    }
  }
  echo "导入结束， 插入$suc ，跳过$pass ，失败$err";
  //print_r($cell_values); 





  unlink ( $tempfile );
  if($spid>0){
    require_once("../include/set_get_key.php");
    echo "<br><a class=blue href=contest_add.php?spid=$spid&getkey=".$_SESSION['getkey'].">Use these problems to create a contest.</a>";
  }
}

?>
