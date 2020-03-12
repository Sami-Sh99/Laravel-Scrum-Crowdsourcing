

var workshopKey = document.getElementById("workshop_key").value;

// Establishing Pusher Connection 
Pusher.logToConsole = true;
var pusher = new Pusher('2e19e7364cd8170d657c', {
  cluster: 'eu',
  forceTLS: true
});

// Subscribing to pusher channel
var channel = pusher.subscribe('workshop.' + workshopKey);
  
channel.bind('groups-ready', function(data){
  window.location.replace("/workshop/"+workshopKey+"/group");
  });