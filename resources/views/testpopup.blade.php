<html>

<head>

<title>Simple jQuery Popup</title>

<style>

.popup{

    position: absolute;

    background: white;

    border: 1px solid gray;

    z-index: 10000;

    box-shadow: 3px 3px gray;

}

#background{

    position: absolute;

    background: gray;

    left: 0px;

    top: 0px;

}

a.close{

    text-decoration: none;

    float: right;

}

</style>

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.pack.js"></script>

<script>

$(document).ready(function() {

    $(".popup").hide();

    $("#button1").click(function(e) {

        openPopup();

    });

    $(".close").click(function (e) {

        closePopup();

        e.preventDefault();

    });

    $("#background").click(function () {

        closePopup();

    });

});

function openPopup(){

    var dheight = document.body.clientHeight;

    var dwidth = document.body.clientWidth;

    $("#background").width(dwidth).height(dheight);

    $("#background").fadeTo("slow",0.8);

    var $popup1=$("#popup1");

    $popup1.css("top", (dheight-$popup1.height())/2);

    $popup1.css("left",(dwidth-$popup1.width())/2);

    $popup1.fadeIn();

}

function closePopup(){

    $("#background").fadeOut();

    $(".popup").hide();

}

</script>

</head>

<body>

<button id="button1">Open Popup</button>
<a href="abc.html" id="button1">Open</a>

<!-- POPUP CONTENT -->

<div id="popup1" class="popup" style="width:300px;height:200px;">

<div style="background:lavender;">Title<a href="#" class="close"/>x</a></div>

<div align="center" style="margin-top:20px">

Your content here.<br/>

    <img src="Face_Yahoo.png"/>

</div>

<!-- END POPUP CONTENT -->

</div>


<div id="background"></div>


</body>

</html>