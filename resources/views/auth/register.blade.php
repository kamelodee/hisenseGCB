<!doctype html>
<html lang="en">

<!-- Mirrored from wizixo.webestica.com/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 May 2022 00:59:03 GMT -->
<head>
	<title>HisenseGH || SMS Register</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Webestica.com">
	<meta name="description" content="Creative Multipurpose Bootstrap Template">

	<!-- Favicon -->
	<link rel="shortcut icon" href="assets/images/favicon.ico">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900%7CPlayfair+Display:400,400i,700,700i%7CRoboto:400,400i,500,700" rel="stylesheet">

	<!-- Plugins CSS -->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/assets/vendor/font-awesome/css/all.min.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('assets/assets/vendor/themify-icons/css/themify-icons.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('assets/assets/vendor/animate/animate.min.css')}}" />

	<!-- Theme CSS -->
	<link rel="stylesheet" type="text/css" href="{{asset("assets/assets/css/style.css")}}" />
	
</head>

<body>
	{{-- <div class="preloader">
		<img src="assets/images/preloader.svg" alt="Pre-loader">
	</div> --}}

	<!-- =======================
	Sign in -->
	<section class="p-0 d-flex align-items-center">
		<div class="container-fluid">
			<div class="row">
				<!-- left -->
				<div class="col-12 col-md-5 col-lg-4 d-md-flex align-items-center bg-grad vh-sm-100">
					<div class="w-100 p-3 p-lg-5 all-text-white">
						<div class="justify-content-center align-self-center">
							<!-- SVG Logo Start -->
							HiSMS
							<!-- SVG Logo End -->
						</div>
						<h3 class="fw-light">Welcome To HisenseGH SMS</h3>
						
					</div>
				</div>
				<!-- Right -->
				<div class="col-12 col-md-7 col-xl-8 mx-auto my-5">
					<div class="row h-100">
						<div class="col-12 col-md-10 col-lg-5 text-start mx-auto d-flex align-items-center">
							<div class="w-100 ">
								<h2 class="">Register Here</h2>
                                @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="text-danger">{{$error}}</div>
                                @endforeach
                            @endif
								<form class="form mt-4 " method="POST" action="{{ route('register') }}">
                                    @csrf
								
									<div>
										<p class="text-start mb-2">Name</p>
										<span class="form-group"><input type="text" class="form-control" placeholder="Phone Number" name="name"></span>
									</div>
									<div>
										<p class="text-start mb-2">Phone Number</p>
										<span class="form-group"><input type="text" class="form-control" placeholder="Phone Number" name="phone"></span>
									</div>
									<div>
										<p class="text-start mb-2">Email</p>
										<span class="form-group"><input type="email" class="form-control" placeholder="email@gmail.com" name="email"></span>
									</div>
									<div>
										<div class="d-flex justify-content-between align-items-center">
											<p class="text-start mb-2">Password</p>
											<a class="text-muted small mb-2" href="#"></a>
										</div>
										<span class="form-group"><input type="password" name="password" class="form-control" placeholder="*********"></span>
									</div>
									<div>
										<div class="d-flex justify-content-between align-items-center">
											<p class="text-start mb-2">Confirm Password</p>
											<a class="text-muted small mb-2" href="#"></a>
										</div>
										<span class="form-group"><input type="password" name="password_confirmation" class="form-control" placeholder="*********"></span>
									</div>
									<div class="row align-items-center g-0 m-0">
										<div class="col-6 col-md-8"><span class="text-muted"> <a href="{{route('login')}}">Already have Account? Login here</a></span></div>
										<div class="col-6 col-md-4 text-end"><button type="submit" class="btn btn-dark ">Register</button></div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- =======================
	Sign in -->

	<!-- Bootstrap JS -->
	<script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

	<!--Template Functions-->
	<script src="assets/js/functions.js"></script>

</body>

<!-- Mirrored from wizixo.webestica.com/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 May 2022 00:59:03 GMT -->
</html>