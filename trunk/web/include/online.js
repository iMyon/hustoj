function online(){
  $.get("online.php");
  setTimeout(online,3*60*1000);
}