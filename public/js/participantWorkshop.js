

var workshopKey = document.getElementById("workshop_key").value;

// Establishing Pusher Connection 
Pusher.logToConsole = true;
var pusher = new Pusher('2e19e7364cd8170d657c', {
  cluster: 'eu',
  forceTLS: true
});

// Subscribing to pusher channel
var channel = pusher.subscribe('workshop.' + workshopKey);
channel.bind('Launch', function(data) {
    document.getElementById("Loading").style.display = "none";
    document.getElementById("Card").style.display = "block";
});


// Onclick methods

$("#submit_card_btn").click(function(){
    $.get("/workshop/"+workshopKey+"/card/submit",{
      content: document.getElementById("card_content").value
    },  function(data, status){
    console.log("Data: "+ document.getElementById("card_content").value);
  });
  });
  

