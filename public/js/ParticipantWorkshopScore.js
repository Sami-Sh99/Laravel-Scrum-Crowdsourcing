

var workshopKey = document.getElementById("workshop_key").value;
var score_id = document.getElementById("score_id").value;

// Establishing Pusher Connection 
Pusher.logToConsole = true;
var pusher = new Pusher('2e19e7364cd8170d657c', {
  cluster: 'eu',
  forceTLS: true
});
// Subscribing to pusher channel
// var channel = pusher.subscribe('workshop.' + workshopKey);
// channel.bind(' ', function(data) {
//     document.getElementById("Loading").style.display = "none";
//     document.getElementById("Card").style.display = "block";
// });
var score=document.getElementById("input_hidden");

// Onclick methods

$("#submit_card_btn").click(function(){
    $.get("/workshop/"+workshopKey+"/score/"+score_id,{
      score: score.value
    },  function(data, status){
    console.log("Data: "+ score);
  });
//   window.location.replace("/workshop/"+workshopKey+"/scoring");
  });

$("#star1").click(function(){
    score.value=1;
    $('#star1').addClass('checked');
});
$("#star2").click(function(){
score.value=2;
$('#star1').addClass('checked');
$('#star2').addClass('checked');
});
$("#star3").click(function(){
    score.value=3;
    $('#star1').addClass('checked');
    $('#star2').addClass('checked');
    $('#star3').addClass('checked');
});
$("#star4").click(function(){
    score.value=4;
    $('#star1').addClass('checked');
    $('#star2').addClass('checked');
    $('#star3').addClass('checked');
    $('#star4').addClass('checked');
});
$("#star5").click(function(){
    score.value=5;
    $('#star1').addClass('checked');
    $('#star2').addClass('checked');
    $('#star3').addClass('checked');
    $('#star4').addClass('checked');
    $('#star5').addClass('checked');
});
  
  $('#star5').hover(function(){
    $('#star1').addClass('checked');
    $('#star2').addClass('checked');
    $('#star3').addClass('checked');
    $('#star4').addClass('checked');
    $('#star5').addClass('checked');
    
},function(){
    $('#star1').removeClass('checked');
    $('#star2').removeClass('checked');
    $('#star3').removeClass('checked');
    $('#star4').removeClass('checked');
    $('#star5').removeClass('checked');
});

$('#star4').hover(function(){
    $('#star1').addClass('checked');
    $('#star2').addClass('checked');
    $('#star3').addClass('checked');
    $('#star4').addClass('checked');
    
},function(){
    $('#star1').removeClass('checked');
    $('#star2').removeClass('checked');
    $('#star3').removeClass('checked');
    $('#star4').removeClass('checked');
});

$('#star3').hover(function(){
    $('#star1').addClass('checked');
    $('#star2').addClass('checked');
    $('#star3').addClass('checked');
},function(){
    $('#star1').removeClass('checked');
    $('#star2').removeClass('checked');
    $('#star3').removeClass('checked');
});

$('#star2').hover(function(){
    $('#star1').addClass('checked');
    $('#star2').addClass('checked');
},function(){
    $('#star1').removeClass('checked');
    $('#star2').removeClass('checked');
});


$('#star1').hover(function(){
    $('#star1').addClass('checked');
},function(){
    $('#star1').removeClass('checked'); 
});