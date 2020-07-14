@extends('layouts.index')

@section('style')
	<style type="text/css">
		* {
	    margin: 0;
	    padding: 0;
		}
		body {
		font-size: 20px;
	    font-family: montserrat, arial, verdana;
	    background-color: white;
	    overflow-x: hidden;
	    transition: all 300ms linear; 
		}

		#msform {
		    text-align: center;
		    position: relative;
		    margin-top: 30px;
		    width: 100%;
		    height: 700px;
		    margin-bottom: 30px;
		    padding: 15px;

		}
		#msform fieldset {
		    background: white;
		    border: 0 none;
		    border-radius: 0px;
		    box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
		    padding: 20px 30px;
		    box-sizing: border-box;
		    width: 80%;
		    margin: 0 10%;
		    border: 1px solid black;
		    height: auto;

		    /*stacking fieldsets above each other*/
		    position: relative;
		}
		/*Nêu không phải fieldset đầu tiên thì ẩn nó đi*/
		#msform fieldset:not(:first-of-type) { 
		    display: none;
		}
		#msform input, #msform textarea, #msform select{
		    padding: 15px;
		    border-radius: 5px;
		    margin-bottom: 10px;
		    width: 100%;
		    box-sizing: border-box;
		    font-family: montserrat;
		    color: #2C3E50;
		    font-size: 20px;
		}
		#msform input:focus, #msform select:focus{
		    -moz-box-shadow: none !important;
		    -webkit-box-shadow: none !important;
		    box-shadow: none !important;
		    border: 1px solid #ee0979;
		    outline-width: 0;
		    transition: All 0.5s ease-in;
		    -webkit-transition: All 0.5s ease-in;
		    -moz-transition: All 0.5s ease-in;
		    -o-transition: All 0.5s ease-in;
		}

		/*chỉnh css cho các nút next previous*/
		#msform .action-button {
		    width: 100px;
		    background: #ee0979;
		    font-weight: bold;
		    color: white;
		    border: 0 none;
		    border-radius: 25px;
		    cursor: pointer;
		    padding: 10px 5px;
		    margin: 10px 5px;
		}
		#msform .action-button:hover, #msform .action-button:focus {
		    box-shadow: 0 0 0 2px white, 0 0 0 3px #ee0979;
		}
		#cuahang{
			margin-top: 15px;
		}
		#msform .action-button-previous {
		    width: 100px;
		    background: #C5C5F1;
		    font-weight: bold;
		    color: white;
		    border: 0 none;
		    border-radius: 25px;
		    cursor: pointer;
		    padding: 10px 5px;
		    margin: 10px 5px;
		}
		#msform .action-button-previous:hover, #msform .action-button-previous:focus {
		    box-shadow: 0 0 0 2px white, 0 0 0 3px #C5C5F1;
		}
		.fs-title {
		    font-size: 18px;
		    text-transform: uppercase;
		    color: #2C3E50;
		    margin-bottom: 10px;
		    letter-spacing: 2px;
		    font-weight: bold;
		}

		/*progress bar*/
		#progressbar {
		    margin-bottom: 30px;
		    overflow: hidden;
		    /*CSS counters to number the steps*/
		    counter-reset: step;
		}
		#progressbar li {
		    list-style-type: none;
		    color: white;
		    text-transform: uppercase;
		    font-size: 9px;
		    width: 25%;
		    float: left;
		    position: relative;
		    letter-spacing: 1px;
		}
		#progressbar li:before {
		    content: counter(step);
		    counter-increment: step;
		    width: 24px;
		    height: 24px;
		    line-height: 26px;
		    display: block;
		    font-size: 12px;
		    color: #333;
		    background: white;
		    border-radius: 25px;
		    margin: 0 auto 10px auto;
		}
		#progressbar li.active:before, #progressbar li.active:after {
		    background: #ee0979;
		    color: white;
		}

		@import url('https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&subset=devanagari,latin-ext');
			[type="checkbox"]:checked,
[type="checkbox"]:not(:checked),
[type="radio"]:checked,
[type="radio"]:not(:checked){
	position: absolute;
	left: -9999px;
	width: 0;
	height: 0;
	visibility: hidden;
}
.checkbox-tools:checked + label,
.checkbox-tools:not(:checked) + label{
	position: relative;
	display: inline-block;
	padding: 20px;
	width: 110px;
	font-size: 14px;
	line-height: 20px;
	letter-spacing: 1px;
	margin: 0 auto;
	margin-left: 5px;
	margin-right: 5px;
	margin-bottom: 10px;
	text-align: center;
	border-radius: 4px;
	overflow: hidden;
	cursor: pointer;
	text-transform: uppercase;
	color: var(--white);
	-webkit-transition: all 300ms linear;
	transition: all 300ms linear; 
}
.checkbox-tools:not(:checked) + label{
	background-color: black;
	color: white;
	box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.1);
}
.checkbox-tools:checked + label{
	background-color: green;
	color: black;
	box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
}
.checkbox-tools:not(:checked) + label:hover{
	box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
}
.checkbox-tools:checked + label::before,
.checkbox-tools:not(:checked) + label::before{
	position: absolute;
	content: '';
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	border-radius: 4px;
	background-image: linear-gradient(298deg, var(--red), var(--yellow));
	z-index: -1;
}
.checkbox-tools:checked + label .uil,
.checkbox-tools:not(:checked) + label .uil{
	font-size: 24px;
	line-height: 24px;
	display: block;
	padding-bottom: 10px;
}
	</style>
@endsection

@section('csslink')
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1462889/unicons.css">	
@endsection

@section('content')
<div class="container" style="background-color: gray;"	>
	<center><h1>Đặt Lịch Cắt Tóc Nhanh Nào!!!</h1></center>
	<div class="row">
        <form id="msform">
            <!-- progressbar -->
            <ul id="progressbar">
                <li class="active">Chọn cửa hàng</li>
                <li>Chọn nhân viên</li>
                <li>Chọn giờ</li>
                <li>Chọn dịch vụ</li>
            </ul>
            <!-- fieldsets -->
            <fieldset>
                <h2 class="fs-title">Chọn Cửa Hàng</h2>
                <div id="Buoc1">

                </div>
                <input type="button" name="next" class="next action-button quaBuoc2" value="Next"/>
            </fieldset>
            <fieldset>
                <h2 class="fs-title">Chọn Nhân Viên</h2>
                
                <div id="Buoc2">
                	
                </div>
                <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                <input type="button" name="next" class="next action-button quaBuoc3" value="Next"/>
            </fieldset>
            <fieldset>
                <h2 class="fs-title">Chọn Khung Giờ</h2>
                <div id="Buoc3">
                	
                </div>
                <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                <input type="button" name="next" class="next action-button quaBuoc4" value="Next"/>
            </fieldset>
            <fieldset>
            	<h2>Chọn Dịch Vụ</h2>
            	<div id="Buoc4">

            	</div>
            	<input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
            		<input type="submit" name="submit" class="submit action-button" value="Submit"/>
            </fieldset>
        </form>
	</div>
</div>
@endsection

@section('script')
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$.get('lichdat1', function(data){
			$('#Buoc1').html(data);
		});

		$('.quaBuoc2').on('click', function(){
			var id_cuahang = $('input[name="id_cuahang"]:checked').val();
			
			$.get('lichdat2/'+id_cuahang, function(data){
				$('#Buoc2').html(data);		
			});
		});

		$('.quaBuoc3').on('click', function(){
			var id_nhanvien = $('input[name="chonnhanvien"]:checked').val();
			
			$.get('lichdat3/'+id_nhanvien, function(data){
				$('#Buoc3').html(data);		
			});
		});

		$('.quaBuoc4').on('click', function(){
			$.get('lichdat4', function(data){
				$('#Buoc4').html(data);
			});
		});


	});
</script>
<script type="text/javascript">
	
//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$(".next").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	next_fs = $(this).parent().next();
	
	//activate next step on progressbar using the index of next_fs
	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
	
	//show the next fieldset
	next_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale current_fs down to 80%
			scale = 1 - (1 - now) * 0.2;
			//2. bring next_fs from the right(50%)
			left = (now * 50)+"%";
			//3. increase opacity of next_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({
        'transform': 'scale('+scale+')',
        'position': 'absolute'
      });
			next_fs.css({'left': left, 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

$(".previous").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	previous_fs = $(this).parent().prev();
	
	//de-activate current step on progressbar
	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
	
	//show the previous fieldset
	previous_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale previous_fs from 80% to 100%
			scale = 0.8 + (1 - now) * 0.2;
			//2. take current_fs to the right(50%) - from 0%
			left = ((1-now) * 50)+"%";
			//3. increase opacity of previous_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'left': left});
			previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

$(".submit").click(function(){
	return false;
})
</script>
@endsection