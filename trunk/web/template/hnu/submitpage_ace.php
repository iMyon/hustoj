<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo $view_title." | ".$OJ_NAME?></title>  
    <?php include("template/$OJ_TEMPLATE/css.php");?>	    


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>IDE-for-oj</title>
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="css/ext/bootstrap.min.css">
    <link href="css/ext/bootstrap-switch.min.css" rel="stylesheet">
    <link href="css/editor.css" rel="stylesheet">
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
  </head>

  <body>
    <div class="container">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>	    
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
<?php
if(strpos($_SERVER['HTTP_USER_AGENT'],'MSIE'))
{
$OJ_EDITE_AREA=false;
}
if($OJ_EDITE_AREA){
?>
<?php }?>
<script src="include/checksource.js"></script>
<form id=frmSolution action="submit.php" method="post"
<?php if($OJ_LANG=="cn"){?>
onsubmit="return checksource(document.getElementById('source').value);"
<?php }?>
>
 <center>

<?php if (isset($id)){?>
Problem <span class=blue><b><?php echo $id?></b></span>
<input id=problem_id type='hidden' value='<?php echo $id?>' name="id" ><br>
<?php }else{
$PID="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
//if ($pid>25) $pid=25;
?>
Problem <span class=blue><b><?php echo chr($pid+ord('A'))?></b></span> of Contest <span class=blue><b><?php echo $cid?></b></span><br>
<input id="cid" type='hidden' value='<?php echo $cid?>' name="cid">
<input id="pid" type='hidden' value='<?php echo $pid?>' name="pid">
<?php }?>
Language:
<select id="language" name="language" onchange="reloadtemplate(this);" >
<?php
$lang_count=count($language_ext);
if(isset($_GET['langmask']))
$langmask=$_GET['langmask'];
else
$langmask=$OJ_LANGMASK;
$lang=(~((int)$langmask))&((1<<($lang_count))-1);
if(isset($_COOKIE['lastlang'])) $lastlang=$_COOKIE['lastlang'];
else $lastlang=0;
for($i=0;$i<$lang_count;$i++){
if($lang&(1<<$i))
echo"<option value=$i ".( $lastlang==$i?"selected":"")." data-value=$i>
".$language_name[$i]."
</option>";
}
?>
</select>
</center>
<br>
<!-- <textarea style="width:80%" cols=180 rows=20 id="source" name="source"><?php echo htmlentities($view_src,ENT_QUOTES,"UTF-8")?></textarea><br>
<?php echo $MSG_Input?>:<textarea style="width:30%" cols=40 rows=5 id="input_text" name="input_text" ><?php echo $view_sample_input?></textarea>
<?php echo $MSG_Output?>:
<textarea style="width:30%" cols=40 rows=5 id="out" name="out" >SHOULD BE:
<?php echo $view_sample_output?>
</textarea> -->

<div class="bodyClass">
        <div class="right">
            <div class="rightbody">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#">HNUOJ</a>
                        </div>
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li class="fontsize">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">font size<span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#" value="12">12px</a></li>
                                        <li><a href="#" value="14">14px</a></li>
                                        <li><a href="#" value="16">16px</a></li>
                                        <li><a href="#" value="18">18px</a></li>
                                        <li><a href="#" value="20">20px</a></li>
                                        <li><a href="#" value="22">22px</a></li>
                                        <li><a href="#" value="24">24px</a></li>
                                        <li><a href="#" value="26">26px</a></li>
                                        <li><a href="#" value="28">28px</a></li>
                                        <li><a href="#" value="30">30px</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#" value="35">35px</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#" value="40">40px</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#" value="50">50px</a></li>
                                    </ul>
                                </li>
                                <li class="theme">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">theme<span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#" theme="ace/theme/github" type="light">亮色主题1</a></li>
                                        <li><a href="#" theme="ace/theme/dawn" type="light">亮色主题2</a></li>
                                        <li><a href="#" theme="ace/theme/crimson_editor" type="light">亮色主题3</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#" theme="ace/theme/tomorrow_night_blue" type="dark">暗色主题1</a></li>
                                        <li><a href="#" theme="ace/theme/merbivore" type="dark">暗色主题2</a></li>
                                        <li><a href="#" theme="ace/theme/kr_theme" type="dark">暗色主题3</a></li>
                                        <li><a href="#" theme="ace/theme/twilight" type="dark">暗色主题4</a></li>
                                    </ul>
                                </li>
                                <li class="language">
                                    <a href="#">language</a>
                                </li>
                                <!-- language -->
                                <li>
                                    <select class="form-control languageSelect" onchange="reloadtemplate(this);">
                                        <option value ="C" data-value="0" <?php echo $lastlang==0?"selected='true'":""; ?> >C</option>
                                        <option value ="C++" data-value="1" <?php echo $lastlang==1?"selected":""; ?>>C++</option>
                                        <option value ="java" data-value="3" <?php echo $lastlang==3?"selected":""; ?>>java</option>
                                    </select>
                                </li>
                                <li class="dropdown" id="compilersList" style="display:none">
                                    <a href="#">compilers</a>
                                </li>
                                <!-- compilers-->
                                <li >
                                    <select class="form-control compilerSelect" style="display:none">
                                    </select>
                                </li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="#">实时编译检查</a></li>
                                <li>
                                    <a href="#" class="sync-switch">
                                        <input id="sync-state" type="checkbox" checked data-size="mini">
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.navbar-collapse -->
                    </div>
                    <!-- /.container-fluid -->
                </nav>
    
                <div class="allContent">
                    <!-- editor -->
                    <div id="editor"></div>
                    
                    <!-- button -->
                    <div id="submitButton" class="btn-group btn-group-justified" style="border:2px solid #d9edF7;border-radius:5px;" role="group" aria-label="...">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default" id="ioContentHide">input-output</button>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default compileButton">提交测试</button>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="submit" class="btn btn-default" id="judgeButton" data-toggle="modal" data-target="#judgeProblem">提交判题</button>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default loadButton">load template</button>
                        </div>
                    </div>
                    <!-- compiler input output -->
                    <!-- <span class="compilerVersion"></span> -->
                    <div class="inputOutput">
                        <div class="ioContent" id="ioContent">
                            <div class="panel panel-info">
                                <div class="panel-heading">compile input &mdash; language&mdash;<span class="language-name"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;compile output</div>
                                <div class="panel-body result">
                                    <div class="compiler-input">
                                        <textarea class="inputData" name=""><?php echo $view_sample_input?></textarea>
                                        <textarea class="outputData" name=""></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-info">
                                <div class="panel-heading">compile error &mdash; language&mdash;<span class="language-name"></span></div>
                                <div class="panel-body result">
                                    <div class="compiler-output outputResult">
                                        <p class="template"></p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- ioContent -->
                    </div>
                </div><!-- allContent -->
            </div><!-- rightbody -->
        </div><!-- right -->
    </div><!-- bodyclass -->
    <!-- hide model -->
    <div id="saveDialog" class="modal hide">
        <div class="template lang c">// Type your code here
#include &ltstdio.h&gt
int main(void){
    printf("hello world!!!!!");
}</div>
        <div class="template lang cc">// Type your code here
#include &ltiostream&gt
using namespace std;
int main(void){
    cout&lt&lt"hello world!"&lt&ltendl;
    return 0;
}</div>
        <div class="template lang java">// Type your code here
public class Test{
    public static void main(String [] arg){
        System.out.println("hello world!");
    }
}</div>
    </div>
    <!-- 模态框 -->
    <div class="modal fade" id="judgeProblem--die" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="gridSystemModalLabel">提示</h4>
          </div>
        <!-- <form action="/test/post" method="post"> -->
          <div class="modal-body">
              <div class="form-group">
                <h4 class="control-label" id="">是否要提交判题？点击是后此页面将会关闭</h4>
                <input type="hidden" name="" class="form-control" id="">
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">不提交</button>
            <button type="button" class="btn btn-primary" id="judgeProblemButton">提交</button>
          </div>
        <!-- </form> -->
        </div>
      </div>
    </div>

<br>
<textarea style="display:none;" id="source" name="source"><?php echo htmlentities($view_src,ENT_QUOTES,"UTF-8")?></textarea><br>
<!-- <input id=Submit class="btn btn-info" type=button value="<?php echo $MSG_SUBMIT?>" onclick=do_submit();>
<input id=TestRun class="btn btn-info" type=button value="<?php echo $MSG_TR?>" onclick=do_test_run();><span class="btn" id=result>状态</span>
<input type=reset class="btn btn-danger" value="重置"> -->
</form>
<iframe name=testRun width=0 height=0 src="about:blank"></iframe>
     </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>	    
 <script>
var sid=0;
var i=0;
var judge_result=[<?php
foreach($judge_result as $result){
echo "'$result',";
}
?>''];
function print_result(solution_id)
{
sid=solution_id;
$("#out").load("status-ajax.php?tr=1&solution_id="+solution_id);
}
function fresh_result(solution_id)
{
sid=solution_id;
var xmlhttp;
if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
}
else
{// code for IE6, IE5
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function()
{
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
var tb=window.document.getElementById('result');
var r=xmlhttp.responseText;
var ra=r.split(",");
// alert(r);
// alert(judge_result[r]);
var loader="<img width=18 src=image/loader.gif>";
var tag="span";
if(ra[0]<4) tag="span disabled=true";
else tag="a";
{
	if(ra[0]==11)
	
	tb.innerHTML="<"+tag+" href='ceinfo.php?sid="+solution_id+"' class='badge badge-info' target=_blank>"+judge_result[ra[0]]+"</"+tag+">";
	else
	tb.innerHTML="<"+tag+" href='reinfo.php?sid="+solution_id+"' class='badge badge-info' target=_blank>"+judge_result[ra[0]]+"</"+tag+">";
}
if(ra[0]<4)tb.innerHTML+=loader;
tb.innerHTML+="Memory:"+ra[1]+"kb&nbsp;&nbsp;";
tb.innerHTML+="Time:"+ra[2]+"ms";
if(ra[0]<4)
window.setTimeout("fresh_result("+solution_id+")",2000);
else
window.setTimeout("print_result("+solution_id+")",2000);
}
}
xmlhttp.open("GET","status-ajax.php?solution_id="+solution_id,true);
xmlhttp.send();
}
function getSID(){
var ofrm1 = document.getElementById("testRun").document;
var ret="0";
if (ofrm1==undefined)
{
ofrm1 = document.getElementById("testRun").contentWindow.document;
var ff = ofrm1;
ret=ff.innerHTML;
}
else
{
var ie = document.frames["frame1"].document;
ret=ie.innerText;
}
return ret+"";
}
var count=0;
function do_submit(){
if(typeof(eAL) != "undefined"){ eAL.toggle("source");eAL.toggle("source");}
var mark="<?php echo isset($id)?'problem_id':'cid';?>";
var problem_id=document.getElementById(mark);
if(mark=='problem_id')
problem_id.value='<?php echo $id?>';
else
problem_id.value='<?php echo $cid?>';
document.getElementById("frmSolution").target="_self";
<?php if($OJ_LANG=="cn") echo "if(checksource(document.getElementById('source').value))";?>
document.getElementById("frmSolution").submit();
}
var handler_interval;
function do_test_run(){
if( handler_interval) window.clearInterval( handler_interval);
var loader="<img width=18 src=image/loader.gif>";
var tb=window.document.getElementById('result');
tb.innerHTML=loader;
if(typeof(eAL) != "undefined"){ eAL.toggle("source");eAL.toggle("source");}
var mark="<?php echo isset($id)?'problem_id':'cid';?>";
var problem_id=document.getElementById(mark);
problem_id.value=-problem_id.value;
document.getElementById("frmSolution").target="testRun";
document.getElementById("frmSolution").submit();
document.getElementById("TestRun").disabled=true;
document.getElementById("Submit").disabled=true;
count=20;
handler_interval= window.setTimeout("resume();",1000);
}
function resume(){
count--;
var s=document.getElementById('Submit');
var t=document.getElementById('TestRun');
if(count<0){
s.disabled=false;
t.disabled=false;
s.value="<?php echo $MSG_SUBMIT?>";
t.value="<?php echo $MSG_TR?>";
if( handler_interval) window.clearInterval( handler_interval);
}else{
s.value="<?php echo $MSG_SUBMIT?>("+count+")";
t.value="<?php echo $MSG_TR?>("+count+")";
window.setTimeout("resume();",1000);
}
}
function reloadtemplate(lang){
   document.cookie="lastlang="+$(lang).find("option[value='"+lang.value+"']").attr("data-value");
   //alert(document.cookie);
   if(confirm("Do you want to reload template?\n You may lost all code that you've typed here!"))
	document.location.reload();
}
</script>

<!-- <script src="js/ext/jquery.min.js" type="text/javascript"></script> -->
<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<!-- <script src="js/ext/bootstrap.min.js"></script> -->
<script src="js/ext/bootstrap-switch.min.js"></script>
<!-- 定义了一个全局变量OPTIONS 放置相关信息 -->
<script src="client-options.js"></script>
<script src="js/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
<script src="js/src-noconflict/ext-language_tools.js" type="text/javascript" charset="utf-8"></script>
<script src="js/src-noconflict/snippets/java.js" type="text/javascript" charset="utf-8"></script>
<script src="js/src-noconflict/snippets/c_cpp.js" type="text/javascript" charset="utf-8"></script>
<script src="js/initpage.js" type="text/javascript"></script>
<script src="js/editor.js" type="text/javascript"></script>
<script src="js/compiler.js" type="text/javascript"></script>
<script type="text/javascript" >
  setSetting("code", $("#source").val());
  var ace_editor = ace.edit("editor");
  ace_editor.getSession().on("change", function(){
    var code = ace_editor.getSession().getValue();
    // alert(code);
    $("#source").html(code);
  });
  <?php
    if($lastlang==0)
      $lang = "C";
    else if($lastlang==1)
      $lang = "C++";
    else if($lastlang==3)
      $lang = "java";
    echo "var language = '$lang';\n";
  ?>
  setSetting("language", language);

</script>


</body>
</html>
