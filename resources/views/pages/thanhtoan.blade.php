<!--url : getbootstrap.com -->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<base href="{{asset('')}}">
	<title>Checkout Shopping Cart</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="{{ URL::to('src/css/app.css') }}">

	<link rel="stylesheet" type="text/css" href="{{ URL::to('src/css/checkout.css') }}">
</head>
<body>
	<div class="container">
		<div class="container">
	<div class="col-md-6 col-sm-4 col-md-offset-4 col-sm-offset-3">
		<h1>CheckOut</h1>
		@foreach($lichdat as $ld)
		<h4>Your Total: {{$lichdat->dichvu->gia}}đ</h4>

		@if(Session::has('error'))
			<div id="charge-error" class="alert alert-danger">
				{{ Session::get('error') }}
			</div>
		@endif

		@if(Session::has('success'))
			<div class="alert alert-success">
				{{ Session::get('success') }}
			</div>
		@endif
		{{-- <div class="alert alert-danger" id="charge-error {{ !Session::has('error') ? 'hidden' : ''  }}">
			{{ Session::get('error') }}
		</div> --}}
		
		<form method="post" action="{{route('postThanhtoan', ['lichdat_id'=>$lichdat->id])}}" id="checkout-form">
			{{csrf_field()}}
			

				<input type="hidden" name="gia" value="{{$ld->dichvu->gia}}">
				<div class="col-xs-12">
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" id="name" name="name" class="form-control" value="{{Auth::user()->name}}" readonly="">
					</div>
				</div>
				@endforeach
				<div class="col-xs-12">
					<div class="form-group">
						<label for="address">Address</label>
						<input type="text" id="address_zip" name="address" class="form-control" required="">
					</div>
				</div>

				<div class="col-xs-12">
					<div class="form-group">
						<label for="card-name">Card Holder Name</label>
						<input type="text" id="card-name" class="form-control">
					</div>
				</div>

				<div class="col-xs-12">
					<div class="form-group">
						<label for="card-email">Email</label>
						<input type="text" id="card-name" name="email" class="form-control" value="{{Auth::user()->email}}" readonly="">
					</div>
				</div>
				<hr>
				{{-- <div class="col-xs-12">
					<div class="form-group">
						<label for="card-number">Credit Card Number</label>
						<input type="text" id="card-number" class="form-control" required="">
					</div>
				</div> --}}

				<div class="col-xs-12">
					<div class="form-group">
						<label for="card-element">Credit or debit card</label>
						<div id="card-element">
					      <!-- A Stripe Element will be inserted here. -->
					    </div>
					</div>
				</div>

				<div id="card-errors" role="alert"></div>

				{{-- <div class="col-xs-12">
					<div class="row">
						<div class="col-xs-6">
							<div class="form-group" style="margin-left: 15px;">
								<label for="card-expiry-month">Expiration Month</label>
								<input type="text" id="card-expiry-month" class="form-control" required="">
							</div>
						</div>
						<div class="col-xs-6">
							<div class="form-group" style="margin-left: 25px;">
								<label for="card-expiry-year">Expiration Year</label>
								<input type="text" id="card-expiry-year" class="form-control" required="">
							</div>
						</div>
					</div>
				</div>

				<div class="col-xs-12">
					<div class="form-group">
						<label for="card-cvc">CVC</label>
						<input type="text" id="card-cvc" class="form-control" required="">
					</div>
				</div> --}}
				<button type="submit" class="btn btn-success">Buy Now</button>
		</form>
	</div>
</div>
	</div>



	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

	<!--Bootstrap's javascript -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

	<!--https://fontawesome.com/how-to-use/on-the-web/styling/sizing-icons chinh css cho font-awsome-->
	<script src="https://kit.fontawesome.com/b2a28e1f39.js" crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://js.stripe.com/v3/"></script>
	<script type="text/javascript" src="{{ URL::to('src/js/checkout.js') }}"></script>
</body>
</html>