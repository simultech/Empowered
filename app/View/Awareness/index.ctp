<!-- <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.12.1/TweenMax.min.js"></script> -->

<!-- <h2>Awareness</h2> -->
<style>
body.layout_awareness div#main {

  background:#fff url('/img/background_image1.jpg');
  background-size:100%;
}
body.layout_awareness div#footer {
  position:fixed;
  bottom:0;
  width:100%;
}
div#first {
  background:#FF0000;
-vendor-animation-duration: 4s;
-vendor-animation-delay: 2000;
-vendor-animation-iteration-count: infinite;
}
div#second {
  background:#00FF00;
-vendor-animation-duration: 4s;
-vendor-animation-delay: 1500;
-vendor-animation-iteration-count: infinite;
}
</style>
<?php
// print_r($data);
?>
<div class="col-md-12" id="background">
<div class="col-md-offset-1 col-md-5 col-md-offset-6">
<h2 id="right">Please enter you age</h2>
<input id="rightInput"class="form-control" placeholder="Age"/>
<h2 id="left">Please select your gender</h2>
<select class="form-control" id="leftSel">
  <option value="male">Male</option>
  <option value="female">Female</option>
</select>
<h2 id="rightState">State</h2>
<select class="form-control" id="rightStateSel" style="margin-bottom:20px;">
  <option value="sa">South Australia</option>
  <option value="qld">Queensland</option>
  <option value="nt">the Northern Territory</option>
  <option value="tas">Tasmania</option>
  <option value="vic">Victoria</option>
  <option value="wa">Western Australia</option>
  <option value="nsw">New South Wales</option>
</select>

<button type="button" id="submit" onclick="submit()" class="btn btn-primary btn-lg btn-block" style="margin-bottom:20px">Submit</button>
</div>

<!-- <div id='toadd'></div> -->


<script type='text/javascript'>
$('#right').addClass('animated bounceInRight');
$('#rightInput').addClass('animated bounceInRight');
$('#rightState').addClass('animated bounceInRight');
$('#rightStateSel').addClass('animated bounceInRight');
$('#left').addClass('animated bounceInLeft');
$('#leftSel').addClass('animated bounceInLeft');
function submit(){

  var jojo = $('<div>hello</div>');
  $('#background').append(jojo);
  var number = $('#rightStateSel').val()+" and "+ $('#rightInput').val();

    $.post( "/awareness/getCarerAllowancePaymentsReceived", { state: $('#rightStateSel').val(), age:$('#rightInput').val(), gender:$('#leftSel').value})
    .done(function( data ) {
      $('#right').remove();
      $('#rightInput').remove();
      $('#rightState').remove();
      $('#rightStateSel').remove();
      $('#left').remove();
      $('#leftSel').remove();
      $('#submit').remove();
      console.log(data);
      dataReceived = data;

      //change BG
      $('#main')
      .animate({opacity: 0}, 'slow', function() {
          $(this)
              .css({'background': '#FFFFFF'})
              .animate({opacity: 1});
      });
      // var FIRST = $('<div class="col-md-offset-2 col-md-8 col-md-offset-2" id="first">'+
      // '<h1 style="font-size:100px">Are you aware</h1></div>');
      // $('#background').append(FIRST);
      //
      // $('#first').addClass('animated zoomIn');
      partOne();
      setTimeout(function() {
        $('#first').remove();
      },2000);
      setTimeout(function() {
        partTwo(data);
      },2000);
      var SECOND = $('<h1  style="font-size:100px">that there are '+data+' people that are same age as you, from the same state as you, who are the carers?</h1>');


      $('#second').addClass('animated bounceInLeft');
      $('#third').addClass('animated bounceInLeft');
      $('#forth').addClass('animated bounceInLeft');
      $('#fifth').addClass('animated bounceInLeft');
    });

    function partOne(){
      var FIRST = $('<div class="col-md-offset-2 col-md-8 col-md-offset-2" id="first">'+
      '<h1 style="font-size:100px">Are you aware</h1></div>');
      $('#background').append(FIRST);
      $('#first').addClass('animated zoomIn');
    }

    function partTwo(data){
      var FIRST = $('<div class="col-md-offset-2 col-md-8 col-md-offset-2" id="second">'+
      '<h1 style="font-size:100px">that there are '+data+' people</h1></div>');
      $('#background').append(FIRST);
      $('#second').addClass('animated bounceInLeft');
    }





}
</script>
