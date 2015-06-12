<?php
$cache_time=30;
$OJ_CACHE_SHARE=false;
	$debug = true;
	require_once('./include/cache_start.php');
    require_once('./include/db_info.inc.php');
	require_once('./include/setlang.php');
	require_once('./include/online.php');
	$on = new online();
	$view_title= "Welcome To Online Judge";
	require_once('./include/iplocation.php');
	$users = $on->getAll();
	$ip = new IpLocation();
?>



<?php 
$view_online=Array();

$time_interval = $OJ_ONLINE_TIME_INTERVAL;		//设置在db_info_inc.php


function online()
{
	$self = explode("/",$_SERVER["HTTP_REFERER"]);
	$url= $self[count($self)-1];  //这两行为获取URL
	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR']; 	//先取x-forward，不然反向代理之后会显示内网ip
	$time_stamp =date("Y-m-d H:i:s");
	$uid = $_SESSION["user_id"];
	if($res = mysql_query("SELECT * FROM online WHERE `user_id`='$uid'"));
	if($uid) //检测用户是否登录
	{
	 $res = mysql_query("SELECT COUNT(*) FROM `online` WHERE `user_id`='$uid'");   //
	  $myrow = mysql_fetch_array($res);
	 if($myrow[0]!=="0")  //判断该用户的在线记录是否已被删除（针对超过三分钟刷新的情况）
	 {
	  mysql_query("UPDATE `online` SET `user_id`='$uid',`update_time_stamp`='$time_stamp',`ip`='$ip',`url`='$url' WHERE `user_id`='$uid'")or die(mysql_error()); //如果存在记录则更新时间
	 }
	 else
	 {
	  mysql_query("INSERT INTO online (user_id,update_time_stamp,ip,url) VALUES ('$uid','$time_stamp','$ip','$url')")or die(mysql_error());   //如果不存在记录则插入该记录
	 }
	}
}

// echo "afdasfasddddddddddddddd";
online();

		
if (isset($_SESSION['administrator'])){

		
		// if(isset($_GET['search'])){

		// 	$sql="SELECT * FROM `loginlog`";
		// 	$search=trim(mysql_real_escape_string($_GET['search']));
		// 	if ($search!='')
		// 		$sql=$sql." WHERE ip like '%$search%' ";
		// 	 else
		// 		$sql=$sql." where user_id<>'".$_SESSION['user_id']."' ";
		// 	$sql=$sql."  order by `time` desc LIMIT 0,50";

		// $result=mysql_query($sql) or die(mysql_error());
		// $i=0;
	
		// for (;$row=mysql_fetch_row($result);){
				
		// 		$view_online[$i][0]= "<a href='userinfo.php?user=".$row[0]."'>".$row[0]."</a>";
		// 		$view_online[$i][1]=$row[1];
		// 		$view_online[$i][2]=$row[2];
		// 		$view_online[$i][3]=$row[3];
				
		// 		$i++;
		// }
	
		// mysql_free_result($result);
		// }


}
/////////////////////////Template
// require("template/".$OJ_TEMPLATE."/online.php");
/////////////////////////Common foot
// if(file_exists('./include/cache_end.php'))
// 	require_once('./include/cache_end.php');
?>
