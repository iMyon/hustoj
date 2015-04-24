<?php require_once("admin-header.php");

	if(isset($OJ_LANG)){
		require_once("../lang/$OJ_LANG.php");
	}
	

?>
<html>
<head>
<title><?php echo $MSG_ADMIN?></title>
<link rel="stylesheet" href="css/nav.css" media="screen" type="text/css" />
</head>

<body>
<div class="left-menu">
  <div class="logo"><i class="fa fa-align-justify"></i>
    <div>考试系统后台管理</div>
  </div>
  <div class="accordion">
    <div class="section">
      <input type="radio" name="accordion-1" id="section-1" checked="checked"/>
      <label for="section-1"><span>考试管理</span></label>
      <div class="content">
        <ul>
          <?php if (isset($_SESSION['administrator'])||isset($_SESSION['problem_editor'])){
          ?>
            <li><a class='' href="problem_add_page.php" target="main"><b><?php echo $MSG_ADD.$MSG_PROBLEM?></b></a></li>
          <?php }
          if (isset($_SESSION['administrator'])||isset($_SESSION['contest_creator'])||isset($_SESSION['problem_editor'])){
          ?>
            <li><a class='' href="problem_list.php" target="main"><b><?php echo $MSG_PROBLEM.$MSG_LIST?></b></a></li>
          <?php }
          if (isset($_SESSION['administrator'])||isset($_SESSION['contest_creator'])){
          ?>    
          <li><a class='' href="contest_add.php" target="main"><b><?php echo $MSG_ADD.$MSG_CONTEST?></b></a></li>
          <?php }
          if (isset($_SESSION['administrator'])||isset($_SESSION['contest_creator'])){
          ?>
          <li><a class='' href="contest_list.php" target="main"><b><?php echo $MSG_CONTEST.$MSG_LIST?></b></a></li>
          <?php }
          if (isset($_SESSION['administrator'])){
          ?>
          <li><a class='' href="team_generate.php" target="main"><b><?php echo $MSG_TEAMGENERATOR?></b></a></li>
          <?php }
          if (isset($_SESSION['administrator'])){
          ?><li><a class='' href="rejudge.php" target="main"><b><?php echo $MSG_REJUDGE?></b></a></li>
          <?php }
          ?>
        </ul>
      </div>
    </div>
    <div class="section">
      <input type="radio" name="accordion-1" id="section-2" value="toggle"/>
      <label for="section-2"><span>前台管理</span></label>
      <div class="content">
        <ul>
          <li><a class='' href="/" target="main"><b><?php echo $MSG_SEEOJ?></b></a></li>
          <?php if (isset($_SESSION['administrator'])){
            ?>
            <li><a class='' href="news_add_page.php" target="main"><b><?php echo $MSG_ADD.$MSG_NEWS?></b></a></li>
            <li><a class='' href="news_list.php" target="main"><b><?php echo $MSG_NEWS.$MSG_LIST?></b></a></li>
          <?php }
          if (isset($_SESSION['administrator'])){
          ?>
          <li><a class='' href="setmsg.php" target="main"><b><?php echo $MSG_SETMESSAGE?></b></a></li>
          <?php }
          ?>
        </ul>
      </div>
    </div>
    <div class="section">
      <input type="radio" name="accordion-1" id="section-3" value="toggle"/>
      <label for="section-3"><span>考场管理</span></label>
      <div class="content">
        <ul>
          <?php if (isset($_SESSION['administrator'])||isset( $_SESSION['password_setter'] )){
          ?>
          <li><a class='' href="exam_arrange_page.php" target="main"><b>分配考场</b></a></li>
          <li><a class='' href="exam_room_add_page.php" target="main"><b>添加考场</b></a></li>
          <li><a class='' href="seat_add_page.php" target="main"><b>添加座位</b></a></li>
          <!-- <li><a class='' href="exam_arrange.php" target="main"><b>考场安排</b></a></li> -->
          <?php } ?>
        </ul>
      </div>
    </div>
    <div class="section">
      <input type="radio" name="accordion-1" id="section-3" value="toggle"/>
      <label for="section-3"><span>权限管理</span></label>
      <div class="content">
        <ul>
          <?php if (isset($_SESSION['administrator'])||isset( $_SESSION['password_setter'] )){
          ?><li><a class='' href="changepass.php" target="main"><b><?php echo $MSG_SETPASSWORD?></b></a></li>
          <?php }
          if (isset($_SESSION['administrator'])){
          ?><li><a class='' href="privilege_add.php" target="main"><b><?php echo $MSG_ADD.$MSG_PRIVILEGE?></b></a></li>
          <?php }
          if (isset($_SESSION['administrator'])){
          ?><li><a class='' href="privilege_list.php" target="main"><b><?php echo $MSG_PRIVILEGE.$MSG_LIST?></b></a></li>
          <?php }
          ?>
        </ul>
      </div>
    </div>
    <div class="section">
      <input type="radio" name="accordion-1" id="section-4" value="toggle"/>
      <label for="section-4"><span>导入导出</span></label>
      <div class="content">
        <ul>
          <?php if (isset($_SESSION['administrator'])){
          ?><li><a class='' href="source_give.php" target="main"><b><?php echo $MSG_GIVESOURCE?></b></a></li>
            <li><a class='' href="problem_export.php" target="main"><b><?php echo $MSG_EXPORT.$MSG_PROBLEM?></b></a></li>
            <li><a class='' href="problem_import.php" target="main"><b><?php echo $MSG_IMPORT.$MSG_PROBLEM?></b></a></li>
            <li><a class='' href="student_import.php" target="main"><b><?php echo $MSG_IMPORT.$MSG_USER?></b></a></li>
          <?php }
          ?>
        </ul>
      </div>
    </div>
    <div class="section">
      <input type="radio" name="accordion-1" id="section-5" value="toggle"/>
      <label for="section-5"><span>数据库管理</span></label>
      <div class="content">
        <ul>
          <?php if (isset($_SESSION['administrator'])){
          ?><li><a class='' href="update_db.php" target="main"><b><?php echo $MSG_UPDATE_DATABASE?></b></a></li>
          <?php }
          ?>
        </ul>
      </div>
    </div>
  	<div class="section">
      <input type="radio" name="accordion-1" id="section-6" value="toggle"/>
      <label for="section-6"><span>其他</span></label>
      <div class="content">
        <ul>
          <?php if (isset($OJ_ONLINE)&&$OJ_ONLINE){
          ?><li><a class='' href="../online.php" target="main"><b><?php echo $MSG_ONLINE?></b></a></li>
          <?php }
          ?>
          <li><a class='' href="http://code.google.com/p/hustoj/" target="_blank"><b>HUSTOJ</b></a></li>
          <li><a class='' href="http://code.google.com/p/freeproblemset/" target="_blank"><b>FreeProblemSet</b></a></li>
          <li><a class='' href="http://acmclub.com" target="_blank"><b>ACM俱乐部免费开通校级OJ服务器</b></a></li>

          <?php if (isset($_SESSION['administrator'])&&!$OJ_SAE){
          ?>
          <li><a href="problem_copy.php" target="main" title="Create your own data"><font color="eeeeee">CopyProblem</font></a></li>
          <li><a href="problem_changeid.php" target="main" title="Danger,Use it on your own risk"><font color="eeeeee">ReOrderProblem</font></a></li>
          <?php }
          ?>
        </ul>
      </div>
    </div>
  </div>
</div>
</body>
</html>

