  console.log("dddddddddddd",ace);
  $("#sync-state").bootstrapSwitch();
  //初始化ace代码
  var ace_editor = ace.edit("editor");
  ace_editor.getSession().setValue('<?php echo str_replace(array("\r\n", "\r", "\n"),"\\n",$view_src); ?>');