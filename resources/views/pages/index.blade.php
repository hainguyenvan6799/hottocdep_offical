@extends('layouts.index')
@section('title')
  <title>Trang Chủ</title>
@endsection

@section('content')
	<section class="hero-wrap js-fullheight" style="background-image: url(admin_asset/images/bg-2.jpg);" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight justify-content-center align-items-center">
          <div class="col-lg-12 ftco-animate d-flex align-items-center">
          	<div class="text text-center">
          		<span class="subheading">Chào mừng đến với Haircare</span>
		  				<h1 class="mb-4">Chúng tôi là những chuyên gia chăm sóc tóc của bạn</h1>
		  				{{-- <p><a href="{{URL::to('formDatLich')}}" class="btn btn-primary btn-outline-primary px-4 py-2">Đặt lịch ngay!!!</a></p> --}}
							</div>
            </div>
          </div>
        </div>
      </div>
    </section>
		
		<section class="ftco-section ftco-no-pt ftco-no-pb">
			<div class="container-fluid px-0">
				<div class="row no-gutters">
					<div class="col-md text-center d-flex align-items-stretch">
						<div class="services-wrap d-flex align-items-center img" style="background-image: url(admin_asset/images/formen.jpg);">
							<div class="text">
								<h3>For Men</h3>
								<p><a href="#" class="btn-custom">See pricing <span class="ion-ios-arrow-round-forward"></span></a></p>
							</div>
						</div>
					</div>
					<div class="col-md-3 text-center d-flex align-items-stretch">
						<div class="text-about py-5 px-4">
							<h1 class="logo">
								<a href="#"><span class="flaticon-scissors-in-a-hair-salon-badge"></span>Haircare</a>
							</h1>
							<h2>Welcome to our Salon</h2>
							<p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
							<p class="mt-3"><a href="#" class="btn btn-primary btn-outline-primary">Read more</a></p>
						</div>
					</div>
					<div class="col-md text-center d-flex align-items-stretch">
						<div class="services-wrap d-flex align-items-center img" style="background-image: url(admin_asset/images/forwomen.jpg);">
							<div class="text">
								<h3>For Women</h3>
								<p><a href="#" class="btn-custom">See pricing <span class="ion-ios-arrow-round-forward"></span></a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
    
    <section class="services-section ftco-section">
      <div class="container">
      	<div class="row justify-content-center pb-3">
          <div class="col-md-10 heading-section text-center ftco-animate">
          	<span class="subheading">Services</span>
            <h2 class="mb-4">Services Menu</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
          </div>
        </div>
        <div class="row no-gutters d-flex">
          <div class="col-md-6 col-lg-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services d-block text-center">
              <div class="icon"><span class="flaticon-male-hair-of-head-and-face-shapes"></span></div>
              <div class="media-body">
                <h3 class="heading mb-3">Haircut &amp; Styling</h3>
                <p>A small river named Duden flows by their place and supplies.</p>
              </div>
            </div>    
          </div>
          <div class="col-md-6 col-lg-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services d-block text-center">
              <div class="icon"><span class="flaticon-beard"></span></div>
              <div class="media-body">
                <h3 class="heading mb-3">Beard</h3>
                <p>A small river named Duden flows by their place and supplies.</p>
              </div>
            </div>      
          </div>
          <div class="col-md-6 col-lg-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services d-block text-center">
              <div class="icon"><span class="flaticon-beauty-products"></span></div>
              <div class="media-body">
                <h3 class="heading mb-3">Makeup</h3>
                <p>A small river named Duden flows by their place and supplies.</p>
              </div>
            </div>      
          </div>
          <div class="col-md-6 col-lg-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services d-block text-center">
              <div class="icon"><span class="flaticon-healthy-lifestyle-logo"></span></div>
              <div class="media-body">
                <h3 class="heading mb-3">Body Treatment</h3>
                <p>A small river named Duden flows by their place and supplies.</p>
              </div>
            </div>      
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section ftco-booking bg-light">
    	<div class="container ftco-relative">
    		<div class="row justify-content-center pb-3">
          <div class="col-md-10 heading-section text-center ftco-animate">
          	<span class="subheading">Booking</span>
            <h2 class="mb-4">Đặt lịch nào!!!</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
          </div>
        </div>
        <h3 class="vr">Call Us: 012-3456-7890</h3>
    		<div class="row justify-content-center">
    			<div class="col-md-10 ftco-animate">
    				<form action="{{URL::to('formDatLich')}}" class="appointment-form" method="get">
              {{csrf_field()}}
	            <div class="row">
	              <div class="col-sm-8" style="margin: auto;">
                
		            <div class="form-group">
				          <input type="tel" class="form-control" id="appointment_sdt" name="appointment_sdt" placeholder="Nhập số điện thoại để đặt lịch..." value="{{Auth::check() ? Auth::user()->sdt : ''}}" readonly="readonly">
				        </div>
                <div class="form-group">
                  @if(Auth::check())
                    <input type="hidden" name="sdt" value="{{Auth::user()->sdt}}">
                    <?php 
                    $now = Carbon\Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
                    $countHuy = count(App\LichDat::where('sdt', Auth::user()->sdt)->where('khhuydon', 1)->where('ngay','>=',$now)->get());
                    session()->put('countHuy', $countHuy);

                      if($countHuy >= 2){?>
                        <input type="submit" value="Bạn đã hủy lịch quá 2 lần. Vui lòng liên hệ admin để được Hủy khóa" class="btn btn-primary rounded" disabled="">

                    <?php } else{?>
                        <input type="submit" value="Đặt ngay." class="btn btn-primary rounded">                        
                    <?php } ?>

                    @if(count(App\LichDat::all()) > 0)
                <button type="button" class="btn btn-primary rounded btn-lg" data-toggle="modal" data-target="#myModal" id="nutxemlich">Xem lại lịch đặt</button>
                    @endif
                @else
                <p>Hãy đăng nhập và kéo xuống đây để đặt lịch nào?</p>
                @endif
              </div>
              
				    </div>
	              </div>
		          </div>
	          </form>
    			</div>
    		</div>
    	</div>
    </section>

    {{-- modal xem lịch đặt --}}

    <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <center><h4 class="modal-title">Xem lại lịch đặt</h4></center>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body" id="xemlaiLich">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

  {{-- modal xem lịch đặt --}}


    <section class="ftco-section ftco-team">
    	<div class="container-fluid px-md-5">
    		<div class="row justify-content-center pb-3">
          <div class="col-md-10 heading-section text-center ftco-animate">
          	<span class="subheading">Artistic Director</span>
            <h2 class="mb-4">Makeup Artist</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
          </div>
        </div>
        <div class="row">
        	<div class="col-md-12 ftco-animate">
        		<div class="carousel-team owl-carousel">
        			<div class="item">
		        		<a href="#" class="team text-center">
		        			<div class="img" style="background-image: url(admin_asset/images/stylist-1.jpg);"></div>
		        			<h2>Danica Lewis</h2>
		        			<span class="position">Hair Stylist</span>
		        		</a>
        			</div>
        			<div class="item">
	        			<a href="#" class="team text-center">
		        			<div class="img" style="background-image: url(admin_asset/images/stylist-2.jpg);"></div>
		        			<h2>Nicole Simon</h2>
		        			<span class="position">Nail Master</span>
		        		</a>
	        		</div>
	        		<div class="item">
	        			<a href="#" class="team text-center">
		        			<div class="img" style="background-image: url(admin_asset/images/stylist-3.jpg);"></div>
		        			<h2>Cloe Meyer</h2>
		        			<span class="position">Director</span>
		        		</a>
	        		</div>
	        		<div class="item">
	        			<a href="#" class="team text-center">
		        			<div class="img" style="background-image: url(admin_asset/images/stylist-4.jpg);"></div>
		        			<h2>Rachel Clinton</h2>
		        			<span class="position">Hair Stylist</span>
		        		</a>
	        		</div>
	        		<div class="item">
	        			<a href="#" class="team text-center">
		        			<div class="img" style="background-image: url(admin_asset/images/stylist-5.jpg);"></div>
		        			<h2>Dave Buff</h2>
		        			<span class="position">Barber</span>
		        		</a>
	        		</div>
        		</div>
        	</div>
        </div>
    	</div>
    </section>

    <section class="ftco-section ftco-no-pt ftco-no-pb">
    	<div class="container">
    		<div class="row no-gutters justify-content-center mb-5 pb-2">
          <div class="col-md-6 text-center heading-section ftco-animate">
          	<span class="subheading">Gallery</span>
            <h2 class="mb-4">Our gallery</h2>
            <p>Separated they live in. A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
          </div>
        </div>
    	</div>
			<div class="container-fluid p-0">
    		<div class="row no-gutters">
    			<div class="col-md-6 col-lg-3 ftco-animate">
    				<div class="project">
	    				<img src="admin_asset/images/work-1.jpg" class="img-fluid" alt="Colorlib Template">
	    				<div class="text">
	    					<span>Stylist</span>
	    					<h3><a href="project.html">Beard</a></h3>
	    				</div>
	    				<a href="admin_asset/images/work-1.jpg" class="icon image-popup d-flex justify-content-center align-items-center">
	    					<span class="icon-expand"></span>
	    				</a>
    				</div>
    			</div>
    			<div class="col-md-6 col-lg-3 ftco-animate">
    				<div class="project">
	    				<img src="admin_asset/images/work-2.jpg" class="img-fluid" alt="Colorlib Template">
	    				<div class="text">
	    					<span>Beauty</span>
	    					<h3><a href="project.html">Haircut</a></h3>
	    				</div>
	    				<a href="admin_asset/images/work-2.jpg" class="icon image-popup d-flex justify-content-center align-items-center">
	    					<span class="icon-expand"></span>
	    				</a>
    				</div>
    			</div>
    			<div class="col-md-6 col-lg-3 ftco-animate">
    				<div class="project">
	    				<img src="admin_asset/images/work-3.jpg" class="img-fluid" alt="Colorlib Template">
	    				<div class="text">
	    					<span>Beauty</span>
	    					<h3><a href="project.html">Hairstylist</a></h3>
	    				</div>
	    				<a href="admin_asset/images/work-3.jpg" class="icon image-popup d-flex justify-content-center align-items-center">
	    					<span class="icon-expand"></span>
	    				</a>
    				</div>
    			</div>
    			<div class="col-md-6 col-lg-3 ftco-animate">
    				<div class="project">
	    				<img src="admin_asset/images/work-4.jpg" class="img-fluid" alt="Colorlib Template">
	    				<div class="text">
	    					<span>Beauty</span>
	    					<h3><a href="project.html">Haircut</a></h3>
	    				</div>
	    				<a href="admin_asset/images/work-4.jpg" class="icon image-popup d-flex justify-content-center align-items-center">
	    					<span class="icon-expand"></span>
	    				</a>
    				</div>
    			</div>
    			<div class="col-md-6 col-lg-3 ftco-animate">
    				<div class="project">
	    				<img src="admin_asset/images/work-5.jpg" class="img-fluid" alt="Colorlib Template">
	    				<div class="text">
	    					<span>Beauty</span>
	    					<h3><a href="project.html">Makeup</a></h3>
	    				</div>
	    				<a href="admin_asset/images/work-5.jpg" class="icon image-popup d-flex justify-content-center align-items-center">
	    					<span class="icon-expand"></span>
	    				</a>
    				</div>
    			</div>
    			<div class="col-md-6 col-lg-3 ftco-animate">
    				<div class="project">
	    				<img src="admin_asset/images/work-6.jpg" class="img-fluid" alt="Colorlib Template">
	    				<div class="text">
	    					<span>Fashion</span>
	    					<h3><a href="project.html">Model</a></h3>
	    				</div>
	    				<a href="admin_asset/images/work-6.jpg" class="icon image-popup d-flex justify-content-center align-items-center">
	    					<span class="icon-expand"></span>
	    				</a>
    				</div>
    			</div>
    			<div class="col-md-6 col-lg-3 ftco-animate">
    				<div class="project">
	    				<img src="admin_asset/images/work-7.jpg" class="img-fluid" alt="Colorlib Template">
	    				<div class="text">
	    					<span>Beauty</span>
	    					<h3><a href="project.html">Makeup</a></h3>
	    				</div>
	    				<a href="admin_asset/images/work-7.jpg" class="icon image-popup d-flex justify-content-center align-items-center">
	    					<span class="icon-expand"></span>
	    				</a>
    				</div>
    			</div>
    			<div class="col-md-6 col-lg-3 ftco-animate">
    				<div class="project">
	    				<img src="admin_asset/images/work-8.jpg" class="img-fluid" alt="Colorlib Template">
	    				<div class="text">
	    					<span>Beauty</span>
	    					<h3><a href="project.html">Makeup</a></h3>
	    				</div>
	    				<a href="admin_asset/images/work-8.jpg" class="icon image-popup d-flex justify-content-center align-items-center">
	    					<span class="icon-expand"></span>
	    				</a>
    				</div>
    			</div>
    		</div>
    	</div>
		</section>
		
		<section class="ftco-section ftco-pricing">
			<div class="container">
				<div class="row justify-content-center pb-3">
          <div class="col-md-10 heading-section text-center ftco-animate">
          	<span class="subheading">Pricing</span>
            <h2 class="mb-4">Our Prices</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
          </div>
        </div>
        <div class="row">
          @foreach($loaidichvu as $ldv)
        	<div class="col-md-3 ftco-animate">
        		<div class="pricing-entry pb-5 text-center">
        			<div>
	        			<h3 class="mb-4">{{$ldv->tenloai}}</h3>
	        			<p><span class="price">Giá hợp lý</span> <span class="per">/ dịch vụ</span></p>
	        		</div>
        			<ul>
                @foreach($dichvu as $dv)
                @if($dv->id_loaidichvu == $ldv->id)
        				<li>{{$dv->tendichvu}} - {{$dv->gia}}đ</li>
                @endif
                @endforeach
        			</ul>
        			<p class="button text-center"><a href="#" class="btn btn-primary px-4 py-3">Get Offer</a></p>
        		</div>
        	</div>
          @endforeach
        	{{-- <div class="col-md-3 ftco-animate">
        		<div class="pricing-entry pb-5 text-center">
        			<div>
	        			<h3 class="mb-4">Manicure Pedicure</h3>
	        			<p><span class="price">$34.50</span> <span class="per">/ session</span></p>
	        		</div>
        			<ul>
        				<li>Manicure</li>
								<li>Pedicure</li>
								<li>Coloring</li>
								<li>Nails</li>
								<li>Nail Cut</li>
        			</ul>
        			<p class="button text-center"><a href="#" class="btn btn-primary px-4 py-3">Get Offer</a></p>
        		</div>
        	</div>
        	<div class="col-md-3 ftco-animate">
        		<div class="pricing-entry active pb-5 text-center">
        			<div>
	        			<h3 class="mb-4">Makeup</h3>
	        			<p><span class="price">$54.50</span> <span class="per">/ session</span></p>
	        		</div>
        			<ul>
        				<li>Makeup</li>
								<li>Professional Makeup</li>
								<li>Blush On</li>
								<li>Facial Massage</li>
								<li>Facial Spa</li>
        			</ul>
        			<p class="button text-center"><a href="#" class="btn btn-primary px-4 py-3">Get Offer</a></p>
        		</div>
        	</div>
        	<div class="col-md-3 ftco-animate">
        		<div class="pricing-entry pb-5 text-center">
        			<div>
	        			<h3 class="mb-4">Body Treatment</h3>
	        			<p><span class="price">$89.50</span> <span class="per">/ session</span></p>
	        		</div>
        			<ul>
        				<li>Massage</li>
								<li>Spa</li>
								<li>Foot Spa</li>
								<li>Body Spa</li>
								<li>Relaxing</li>
        			</ul>
        			<p class="button text-center"><a href="#" class="btn btn-primary px-4 py-3">Get Offer</a></p>
        		</div>
        	</div> --}}
        </div>
			</div>
		</section>

		<section class="testimony-section bg-light">
      <div class="container">
        <div class="row ftco-animate justify-content-center">
        	<div class="col-md-6 col-lg-5 d-flex">
        		<div class="testimony-img" style="background-image: url(admin_asset/images/testimony-img.jpg);"></div>
        	</div>
          <div class="col-md-6 col-lg-7 py-5 pl-md-5">
          	<div class="py-md-5">
	          	<div class="heading-section ftco-animate">
	          		<span class="subheading">Testimony</span>
			          <h2 class="mb-0">Happy Customer</h2>
			        </div>
	            <div class="carousel-testimony owl-carousel ftco-animate">
	              <div class="item">
	                <div class="testimony-wrap pb-4">
	                  <div class="text">
	                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
	                  </div>
	                  <div class="d-flex">
		                  <div class="user-img" style="background-image: url(admin_asset/images/stylist-1.jpg)">
		                  </div>
		                  <div class="pos ml-3">
		                  	<p class="name">Jeff Nucci</p>
		                    <span class="position">Businessman</span>
		                  </div>
		                </div>
	                </div>
	              </div>
	              <div class="item">
	                <div class="testimony-wrap pb-4">
	                  <div class="text">
	                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
	                  </div>
	                  <div class="d-flex">
		                  <div class="user-img" style="background-image: url(admin_asset/images/stylist-2.jpg)">
		                  </div>
		                  <div class="pos ml-3">
		                  	<p class="name">Jeff Nucci</p>
		                    <span class="position">Businessman</span>
		                  </div>
		                </div>
	                </div>
	              </div>
	              <div class="item">
	                <div class="testimony-wrap pb-4">
	                  <div class="text">
	                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
	                  </div>
	                  <div class="d-flex">
		                  <div class="user-img" style="background-image: url(admin_asset/images/stylist-3.jpg)">
		                  </div>
		                  <div class="pos ml-3">
		                  	<p class="name">Jeff Nucci</p>
		                    <span class="position">Businessman</span>
		                  </div>
		                </div>
	                </div>
	              </div>
	              <div class="item">
	                <div class="testimony-wrap pb-4">
	                  <div class="text">
	                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
	                  </div>
	                  <div class="d-flex">
		                  <div class="user-img" style="background-image: url(admin_asset/images/stylist-4.jpg)">
		                  </div>
		                  <div class="pos ml-3">
		                  	<p class="name">Jeff Nucci</p>
		                    <span class="position">Businessman</span>
		                  </div>
		                </div>
	                </div>
	              </div>
	              <div class="item">
	                <div class="testimony-wrap pb-4">
	                  <div class="text">
	                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
	                  </div>
	                  <div class="d-flex">
		                  <div class="user-img" style="background-image: url(admin_asset/images/stylist-5.jpg)">
		                  </div>
		                  <div class="pos ml-3">
		                  	<p class="name">Jeff Nucci</p>
		                    <span class="position">Businessman</span>
		                  </div>
		                </div>
	                </div>
	              </div>
	            </div>
	          </div>
          </div>
        </div>
      </div>
    </section>
@endsection

@section('script')
  <script type="text/javascript">
    $(document).ready(function(){
      $('#nutxemlich').on('click', function(){
        var sdt = $('#appointment_sdt').val();
    
        $.get('xemlailich/'+sdt, function(data){
          $('#xemlaiLich').html(data);
        });
      });
    });

  </script>
@endsection