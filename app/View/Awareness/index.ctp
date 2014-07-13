<!-- <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.12.1/TweenMax.min.js"></script> -->

<!-- <h2>Awareness</h2> -->
<style>
body.layout_awareness div#main {
  background: url('/img/background_image1.jpg');
  background-size:100%;
}
</style>
<?php
// print_r($data);
?>
<div class="col-md-12" id="background">
<div class="col-md-offset-1 col-md-5 col-md-offset-6">
<h1 id="right">Please enter you age</h1>
<input id="rightInput"class="form-control" placeholder="Age"/>
<h1 id="left">Please select your gender</h1>
<select class="form-control" id="leftSel">
  <option value="male">Male</option>
  <option value="female">Female</option>
</select>
<h1 id="rightState">State</h1>
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
  var blah = $('#rightStateSel').val()+" and "+ $('#rightInput').val();
  alert(blah);

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
      alert(data);
    });


}
</script>
