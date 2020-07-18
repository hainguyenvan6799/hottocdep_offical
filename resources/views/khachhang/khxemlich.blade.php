<!DOCTYPE html>
<html>
<head>
	<title></title>
    <base href="{{asset('')}}">
</head>
<body>
	@foreach($lichdat as $ld)
	@if($ld->hienthi == 1 && $ld->ngay >= Carbon\Carbon::now('Asia/Ho_Chi_Minh')->toDateString() && $ld->hoanthanhlich != 1)
		<div class="border border-success rounded p-3 my-3">
             <h3>{{$ld->tenkhachhang}}</h3>

             <p>Ngày: {{date( 'd-m-y' ,strtotime($ld->ngay))}} Thời gian: {{ $ld->thoigian }}</p>
             <p>Dịch vụ: {{$ld->dichvu->tendichvu}}</p>
             <p>Mã lịch: {{$ld->malichdat}}- Giá: {{$ld->dichvu->gia}}Đ</p>

             @if($ld->dathanhtoan == 0)
             <p>Bạn chưa thanh toán ?<a href="{{route('getThanhtoan', ['lichdat_id'=>$ld->malichdat])}}" class="text-danger">Nhấn vào đây để thanh toán online</a></p>
             @else
             <p class="text-success">Bạn đã thanh toán. Nếu bạn hủy lịch, chúng tôi chỉ hoàn lại 80% số tiền ban đầu.(Đối với thanh toán trước khi sử dụng dịch vụ.)</p>
             @endif

             <input type="button" class="btn btn-warning mr-2" readonly="readonly" value="{{$ld->cuahang->tencuahang}}" />
             <input type="button" class="btn btn-warning mr-2" readonly="readonly" value="Nhân viên: {{$ld->nhanvien->user->name}}"/>
             
             @if($ld->ngay == Carbon\Carbon::now('Asia/Ho_Chi_Minh')->toDateString() && $ld->thoigian <= Carbon\Carbon::now('Asia/Ho_Chi_Minh')->hour)
             <p class="text-danger">Bạn đã bị lỡ lịch. Nếu bạn đã thanh toán, vui lòng liên hệ admin để hủy lịch và hoàn tiền.</p>
             @else
                @if($ld->dangthuchien == 1)
                    <input type="button" class="btn btn-success" name="" value="Đang thực hiện dịch vụ." readonly="">
                @else
                    <a href="formDatLich/{{$ld->id}}" class="btn btn-primary mr-1">Sửa</a>
                    <?php 
                        $hour = (int)$ld->thoigian;
                        $nowhour = Carbon\Carbon::now('Asia/Ho_Chi_Minh')->hour;
                        $nowminute = Carbon\Carbon::now('Asia/Ho_Chi_Minh')->minute;
                        $deltahour = $hour - $nowhour;
                        if($nowminute > 0)
                        {
                            $deltahour = $deltahour - 1;
                            $deltaminute = 60 - $nowminute;
                        }
                        $totalinminutes = $deltahour * 60 + $deltaminute;
                    ?>
                    
                    
                    @if($totalinminutes <= 180 && $ld->ngay == Carbon\Carbon::now('Asia/Ho_Chi_Minh')->toDateString())
                    <p>Còn {{$deltahour}} giờ {{$deltaminute}} phút là đến giờ cắt tóc của quý khách.</p>
                    @else
                    <a class="btn btn-danger khhuylich" href="khachhang/huylich/{{$ld->id}}">Hủy</a>
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