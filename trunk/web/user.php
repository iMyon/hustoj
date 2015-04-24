<?php
 $cache_time=10; 
 $OJ_CACHE_SHARE=false;
	require_once('./include/cache_start.php');
    require_once('./include/db_info.inc.php');
	require_once('./include/setlang.php');
	require_once("./include/const.inc.php");
	require_once("./include/my_func.inc.php");
 // check user


$user=$_SESSION["user_id"];
if (!is_valid_user_name($user)){
	echo "用户名不存在！";
	exit(0);
}
$view_title=$user ."@".$OJ_NAME;

$user_mysql=mysql_real_escape_string($user);
$sql="SELECT `school`,`email`,`nick` FROM `users` WHERE `user_id`='$user_mysql'";
$result=mysql_query($sql);
$row_cnt=mysql_num_rows($result);
if ($row_cnt==0){ 
  $view_errors= "用户名不存在！";
  require("template/".$OJ_TEMPLATE."/error.php");
  exit(0);
}


$action = $_GET["act"];
//考试安排
if($action == "exam"){
  $sql = "SELECT number, start_time, end_time, room.name AS room, contest.title AS title
          FROM contest, seat, room, exam_arrange
          WHERE room.room_id = seat.room_id
          AND exam_arrange.seat_id = seat.seat_id
          AND contest.contest_id = exam_arrange.contest_id
          AND exam_arrange.user_id = '$user'
          AND exam_arrange.contest_id in (
          SELECT contest_id
          FROM `contest`
          WHERE end_time > now( ) )";
  $result=mysql_query($sql) or die(mysql_error());
  $exam_arrange = array();
  while($row = mysql_fetch_object($result)){
    $exam_arrange[] = $row;
  }
  // print_r($row->number);
  mysql_free_result($result);
}
//查看成绩
else if($action == "view_result"){
  $sql = "SELECT contest.contest_id,contest.title,contest.pro_amount,count( DISTINCT solution.solution_id ) as suc,count(contest_problem.problem_id) as total,contest.start_time,contest.end_time
          FROM  contest,solution,contest_problem
          WHERE contest.contest_id=solution.contest_id
                AND contest.contest_id=contest_problem.contest_id
                AND solution.user_id='$user'
                AND solution.result=4
          group by solution.contest_id
  ";
  $result=mysql_query($sql) or die(mysql_error());
  $exam_results = array();
  while($row = mysql_fetch_object($result)){
    $exam_results[] = $row;
  }
  // print_r($row->number);
  mysql_free_result($result);
}
//已解决问题
else if($action == "solved_problem"){
  $sql="SELECT DISTINCT `solution`.`problem_id` as id,`problem`.title as title,judgetime as time
        FROM `problem`,`solution` 
        WHERE `user_id`='$user_mysql' 
        AND `solution`.`problem_id`=`problem`.`problem_id` 
        AND `result`=4 
        GROUP BY `solution`.`problem_id`
        ORDER BY `solution`.`problem_id` ASC";
  $result=mysql_query($sql) or die(mysql_error());
  $solved_problems = array();
  while($row = mysql_fetch_object($result)){
    $solved_problems[] = $row;
  }
  // print_r($row->number);
  mysql_free_result($result);
}
//查看那基本资料
else{
  $row=mysql_fetch_object($result);
  $school=$row->school;
  $email=$row->email;
  $nick=$row->nick;
  mysql_free_result($result);
  // count solved
  $sql="SELECT count(DISTINCT problem_id) as `ac` FROM `solution` WHERE `user_id`='".$user_mysql."' AND `result`=4";
  $result=mysql_query($sql) or die(mysql_error());
  $row=mysql_fetch_object($result);
  $AC=$row->ac;
  mysql_free_result($result);
  // count submission
  $sql="SELECT count(solution_id) as `Submit` FROM `solution` WHERE `user_id`='".$user_mysql."'";
  $result=mysql_query($sql) or die(mysql_error());
  $row=mysql_fetch_object($result);
  $Submit=$row->Submit;
  mysql_free_result($result);
  // update solved 
  $sql="UPDATE `users` SET `solved`='".strval($AC)."',`submit`='".strval($Submit)."' WHERE `user_id`='".$user_mysql."'";
  $result=mysql_query($sql);
  $sql="SELECT count(*) as `Rank` FROM `users` WHERE `solved`>$AC";
  $result=mysql_query($sql);
  $row=mysql_fetch_array($result);
  $Rank=intval($row[0])+1;

   if (isset($_SESSION['administrator'])){
  $sql="SELECT * FROM `loginlog` WHERE `user_id`='$user_mysql' order by `time` desc LIMIT 0,10";
  $result=mysql_query($sql) or die(mysql_error());
  $view_userinfo=array();
  $i=0;
  for (;$row=mysql_fetch_row($result);){
    $view_userinfo[$i]=$row;
    $i++;
  }
  echo "</table>";
  mysql_free_result($result);
  }
  $sql="SELECT result,count(1) FROM solution WHERE `user_id`='$user_mysql'  AND result>=4 group by result order by result";
    $result=mysql_query($sql);
    $view_userstat=array();
    $i=0;
    while($row=mysql_fetch_array($result)){
      $view_userstat[$i++]=$row;
    }
    mysql_free_result($result);

  $sql= "SELECT UNIX_TIMESTAMP(date(in_date))*1000 md,count(1) c FROM `solution` where  `user_id`='$user_mysql'   group by md order by md desc ";
    $result=mysql_query($sql);//mysql_escape_string($sql));
    $chart_data_all= array();
  //echo $sql;
      
    while ($row=mysql_fetch_array($result)){
      $chart_data_all[$row['md']]=$row['c'];
      }
      
  $sql= "SELECT UNIX_TIMESTAMP(date(in_date))*1000 md,count(1) c FROM `solution` where  `user_id`='$user_mysql' and result=4 group by md order by md desc ";
    $result=mysql_query($sql);//mysql_escape_string($sql));
    $chart_data_ac= array();
  //echo $sql;
      
    while ($row=mysql_fetch_array($result)){
      $chart_data_ac[$row['md']]=$row['c'];
      }
}
mysql_free_result($result);

    
/////////////////////////Template
require("template/".$OJ_TEMPLATE."/user.php");
/////////////////////////Common foot
if(file_exists('./include/cache_end.php'))
	require_once('./include/cache_end.php');
?>

