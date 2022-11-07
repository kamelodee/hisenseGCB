<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
<link href="{{asset('images/favicon.png')}}" rel="icon">
<title>Login</title>
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
      <div class="col-md-6">
        <div class="hero-wrap d-flex align-items-center h-100">
          <div class="hero-mask opacity-8 bg-primary"></div>
          <div class="hero-bg hero-bg-scroll" style="background-image:url('{{asset("assets1/images/bg/image-3.jpg")}}');"></div>
          <div class="hero-content mx-auto w-100 h-100 d-flex flex-column">
            <div class="row g-0">
              <div class="col-10 col-lg-9 mx-auto">
                <div class="logo mt-5 mb-5 mb-md-0"> <a class="d-flex" href="index.html" title="Payyed - HTML Template">Hisense Pay</a> </div>
              </div>
            </div>
            <div class="row g-0 my-auto">
              <div class="col-10 col-lg-9 mx-auto">
                <h1 class="text-11 text-white mb-4">Hisense Pay API</h1>
                <h3 class="text-5 text-white mb-4">Introduction</h3>
                <hr>
                <p class="text-4 text-white lh-base mb-5">This Hisense API is a simplified set of rules that enables communication between the ERP of the Company and an assigned third party service provider, exposing data and functionality across secure network infrastructure, in a consistent format. Developed based on REST, the API is delivered a predefined URL and accepts form-encoded request bodies, returns JSON-encoded responses, and uses standard HTTP response codes, authentication, and verbs.

                    This API has two endpoints, namely the Showroom Login endpoint and the Showroom Payments endpoint.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Welcome Text End --> 
      
      <!-- Login Form
      ============================================= -->
      <div class="col-md-6 d-flex align-items-center">
        <div class="container my-4">
          <div class="row g-0">
            <div class="col-11 col-lg-9 col-xl-8 mx-auto">
              <h3 class="fw-400 mb-4">Postman Docs</h3>
			 
              <a class="btn btn-primary" href="https://documenter.getpostman.com/view/8299726/2s83zpJgC6#intro">Open postman docs</a>
           
            </div>
          </div>
        </div>
      </div>
      <!-- Login Form End --> 
    </div>
  </div>
</div>

<!-- Back to Top
============================================= --> 
<a id="back-to-top" data-bs-toggle="tooltip" title="Back to Top" href="javascript:void(0)"><i class="fa fa-chevron-up"></i></a> 

 
</div>
<!-- Styles Switcher End --> 

<!-- Script --> 
<script src="{{asset("assets1/vendor/jquery/jquery.min.js")}}"></script> 
<script src="{{asset("assets1/vendor/bootstrap/js/bootstrap.bundle.min.js")}}"></script> 
<!-- Style Switcher --> 
<script src="{{asset("assets1/js/switcher.min.js")}}"></script> 
<script src="{{asset("assets1/js/theme.js")}}"></script>
</body>
</html>