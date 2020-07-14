@extends('layouts.index')

@section('style')
	<style>
    #container1 {
        margin-bottom: 120px;
        padding:20px;
        background-color:#f5f5f5;
    }

    .rating {
        margin-left: 30px;
    }

    div.skill {
        background: #5cb85c;
        border-radius: 3px;
        color: white;
        font-weight: bold;
        padding: 3px 4px;
        width: auto;
    }

    .skillLine {
        display: inline-block;
        width: 100%;
        min-height: 90px;
        padding: 3px 4px;
    }

    skillLineDefault {
        padding: 3px 4px;
    }
</style>
@endsection

@section('csslink')
	<!-- you need to include the shieldui css and js assets in order for the charts to work -->
	<link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light/all.min.css" />
@endsection

@section('content')
	<section class="services-section ftco-section">
		<div class="container">
			<div class="row justify-content-center pb-3">
          <div class="col-md-10 heading-section text-center ftco-animate">
          	<span class="subheading">Rating now</span>
            <h2 class="mb-4">Đánh giá về dịch vụ của chúng tôi</h2>
            <p>Giúp chúng tôi hoàn thiện hơn để mang đến nhiều trải nghiệm tốt cho khách hàng</p>
          </div>
        </div>
		</div>
	</section>

	<div class="container" id="container1">

    <div class="col-md-12">
    <form method="POST" action="postRating" id="formrating">
        {{csrf_field()}}
        <div class="card ">
            <div class="card-header">
                <h4 class="text-center">Dịch vụ<span class="glyphicon glyphicon-saved float-xs-right"></span></h4>
            </div>
            <div class="card-block text-xs-center">
                <p class="lead text-center">
                    <strong>Đánh giá các dịch vụ</strong>
                </p>
            </div>
            <ul class="list-group list-group-flush text-center" id="ykien">
                <li class="list-group-item">
                    <div class="skillLineDefault">
                        <div class="skill float-left text-center">Dịch vụ về tóc</div>
                        <div class="rating" id="rate1"></div>
                        <{{-- input type="hidden" name="diem_dichvu" id="diem_dichvu"> --}}
                    </div>
                </li>
                <li class="list-group-item text-center">
                    <div class="skillLineDefault">
                        <div class="skill float-left text-center">Thái độ nhân viên</div>
                        <div class="rating" id="rate2"></div>
                        {{-- <input type="hidden" name="diem_thaido" id="diem_thaido"> --}}
                    </div>
                </li>
                <li class="list-group-item text-center">
                    <div class="skillLineDefault">
                        <div class="skill float-left text-center">Cơ sở vật chất</div>
                        <div class="rating" id="rate3"></div>
                        {{-- <input type="hidden" name="diem_csvatchat" id="diem_csvatchat"> --}}
                    </div>
                </li>
                <li class="list-group-item text-center">
                    <div class="skillLineDefault">
                        <div class="skill float-left text-center">Wifi</div>
                        <div class="rating" id="rate4"></div>
                        {{-- <input type="hidden" name="diem_wifi" id="diem_wifi"> --}}
                    </div>
                </li>
                <li class="list-group-item text-center">
                    <div class="skillLineDefault">
                        <div class="skill float-left text-center">Ý kiến khác</div>
                        <textarea name="ykienkhac"></textarea>
                    </div>
                </li>
            </ul>
            <div class="card-footer text-xs-center">
                <input type="submit" class="btn btn-primary btn-lg btn-block" value="Gửi đánh giá">
            </div>
        </div>
    </form>
    </div>

    
</div>
@endsection

@section('script')
	<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>

	<script type="text/javascript">
	    initializeRatings();

	    function initializeRatings() {
	        $('#rate1').shieldRating({
	            max: 7,
	            step: 0.1,
	            value: 6.3,
	            markPreset: false
	        });
	        $('#rate2').shieldRating({
	            max: 7,
	            step: 0.1,
	            value: 6,
	            markPreset: false
	        });
	        $('#rate3').shieldRating({
	            max: 7,
	            step: 0.1,
	            value: 4.5,
	            markPreset: false
	        });
	        $('#rate4').shieldRating({
	            max: 7,
	            step: 0.1,
	            value: 5,
	            markPreset: false
	        });
	    }
        $('#formrating').on('submit', function(){
             var a = $('#rate1').swidget().value();
              var b = $('#rate2').swidget().value();
              var c = $('#rate3').swidget().value();
              var d = $('#rate4').swidget().value();
              
            $('#formrating').append('<input type="hidden" name="diem_dichvu" id="diem_dichvu" value="'+ a +'"/><input type="hidden" name="diem_thaido" id="diem_thaido" value="'+ b +'"/><input type="hidden" name="diem_csvatchat" id="diem_csvatchat" value="'+ c +'"/><input type="hidden" name="diem_wifi" id="diem_wifi" value="'+ d +'"/>');
        });
            
	</script>
@endsection