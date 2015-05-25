<?php require_once("admin-header.php");
if (!(isset($_SESSION['administrator']))){
	echo "<a href='../loginpage.php'>Please Login First!</a>";
	exit(1);
}
?>

<form action='problem_export_xml.php' method=post>
	<b>导出问题:</b><br />
	从 pid:<input type=text size=10 name="start" value=1000>
	到 pid:<input type=text size=10 name="end" value=1000><br />
	或者自定义题号：<input type=text size=40 name="in" value=""><br />
	<input type='hidden' name='do' value='do'>
	<input type=submit name=submit value='导出'>
   <input type=submit value='下载'>
   <?php require_once("../include/set_post_key.php");?>
</form>
* 若要使用第一种方式导出，请保证自定义题号为空， <br>
* 如果填写了第二种方式，则第一种方式填写的数据无效。<br>
* 第二种方式可以用","分隔题目号，或者直接指定一个区间，比如"[1010,10020]"
