<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.12.1/TweenMax.min.js"></script>

<h2>Awareness</h2>

<p>Hello world</p>
<p>Hello world</p>
<p>Hello world</p>
<style>
body{
    background-color:#000;
}
#demo {
    width: 692px;
    height: 70px;
    background-color: #333;
    padding: 8px;
}
#bar{
    background-color:#91e500;
    color:black;
    position:relative;
    width:60px;
    height:10px;
    }
#logo {
    position: relative;
    width: 60px;
    height: 60px;
    background: url(img/logo_black.jpg) no-repeat;
}
</style>
<script>
//we'll use a window.onload for simplicity, but typically it is best to use either jQuery's $(document).ready() or $(window).load() or cross-browser event listeners so that you're not limited to one.
window.onload = function() {
    var logo = document.getElementById("logo"),
        bar = document.getElementById("bar");

    TweenLite.to(bar, 2, {width:"692px"});
    TweenLite.to(logo, 2, {left:"632px", delay:1});
}
</script>

 <div id="bar"></div>
 <div id="yo">jhdfjhs</div>
 <div id="bar"></div>
