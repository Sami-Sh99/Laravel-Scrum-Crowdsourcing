
  // Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher('2e19e7364cd8170d657c', {
  cluster: 'eu',
  forceTLS: true
});

var workshopKey = document.getElementById("workshop_key").value;
var notificationCount = 0;

$("#Launch").on('click',function(){
  console.log('launching');
  $.get("/facilitator/workshop/"+workshopKey+"/launch", function(data, status){
  console.log("Data: " + data + "\nStatus: " + status);
  });

  $("#facilitator_load_msg").css("display", "block");
  $("#participants_table").css("display", "none");
  $("#facilitator_content").css("display", "none");

  // channel.unbind('new-user',function(data){console.log("unbinded from new-user");});
  console.log('unbinded');

});
var channel = pusher.subscribe('workshop.' + workshopKey);
channel.bind('new-user', function(data) {

notificationCount++;

var row=document.getElementById("participants-table").insertRow();
var cell1 = row.insertCell(0);
var cell2 = row.insertCell(1);
var cell3 = row.insertCell(2);

row.id=data.id;

cell1.innerHTML = '<td><img style="width: 50px; height: 50px;" src="'+data.photo_link+'" alt=""></td>';
cell2.innerHTML = '<td><a href="#">'+data.fullname+'</a></td>';
cell3.innerHTML = '<td style="width: 20%;">'+data.email+'</td>';

$("#notification_count").html(notificationCount);

$("#no_new_notifications").remove();

$("#notification_div").append("<a class='dropdown-item d-flex align-items-center' ><div><span class='font-weight-bold'>new participant" + data.fullname + " joined!</span></div></a>");


});

channel.bind('finish-all-rounds', function(data){
  window.location.replace("/facilitator/workshop/"+workshopKey+"/results");
  });

channel.bind('submit-card', function(data){
  console.log('sami');
var row = document.getElementById(data.id);
row.classList.remove("danger");
row.classList.add("success");
});