

var workshopKey = document.getElementById("workshop_key").value;

// Establishing Pusher Connection 
Pusher.logToConsole = true;
var pusher = new Pusher('2e19e7364cd8170d657c', {
  cluster: 'eu',
  forceTLS: true
});

// Subscribing to pusher channel
var channel = pusher.subscribe('workshop.' + workshopKey);

channel.bind('wait-next-round', function(data) {
    window.location.replace("/workshop/"+workshopKey+"/scoring");
});
  
channel.bind('finish-all-rounds', function(data){
  window.location.replace("/workshop/"+workshopKey+"/group/wait");
  });