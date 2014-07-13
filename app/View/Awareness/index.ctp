<!-- <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.12.1/TweenMax.min.js"></script> -->

<!-- <h2>Awareness</h2> -->
<style>
body.layout_awareness div#main {

  background:#fff url('/img/background_image1.jpg');
  background-size:100%;
  height:2000px;
}
body.layout_awareness div#footer {
  position:fixed;
  bottom:0;
  width:100%;
}
div#first {

-vendor-animation-duration: 4s;
-vendor-animation-delay: 2000s;
-vendor-animation-iteration-count: infinite;
}
div#second {

-vendor-animation-duration: 4s;
-vendor-animation-delay: 1500s;
-vendor-animation-iteration-count: infinite;
}
div#third {

-vendor-animation-duration: 4s;
-vendor-animation-delay: 1500s;
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

//  var jojo = $('<div>hello</div>');
//  $('#background').append(jojo);
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
      },3000);
      setTimeout(function() {
        partTwo(data);
      },3000);

      setTimeout(function() {
        $('#second').remove();
      },5000);
      setTimeout(function() {
        partThree();
      },5000);

      // setTimeout(function() {
      //   $('#three').remove();
      // },000);
      setTimeout(function() {
        partFour();
      },7000);

      setTimeout(function() {
        $('#three').remove();
        $('#four').remove();
      },9000);
      setTimeout(function() {
        partFive(data);
      },9000);

      setTimeout(function() {
        $('#five').remove();
      },13000);
      setTimeout(function() {
        partSix();
      },13000);

      setTimeout(function() {
        $('#six').remove();
      },18000);
      setTimeout(function() {
        partSeven();
      },18000);

      setTimeout(function() {
        $('#seven').remove();
      },21000);
      setTimeout(function() {
        partEight();
      },21000);


    });

    function partOne(){
      var FIRST = $('<div class="col-md-offset-2 col-md-8 col-md-offset-2" id="first">'+
      '<h1 style="font-size:80px">Are you aware that</h1></div>');
      $('#background').append(FIRST);
      $('#first').addClass('animated zoomIn');
    }

    function partTwo(data){
      var FIRST = $('<div class="col-md-offset-2 col-md-8 col-md-offset-2" id="second">'+
      '<h1 style="font-size:100px">there are '+data+' carers</h1></div>');
      $('#background').append(FIRST);
      $('#second').addClass('animated bounceInUp');
    }
    function partThree(){
      var FIRST = $('<div class="col-md-offset-2 col-md-8 col-md-offset-2" id="three">'+
      '<h1 style="font-size:90px">with same age as you </h1> </div>');
      $('#background').append(FIRST);
      $('#three').addClass('animated bounceInLeft');
    }

    function partFour(){
      var FIRST = $('<div class="col-md-offset-2 col-md-8 col-md-offset-2" id="four">'+
      '<h1 style="font-size:90px">and from your state</h1></div>');
      $('#background').append(FIRST);
      $('#four').addClass('animated bounceInRight');
    }
    function partFive(){
      var FIRST = $('<div class="col-md-offset-2 col-md-8 col-md-offset-2" id="five">'+
      '<h1 style="font-size:80px">In fact, there are 2.7 million carers in the whole country.</h1></div>');
      $('#background').append(FIRST);
      $('#five').addClass('animated rotateInDownLeft');
    }
    function partSix(data){
      var FIRST = $('<div class="col-md-offset-2 col-md-8 col-md-offset-2" id="six">'+
      '<h1 style="font-size:80px">Who take care of 4.2 million disabled people all over Australia.</h1></div>');
      $('#background').append(FIRST);
      $('#six').addClass('animated rotateInDownRight');
    }
    function partSeven(){
      var FIRST = $('<div class="col-md-offset-2 col-md-8 col-md-offset-2" id="seven">'+
      '<h1 style="font-size:80px">This community makes almost 1/3 of the country\'s population.  </h1></div>');
      $('#background').append(FIRST);
      $('#seven').addClass('animated bounceInDown');
    }
    function partEight(){
      var FIRST = $('<div class="col-md-offset-2 col-md-8 col-md-offset-2" id="eight">'+
      '<h1 style="font-size:50px">Share this post to increase the awareness about this community.'+
      ' Or, register to be able to contribute to this community.</h1>'+
      '<div class="col-md-12">'+
      '<div class="col-md-6">'+
      '<button type="button" id="share" onClick="doShare()" class="col-md-6 btn btn-primary btn-lg" ><i class="fa fa-facebook"></i> Share</button></div>'+
      '<div class="col-md-6">'+
      '<button type="button" id="register" onClick="doRegister()" class="col-md-6 btn btn-primary btn-lg""><i class="fa fa-user"></i> Register</button></div></div>');
      $('#background').append(FIRST);
      $('#eight').addClass('animated bounceInUp');
    }




}

function doShare(){
  window.location = "http://www.facebook.com/sharer.php";
}

function doRegister(){
  window.location = "http://empowered.net.au/register";
}

</script>
