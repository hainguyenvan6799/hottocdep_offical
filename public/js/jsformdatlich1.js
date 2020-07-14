
	$(document).ready(function(){
		$.get('lichdat1', function(data){
			$('#Buoc1').html(data);
		});

		$('.quaBuoc2').on('click', function(){
			var id_cuahang = $('input[name="id_cuahang"]:checked').val();
			if(id_cuahang == undefined)
			{
				$('#Buoc2').html('<h2>Bạn cần chọn cửa hàng.</h2>');
				return false;

			}
			$.get('lichdat2/'+id_cuahang, function(data){
				$('#Buoc2').html(data);
			});
		});

		$('.quaBuoc3').on('click', function(){
			var id_nhanvien = $('input[name="chonnhanvien"]:checked').val();
			if(id_nhanvien == undefined)
			{
				$('#Buoc3').html('<h2>Bạn cần chọn nhân viên.</h2>');
				return false;

			}
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
