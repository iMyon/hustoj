function delete_room(id){
  var choice = confirm("是否删除考场"+id);
  choice && $.post("exam_room_delete.php",{room_id:id}, function(){
    location.reload();
  });
}

function setSeatTable(){
  var room_id = $("#room-select").children('option:selected').val();
  var room_name = $("#room-select").children('option:selected').text();
  $("#room-name-label").html(room_name);
  $("#seats-body").html("");
  $.get("get_seats.php?room="+room_id, function(res){
    var resjson = JSON.parse(res);
    if(resjson.error == 0 && resjson.seats){
      var seats = resjson.seats;
      var html = "";
      jQuery.each(seats, function(id, name) {  
          html = html + "<tr><td>"+name+"</td>"
                +"<td><a id='seat_edit' href='seat_edit_page.php?id='"+id+">编辑</a><a id='seat_delete' href='#' onclick='delete_seat("+id+")' style='margin-left:10px;'>删除</a></td>"
                +"</tr>";
      });
      $("#seats-body").html(html);
    }
  });
}
function setArrangeSeatTable(){
  var contest_id = $("#exam-select").children('option:selected').val();
  var contest_name = $("#exam-select").children('option:selected').text();
  $("#room-name-label").html(contest_name);
  $("#seats-body").html("");
  $.get("get_arrange_seats.php?id="+contest_id, function(res){
    var resjson = JSON.parse(res);
    if(resjson.error == 0 && resjson.arrange){
      var arranges = resjson.arrange;
      var html = "";
      for(var i=0;i<arranges.length;i++){
        html = html + "<tr><td>"+arranges[i].user_id+"</td><td>"+arranges[i].name+"</td><td>"+arranges[i].number+"</td></tr>"
      }
      $("#seats-body").html(html);
    }
  });
}