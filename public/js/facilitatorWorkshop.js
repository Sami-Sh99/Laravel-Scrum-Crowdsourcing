
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
});

var channel = pusher.subscribe('workshop.' + workshopKey);
channel.bind('new-user', function(data) {
var row=document.getElementById("participants-table").insertRow();
var cell1 = row.insertCell(0);
var cell2 = row.insertCell(1);
var cell3 = row.insertCell(2);

cell1.innerHTML = '<td><img src="https://bootdey.com/img/Content/user_1.jpg" alt=""><a href="#" class="user-link">' + data.fullname + '</a></td>';
cell2.innerHTML = '<td><a href="#">marlon@brando.com</a></td>';
cell3.innerHTML = '<td style="width: 20%;"><a> Delete </a></td>';

});
