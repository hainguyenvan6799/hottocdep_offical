<base href="{{asset('')}}">
<style type="text/css">
	.selected-option{
		font-size: 15px;
		background-color: pink;
		color: black;
	}
	.popup {
  position: relative;
  display: inline-block;
  cursor: pointer;
}

/* The actual popup (appears on top) */
.popup .popuptext {
  visibility: hidden;
  width: 450px;
  height: 450px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 8px 0;
  position: absolute;
  z-index: 9999;
  bottom: 125%;
  left: 50%;
  margin-left: -80px;
}

/* Popup arrow */
.popup .popuptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

/* Toggle this class when clicking on the popup container (hide and show the popup) */
.popup .show {
  visibility: visible;
  -webkit-animation: fadeIn 1s;
  animation: fadeIn 1s
}

/* Add animation (fade in the popup) */
@-webkit-keyframes fadeIn {
  from {opacity: 0;}
  to {opacity: 1;}
}

@keyframes fadeIn {
  from {opacity: 0;}
  to {opacity:1 ;}
}
	
</style>
<div class="row">
		<select name="thanhpho" id="chon_thanhpho" class="tieude">

			<option selected="" class="selected-option">Chọn Tỉnh/TP</option>
			@foreach($thanhpho as $tp)
				<option class="selected-option">{{$tp['thanhpho']}}</option>
			@endforeach
			
		</select>
		<select name="quan" id="chon_quan" class="tieude">
			<option selected="">Chọn Quận/Huyện</option>
		</select>

		<h2 id="thongbao" style="color: white;">Bạn hãy chọn tỉnh và thành phố</h2>

		
		<div id="cuahang" class="col-md-12" style="display: none;">
			
		</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		if(navigator.geolocation){
			navigator.geolocation.getCurrentPosition(function(position){
				var pos = {
					lat: position.coords.latitude,
					lng: position.coords.longitude
				};
				$.get('ajax/choncuahang/0/0/'+pos.lat+'/'+pos.lng, function(data)
				{
					$('#cuahang').html(data);
				});

				$('#chon_thanhpho').on('change', function(){
			//alert($(this).val());
			$.get('ajax/chonthanhpho/'+$(this).val(), function(text){
				$('#chon_quan').append(text);
			});
		});

		$('#chon_quan').on('change', function(){
			$.get('ajax/choncuahang/'+$('#chon_thanhpho').val()+'/'+$(this).val()+'/'+pos.lat+'/'+pos.lng,function(text){
				$('#thongbao').css('display', 'none');
				$('#cuahang').css('display', 'block');
				$('#cuahang').html(text);
			});
		});
			});
		}


	});
</script>
