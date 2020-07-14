<!DOCTYPE html>
<html>
<head>
    <title>Đặt lịch cắt tóc nào</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
<base href="{{asset('')}}">

{{-- public/css/cssformdatlich.css --}}
    <link rel="stylesheet" type="text/css" href="{{URL::to('css/cssformdatlich.css')}}">
{{-- public/css/cssformdatlich.css --}}
</head>
<body style="background-image: url('admin_asset/images/bg-1.jpg');">
    <h1><a href="index">Quay về trang chủ</a></h1>
    <h1 class="text-center" style="color: white;">Đặt lịch cắt tóc</h1>
<!-- MultiStep Form -->
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <form id="msform">
            <!-- progressbar -->
            <ul id="progressbar">
                <li class="active">Chọn cửa hàng</li>
                <li>Chọn nhân viên</li>
                <li>Chọn lịch</li>
            </ul>
            <!-- fieldsets -->
            <fieldset>
                <h2 class="fs-title">Chọn cửa hàng</h2>
                <h3 class="fs-subtitle">Chọn cửa hàng gần nhất mà bạn muốn.</h3>
                <div id="Buoc1">
                    <h2>Bạn cần chọn</h2>
                </div>
                <input type="button" name="next" class="next action-button quaBuoc2" value="Next"/>
            </fieldset>
            <fieldset>
                <h2 class="fs-title">Chọn nhân viên</h2>
                <h3 class="fs-subtitle">Nhân viên toàn trai xinh, gái đẹp cả thôi.</h3>

                <div id="Buoc2">
                    
                </div>

                {{-- <div class="nhanvien">
                    <input type="radio" name="chonnhanvien" id="" class="chonnhanvien checkbox-tools" value="abc" />

          <label class="for-checkbox-tools" for=""><i class="uil uil-line-alt"></i><img src="{{URL::to('images/nhanvien/kai-seidler.jpg')}}" alt="123"><h2>abc</h2></label>
                </div> --}}

                <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                <input type="button" name="next" class="next action-button quaBuoc3" value="Next"/>
            </fieldset>
            <fieldset>
                <h2 class="fs-title">Chọn lịch</h2>
                <h3 class="fs-subtitle">Chọn lịch mà bạn mong muốn</h3>
                <div id="Buoc3">
                    
                </div>
                <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                <input type="submit" name="submit" class="submit action-button" value="Submit"/>
            </fieldset>
        </form>
        <!-- link to designify.me code snippets -->
        
        <!-- /.link to designify.me code snippets -->
    </div>
</div>
<!-- /.MultiStep Form -->
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script type="text/javascript">    
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
});

</script>
</html>




