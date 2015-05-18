<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>用户登录</title>  
    <?php include("template/$OJ_TEMPLATE/css.php");?>	    


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

<div class="container">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>	    
      <!-- Main component for a primary marketing message or call to action -->
  <div class="jumbotron">
    <form class="form-horizontal" role="form" action="login.php" method="post">
     <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">用户名（学号）</label>
        <div class="col-sm-4">
           <input type="text" class="form-control" id="firstname" 
              placeholder="请输入用户名（学号）" name="user_id">
        </div>
     </div>
     <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">密码</label>
        <div class="col-sm-4">
           <input name="password" type="password" class="form-control" id="lastname" 
              placeholder="请输入密码">
        </div>
     </div>
     <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">验证码</label>
        <div class="col-sm-2">
           <input type="text" class="form-control" id="lastname" name="vcode"
              placeholder="请输入验证码">
        </div>
        <div class="col-sm-2">
          <img alt="click to change" src=vcode.php onclick="this.src='vcode.php?<?php echo rand();?>#'+Math.random()">
        </div>
     </div>
     <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
           <button name="submit" type="submit" class="btn btn-default">登录</button>
        </div>
     </div>
  </form>
<!--     <form action=login.php method=post>
<center>
<table width=480 algin=center class="table table-striped table-hover table-bordered">
<tr><td width=240><?php echo $MSG_USER_ID?>:<td width=200><input style="height:24px" name="user_id" type="text" size=20></tr>
<tr><td><?php echo $MSG_PASSWORD?>:<td><input name="password" type="password" size=20 style="height:24px"></tr>
<?php if($OJ_VCODE){?>
<tr><td><?php echo $MSG_VCODE?>:</td>
<td><input name="vcode" size=4 type=text style="height:24px"><img alt="click to change" src=vcode.php onclick="this.src='vcode.php?<?php echo rand();?>#'+Math.random()">*</td>
</tr>
<?php }?>
<tr><td colspan=3><input name="submit" type="submit" size=10 value="Submit">
<a href="lostpassword.php">Lost Password</a>
</tr>
</table>
<center>
</form> -->
   </div>


</div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>	    
  </body>
</html>
