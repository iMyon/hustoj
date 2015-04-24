<?php @session_start();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel=stylesheet href='../include/hoj.css' type='text/css'>
<link rel="stylesheet" href="<?php echo "../template/$OJ_TEMPLATE/"?>bootstrap.min.css">
<link rel="stylesheet" href="<?php echo "t../emplate/$OJ_TEMPLATE/"?>bootstrap-theme.min.css">
<?php if (!(isset($_SESSION['administrator'])||
			isset($_SESSION['contest_creator'])||
			isset($_SESSION['problem_editor']))){
	echo "<a href='../loginpage.php'>Please Login First!</a>";
	exit(1);
}
require_once("../include/db_info.inc.php");
?>

