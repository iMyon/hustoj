<html>
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title><?php echo $OJ_NAME?></title>  
  <?php include("template/$OJ_TEMPLATE/css.php");?>
  <script type="text/javascript" src="include/wz_jsgraphics.js"></script>
  <script type="text/javascript" src="include/pie.js"></script>
  <script language="javascript" type="text/javascript" src="include/jquery-latest.js"></script>
  <script language="javascript" type="text/javascript" src="include/jquery.flot.js"></script>
  </head>
  <body>
  <div class="container">
  <?php include("template/$OJ_TEMPLATE/nav.php");?>
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="row">
          <div class="nav-left col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
              <li class="<?=$action?'':'active' ?>"><a href="user.php">基本信息<span class="sr-only">(current)</span></a></li>
              <li class="<?=$action=='exam'?'active':'' ?>"><a href="user.php?act=exam">我的考试</a></li>
              <li class="<?=$action=='view_result'?'active':'' ?>"><a href="user.php?act=view_result">查看成绩</a></li>
              <li class="<?=$action=='solved_problem'?'active':'' ?>"><a href="user.php?act=solved_problem">已解决问题列表</a></li>
            </ul>
          </div>
          <div class="content col-sm-9 main">
            <?php if($action=="exam"){/*考场安排*/ ?>
            <table class="table table-striped table-hover table-bordered" id="statics">
              <tr>
                <th>考试名称</th>
                <th>考试地点</th>
                <th>开始时间</th>
                <th>结束时间</th>
              </tr>
              <?php
                foreach($exam_arrange as $row){
                echo "<tr>
                        <td>".$row->title."</td>
                        <td>".$row->room . $rwo->number."</td>
                        <td>".$row->start_time."</td>
                        <td>".$row->end_time."</td>
                      </tr>";
              }?>
            </table>
            <?php }else if($action=="view_result"){/*查看成绩*/?>
            <table class="table table-striped table-hover table-bordered" id="statics">
              <tr>
                <th>考试名称</th>
                <th>考题总数</th>
                <th>答题正确数</th>
                <th>开始时间</th>
                <th>结束时间</th>
              </tr>
              <?php
                foreach($exam_results as $row){
                echo "<tr>
                        <td><a href='contest.php?cid=".$row->contest_id."'>".$row->title."</a></td>
                        <td>". ($row->pro_amount?$row->pro_amount:$row->total) ."</td>
                        <td>".$row->suc."</td>
                        <td>".$row->start_time."</td>
                        <td>".$row->end_time."</td>
                      </tr>";
              }?>
            </table>
            <?php }else if($action=="solved_problem"){/*已解决问题*/?>
            <table class="table table-striped table-hover table-bordered" id="statics">
              <tr>
                <th>题目编号</th>
                <th>名称</th>
                <th>解决时间</th>
              </tr>
              <?php
                foreach($solved_problems as $row){
                echo "<tr>
                        <td>".$row->id."</td>
                        <td><a href='problem.php?id=".$row->id."'>".$row->title."</a></td>
                        <td>".$row->time."</td>
                      </tr>";
              }?>
            </table>
            <?php }else{/*基本信息*/?>
            <table class="table table-striped table-hover table-bordered" id="statics">
              <tbody>
                <tr>
                  <td><?php echo $MSG_Number?></td>
                  <td><?php echo $Rank?></td>
                </tr>
                <tr>
                  <td><?php echo $MSG_SOVLED?></td>
                  <td><a href='status.php?user_id=<?php echo $user?>&jresult=4'><?php echo $AC?></a></td>
                </tr>
                <tr>
                  <td><?php echo $MSG_SUBMIT?></td>
                  <td><a href='status.php?user_id=<?php echo $user?>'><?php echo $Submit?></a></td>
                </tr>
                <?php
                foreach($view_userstat as $row){
                echo "<tr><td>".$jresult[$row[0]]."</td><td><a href=status.php?user_id=$user&jresult=".$row[0]." >".$row[1]."</a></td></tr>";
                }
                echo "<tr id=pie ><td>饼图分析<td><div id='PieDiv' style='position:relative;height:105px;width:120px;'></tr>";
                ?>
                <tr>
                  <td>学校</td>
                  <td><?php echo $school?></td>
                </tr>
                <tr>
                  <td>邮箱</td>
                  <td><?php echo $email?$email:"未设置" ?></td>
              </tbody>
            </table>
            <?php }?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include("template/$OJ_TEMPLATE/js.php");?>
  <script language="javascript">
  //图形渲染
  var y= new Array ();
  var x = new Array ();
  var dt=document.getElementById("statics");
  var data=dt.rows;
  var n;
  for(var i=3;dt.rows[i].id!="pie";i++){
  n=dt.rows[i].cells[0];
  n=n.innerText || n.textContent;
  x.push(n);
  n=dt.rows[i].cells[1].firstChild;
  n=n.innerText || n.textContent;
  //alert(n);
  n=parseInt(n);
  y.push(n);
  }
  var mypie= new Pie("PieDiv");
  mypie.drawPie(y,x);
  //mypie.clearPie();
  </script>  
  </body>
</html>