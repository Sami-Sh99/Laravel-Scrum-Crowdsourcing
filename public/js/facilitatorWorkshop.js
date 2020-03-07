
  // Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher('2e19e7364cd8170d657c', {
  cluster: 'eu',
  forceTLS: true
});

var workshopKey = document.getElementById("workshop_key").value;


$("#Launch").on('click',function(){
  console.log('launching');
  $.get("/facilitator/workshop/"+workshopKey+"/launch", function(data, status){
  console.log("Data: " + data + "\nStatus: " + status);
  });
  var table = document.getElementById("participants-table");
  for (var i = 1, row; row = table.rows[i]; i++) {
    row.classList.add("danger");
    console.log('row '+i+' set to danger');
  }
  console.log('exit loop');
  // channel.unbind('new-user',function(data){console.log("unbinded from new-user");});
  console.log('unbinded');

});
var channel = pusher.subscribe('workshop.' + workshopKey);
channel.bind('new-user', function(data) {
var row=document.getElementById("participants-table").insertRow();
var cell1 = row.insertCell(0);
var cell2 = row.insertCell(1);
var cell3 = row.insertCell(2);

row.id=data.id;

cell1.innerHTML = '<td><img src="https://bootdey.com/img/Content/user_1.jpg" alt=""><a href="#" class="user-link">' + data.fullname + '</a></td>';
cell2.innerHTML = '<td><a href="#">marlon@brando.com</a></td>';
cell3.innerHTML = '<td style="width: 20%;"><a> Delete </a></td>';

});

channel.bind('submit-card', function(data){
console.log('sami');
var row = document.getElementById(data.id);
row.classList.remove("danger");
row.classList.add("success");
});

channel.bind('finish-all-rounds', function(data){
  window.location.replace("/facilitator/workshop/"+workshopKey+"/results");
  });