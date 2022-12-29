<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
<link href="{{asset('images/favicon.png')}}" rel="icon">
<title>404</title>
<meta name="description" content="HisenGH payment gate way">
<meta name="author" content="harnishdesign.net">
@laravelPWA
<!-- Web Fonts
============================================= -->
<link rel="stylesheet" href="../../../css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">

<!-- Stylesheet
============================================= -->
<link rel="stylesheet" type="text/css" href="{{asset("assets1/vendor/bootstrap/css/bootstrap.min.css")}}">
<link rel="stylesheet" type="text/css" href="{{asset("assets1/vendor/font-awesome/css/all.min.css")}}">
<link rel="stylesheet" type="text/css" href="{{asset("assets1/css/stylesheet.css")}}">
<!-- Colors Css -->
<link id="color-switcher" type="text/css" rel="stylesheet" href="#">
</head>
<body>

<!-- Preloader -->
<div id="preloader">
  <div data-loader="dual-ring"></div>
</div>
<!-- Preloader End -->

<div id="main-wrapper">
  <div class="container-fluid px-0">
    <div class="row g-0 min-vh-100"> 
      <!-- Welcome Text
      ============================================= -->
      <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="hero-wrap d-flex align-items-center h-100">
          <div class="hero-mask opacity-8 bg-primary"></div>
          <div class="hero-bg hero-bg-scroll" style="background-image:url('{{asset("assets1/images/bg/404.jpg")}}');"></div>
          <div class="hero-content mx-auto w-100 h-100 d-flex flex-column">
          
            <div class="row g-0 my-auto">
              <div class="col-10 col-lg-9 mx-auto">
                <h1 class="text-11 text-white mb-4">Oops !</h1>
                <p class="text-4 text-white lh-base mb-5">Sorry Page Not Found !</p>
                <a class="btn btn-primary" href="{{route('dashboard')}}">Go back</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    
    </div>
  </div>
</div>

<!-- Back to Top
============================================= --> 
<a id="back-to-top" data-bs-toggle="tooltip" title="Back to Top" href="javascript:void(0)"><i class="fa fa-chevron-up"></i></a> 


<!-- Script --> 
<script src="{{asset("assets1/vendor/jquery/jquery.min.js")}}"></script> 
<script src="{{asset("assets1/vendor/bootstrap/js/bootstrap.bundle.min.js")}}"></script> 
<!-- Style Switcher --> 
<script src="{{asset("assets1/js/switcher.min.js")}}"></script> 
<script src="{{asset("assets1/js/theme.js")}}"></script>
</body>
</html>