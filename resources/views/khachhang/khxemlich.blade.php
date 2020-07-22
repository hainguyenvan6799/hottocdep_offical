<?php 
	$now = Carbon\Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
	$now_hour = Carbon\Carbon::now('Asia/Ho_Chi_Minh')->hour;
	$now_minute = Carbon\Carbon::now('Asia/Ho_Chi_Minh')->minute;

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<base href="{{asset('')}}">
</head>
<body>
	@foreach($lichdat as $ld)
		{{-- Các lịch đặt kể từ ngày hôm nay và kể từ giờ hiện tại của hệ thống --}}
		@if($ld->ngay >= $now && $ld->thoigian >= $now_hour)
		<div class="border border-success rounded p-3 my-3">
		<h3>{{$ld->tenkhachhang}}</h3>

        <p>Ngày: {{date( 'd-m-y' ,strtotime($ld->ngay))}} Thời gian: {{ $ld->thoigian }}</p>
        <p>Dịch vụ: {{$ld->dichvu->tendichvu}}</p>
        <p>Mã lịch: {{$ld->malichdat}}- Giá: {{$ld->dichvu->gia}}Đ</p>
			{{-- Khách hàng chưa xác nhận lịch đặt --}}
			@if($ld->hienthi == 0)
				<h3>Chọn hình thức xác nhận lịch đặt</h3>
			    <a class="btn btn-success" href="resendemaillichdat/{{$ld->malichdat}}">Nhấn vào để xác thực bằng Email</a><br>
			    <a class="btn btn-success" href="resendcodeotplichdat/{{$ld->malichdat}}">Nhấn vào để xác thực bằng OTP số điện thoại</a>
			@elseif($ld->hienthi == 1)
				@if($ld->hoanthanhlich == 1) 

					@if($ld->dathanhtoan == 1)
						<input type="button" class="btn btn-success" name="" value="Đã hoàn thành lịch đặt. Xin cảm ơn" readonly="">
					@else
						<p>Bạn chưa thanh toán ?<a href="{{route('getThanhtoan', ['lichdat_id'=>$ld->malichdat])}}" class="text-danger">Nhấn vào đây để thanh toán online</a></p>
					@endif

				@else
					{{-- Kiểm tra đã thanh toán hay chưa --}}
					@if($ld->dathanhtoan == 1)
						<p class="text-success">Bạn đã thanh toán. Nếu bạn hủy lịch, chúng tôi chỉ hoàn lại 80% số tiền ban đầu.(Đối với thanh toán trước khi sử dụng dịch vụ.)</p>
					@else
						<p>Bạn chưa thanh toán ?<a href="{{route('getThanhtoan', ['lichdat_id'=>$ld->malichdat])}}" class="text-danger">Nhấn vào đây để thanh toán online</a></p>
					@endif

					{{-- Kiểm tra có đang trong quá trình thực hiện hay không --}}
					@if($ld->dangthuchien == 1)
						{{-- Khi lịch đặt đang được thực hiện thì không được hủy hoặc sửa lịch --}}
						<input type="button" class="btn btn-success" name="" value="Lịch đặt đang được thực hiện" readonly=""><br>
					@else
					<?php 
						$delta_hour = (int)$ld->thoigian - $now_hour;
						$delta_minute = 0;
						if($now_minute > 0){
							$delta_hour = $delta_hour - 1;
							$delta_minute = 60 - $now_minute;
						}
						$total_delta_minute = $delta_hour * 60 + $delta_minute;
						$arr1 = explode('-', $ld->ngay);
						$tgianlichdat = Carbon\Carbon::parse($ld->ngay . (int)$ld->thoigian . ':00');
						dd($tgianlichdat);
					?>
						@if($ld->ngay == $now && $ld->thoigian <= $now_hour)
							<p class="text-danger">Bạn đã bị lỡ lịch. Nếu bạn đã thanh toán, vui lòng liên hệ admin để hủy lịch và hoàn tiền.</p>
						@elseif($ld->ngay == $now && $total_delta_minute <= 180)
							<p>Còn {{$delta_hour}} giờ {{$delta_minute}} phút là đến giờ cắt tóc của quý khách.</p>
						@else
							<a href="formDatLich/{{$ld->malichdat}}" class="btn btn-primary mr-1">Sửa</a>
							<a class="btn btn-danger khhuylich" href="khachhang/huylich/{{$ld->malichdat}}">Hủy</a>
						@endif

							

						{{--  --}}
					@endif

				@endif

			@endif
		</div>
		@endif
	@endforeach
</body>
<script type="text/javascript">
	
	$(document).ready(function(){
		$('.khhuylich').on('click', function(){
        if(confirm('Bạn có chắc chắn muốn hủy?'))
        {
          return true;
        }
        else
        {
          return false;
        }
      });
	});
</script>
</html>
</html>

					

