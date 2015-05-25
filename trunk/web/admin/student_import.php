<?php function writable($path){
	$ret=false;
	$fp=fopen($path."/testifwritable.tst","w");
	$ret=!($fp===false);
	fclose($fp);
	unlink($path."/testifwritable.tst");
	return $ret;
}
require_once("admin-header.php");
if (!(isset($_SESSION['administrator']))){
	echo "<a href='../loginpage.php'>Please Login First!</a>";
	exit(1);
}
   $maxfile=min(ini_get("upload_max_filesize"),ini_get("post_max_size"));

?>
从excel表导入用户数据，请确保上传的文件大小小于[<?php echo $maxfile?>]<br/>
如果需要上传更大的文件，请进行分割，或者修改服务器的php.ini文件的post_max_size。<br/>
请确保excel表第一列为学号，第二列为学生姓名，并确保excel表的格式为excel2007。

<?php 
    $show_form=true;
   if(!isset($OJ_SAE)||!$OJ_SAE){
	   if(!writable($OJ_DATA)){
		   echo " You need to add  $OJ_DATA into your open_basedir setting of php.ini,<br>
					or you need to execute:<br>
					   <b>chmod 775 -R $OJ_DATA && chgrp -R www-data $OJ_DATA</b><br>
					you can't use import function at this time.<br>"; 
			$show_form=false;
	   }
	   mkdir("../upload");
	   if(!writable("../upload")){
	   	 
		   echo "../upload is not writable, <b>chmod 770</b> to it.<br>";
		   $show_form=false;
	   }
	}	
	if($show_form){
?>
<br>
<form action='student_import_excel.php' method=post enctype="multipart/form-data">
	<b>导入excel表:</b><br />
	
	<input type=file name=fps >
	<?php require_once("../include/set_post_key.php");?>
    <input type=submit value='导入'>
</form>
<?php 
  
   	}
   
?>
<br>
