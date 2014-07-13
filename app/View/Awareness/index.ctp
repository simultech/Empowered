<!-- <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.12.1/TweenMax.min.js"></script> -->

<!-- <h2>Awareness</h2> -->
<style>
body.layout_awareness div#main {
  background:white;
}
</style>
<div class="col-md-12">
<div class="col-md-offset-3 col-md-6 col-md-offset-3">
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

<button type="button" class="btn btn-primary btn-lg btn-block">Submit</button>
</div>
</div>


<script type='text/javascript'>
$('#right').addClass('animated bounceInRight');
$('#rightInput').addClass('animated bounceInRight');
$('#rightState').addClass('animated bounceInRight');
$('#rightStateSel').addClass('animated bounceInRight');
$('#left').addClass('animated bounceInLeft');
$('#leftSel').addClass('animated bounceInLeft');
</script>
