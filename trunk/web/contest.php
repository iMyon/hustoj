 <?php
	$OJ_CACHE_SHARE=!isset($_GET['cid']);
	require_once('./include/cache_start.php');
    require_once('./include/db_info.inc.php');
	require_once('./include/my_func.inc.php');
	require_once('./include/setlang.php');
	$view_title= $MSG_CONTEST;
  function formatTimeLength($length)
{
	$hour = 0;
	$minute = 0;
	$second = 0;
	$result = '';
	
	if ($length >= 60)
	{
		$second = $length % 60;
		if ($second > 0)
		{
			$result = $second . '秒';
		}
		$length = floor($length / 60);
		if ($length >= 60)
		{
			$minute = $length % 60;
			if ($minute == 0)
			{
				if ($result != '')
				{
					$result = '0分' . $result;
				}
			}
			else
			{
				$result = $minute . '分' . $result;
			}
			$length = floor($length / 60);
			if ($length >= 24)
			{
				$hour = $length % 24;
				if ($hour == 0)
				{
					if ($result != '')
					{
						$result = '0小时' . $result;
					}
				}
				else
				{
					$result = $hour . '小时' . $result;
				}
				$length = floor($length / 24);
				$result = $length . '天' . $result;
			}
			else
			{
				$result = $length . '小时' . $result;
			}
		}
		else
		{
			$result = $length . '分' . $result;
		}
	}
	else
	{
		$result = $length . '秒';
	}
	return $result;
}
function assign_pros($user_id){
  if (isset($user_id) && isset($_GET['cid'])) {
    $cid = $_GET['cid'];
    $sql = "SELECT count(*) FROM `con_pro_user` where user_id='$user_id'";
    $row = mysql_fetch_array( mysql_query($sql) );
    //如果没有分配题目的话
    if(!$row[0]){
      $sql = "SELECT `pro_amount` from `contest` where contest_id='$cid'";
      $row_contest = mysql_fetch_array( mysql_query($sql) );
      if($row_contest && $row_contest[0]){
        $pro_amount = $row_contest[0];
        $sql = "SELECT * from `contest_problem` where contest_id='$cid' ORDER BY rand() LIMIT $pro_amount";
        $re = mysql_query($sql);
        while($row_problem = mysql_fetch_array($re)){
          //插入数据（分配题目）
          $sql = "INSERT INTO `con_pro_user` (`problem_id`, `user_id`) VALUES ($row_problem[0], '$user_id')";
          mysql_query($sql);
        }
      }
    }
  }
}
assign_pros($_SESSION["user_id"]);

	if (isset($_GET['cid'])){
			$cid=intval($_GET['cid']);
			$view_cid=$cid;
		//	print $cid;
			
			
			// check contest valid
			$sql="SELECT * FROM `contest` WHERE `contest_id`='$cid' ";
			$result=mysql_query($sql);
			$rows_cnt=mysql_num_rows($result);
			$contest_ok=true;
		        $password="";	
		        if(isset($_POST['password'])) $password=$_POST['password'];
			if (get_magic_quotes_gpc ()) {
			        $password = stripslashes ( $password);
			}
			if ($rows_cnt==0){
				mysql_free_result($result);
				$view_title= "比赛已经关闭!";
				
			}else{
				$row=mysql_fetch_object($result);
				$view_private=$row->private;
				if($password!=""&&$password==$row->password) $_SESSION['c'.$cid]=true;
				if ($row->private && !isset($_SESSION['c'.$cid])) $contest_ok=false;
				if ($row->defunct=='Y') $contest_ok=false;
				if (isset($_SESSION['administrator'])) $contest_ok=true;
									
				$now=time();
				$start_time=strtotime($row->start_time);
				$end_time=strtotime($row->end_time);
				$view_description=$row->description;
				$view_title= $row->title;
				$view_start_time=$row->start_time;
				$view_end_time=$row->end_time;
				
				
				
				if (!isset($_SESSION['administrator']) && $now<$start_time){
					$view_errors=  "<h2>$MSG_PRIVATE_WARNING</h2>";
					require("template/".$OJ_TEMPLATE."/error.php");
					exit(0);
				}
			}
			if (!$contest_ok){
            			 $view_errors=  "<h2>$MSG_PRIVATE_WARNING <br><a href=contestrank.php?cid=$cid>$MSG_WATCH_RANK</a></h2>";
            			 $view_errors.=  "<form method=post action='contest.php?cid=$cid'>$MSG_CONTEST $MSG_PASSWORD:<input class=input-mini type=password name=password><input class=btn type=submit></form>";
				require("template/".$OJ_TEMPLATE."/error.php");
				exit(0);
			}
      $user_id = $_SESSION["user_id"];

			$sql="select * from (SELECT `problem`.`title` as `title`,`problem`.`problem_id` as `pid`,source as source,contest_problem.num as pnum

		FROM `contest_problem`,`problem`,`con_pro_user`

		WHERE `contest_problem`.`problem_id`=`problem`.`problem_id` 

    AND `contest_problem`.problem_id=`con_pro_user`.problem_id

    AND `con_pro_user`.user_id='$user_id'

		AND `contest_problem`.`contest_id`=$cid ORDER BY `contest_problem`.`num` 
                ) problem
                left join (select problem_id pid1,count(1) accepted from solution where result=4 and contest_id=$cid group by pid1) p1 on problem.pid=p1.pid1
                left join (select problem_id pid2,count(1) submit from solution where contest_id=$cid  group by pid2) p2 on problem.pid=p2.pid2
		order by pnum
                
                ";//AND `problem`.`defunct`='N'

		
			$result=mysql_query($sql);
			$view_problemset=Array();
			
			$cnt=0;
			while ($row=mysql_fetch_object($result)){
				
				$view_problemset[$cnt][0]="";
				if (isset($_SESSION['user_id'])) 
					$view_problemset[$cnt][0]=check_ac($cid,$cnt);
				$view_problemset[$cnt][1]= "$row->pid Problem &nbsp;".(chr($cnt+ord('A')));
				$view_problemset[$cnt][2]= "<a href='problem.php?cid=$cid&pid=$row->pnum'>$row->title</a>";
				$view_problemset[$cnt][3]=$row->source ;
				$view_problemset[$cnt][4]=$row->accepted ;
				$view_problemset[$cnt][5]=$row->submit ;
				$cnt++;
			}
		
			mysql_free_result($result);

}else{
  $keyword="";
  if(isset($_POST['keyword'])){
      $keyword=mysql_real_escape_string($_POST['keyword']);
  }
  //echo "$keyword";
  $sql="SELECT * FROM `contest` WHERE `defunct`='N' ORDER BY `contest_id` DESC limit 1000";
  $sql="select *  from contest left join (select * from privilege where rightstr like 'm%') p on concat('m',contest_id)=rightstr where contest.defunct='N' and contest.title like '%$keyword%'  order by contest_id desc limit 1000;";
			$result=mysql_query($sql);
			
			$view_contest=Array();
			$i=0;
			while ($row=mysql_fetch_object($result)){
				
				$view_contest[$i][0]= $row->contest_id;
				$view_contest[$i][1]= "<a href='contest.php?cid=$row->contest_id'>$row->title</a>";
				$start_time=strtotime($row->start_time);
				$end_time=strtotime($row->end_time);
				$now=time();
                                
                                
        $length=$end_time-$start_time;
        $left=$end_time-$now;
	// past

  if ($now>$end_time) {
  	$view_contest[$i][2]= "<span class=green>$MSG_Ended@$row->end_time</span>";
	
	// pending

  }else if ($now<$start_time){
  	$view_contest[$i][2]= "<span class=blue>$MSG_Start@$row->start_time</span>&nbsp;";
    $view_contest[$i][2].= "<span class=green>$MSG_TotalTime".formatTimeLength($length)."</span>";
	// running

  }else{
  	$view_contest[$i][2]= "<span class=red> $MSG_Running</font>&nbsp;";
    $view_contest[$i][2].= "<span class=green> $MSG_LeftTime ".formatTimeLength($left)." </span>";
  }
                                
                                
                                
                                
				
				$private=intval($row->private);
				if ($private==0)
                                        $view_contest[$i][4]= "<span class=blue>$MSG_Public</span>";
                                else
                                        $view_contest[$i][5]= "<span class=red>$MSG_Private</span>";
				$view_contest[$i][6]=$row->user_id;


			
				$i++;
			}
			
			mysql_free_result($result);

}


/////////////////////////Template
if(isset($_GET['cid']))
	require("template/".$OJ_TEMPLATE."/contest.php");
else
	require("template/".$OJ_TEMPLATE."/contestset.php");
/////////////////////////Common foot
if(file_exists('./include/cache_end.php'))
	require_once('./include/cache_end.php');
?>
