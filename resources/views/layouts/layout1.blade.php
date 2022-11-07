<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
<link href="{{asset('images/favicon.png')}}" rel="icon">
<title>hi {{Auth::user()->name}}</title>
<meta name="description" content="HisenseGh payment gatewy">
<meta name="author" content="harnishdesign.net">
@laravelPWA
<!-- Web Fonts
============================================= -->
<link rel="stylesheet" href="../../../css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">

<!-- Stylesheet
============================================= -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="{{asset("assets1/vendor/bootstrap/css/bootstrap.min.css")}}">
<link rel="stylesheet" type="text/css" href="{{asset("assets1/vendor/font-awesome/css/all.min.css")}}">
<link rel="stylesheet" type="text/css" href="{{asset("assets1/css/stylesheet.css")}}">
<!-- Colors Css -->

</head>
<body>

<!-- Preloader -->
<div id="preloader">
  <div data-loader="dual-ring"></div>
</div>
<!-- Preloader End --> 

<!-- Document Wrapper   
============================================= -->
<div id="main-wrapper"> 
  <!-- Header
  ============================================= -->
<div class="text-center">  <a href="#"><i class="fas fa-building mx-1"></i> {{Auth::user()->showroom}}</a></div>
  <header id="header">
    <div class="container">
      <div class="header-row">
        <div class="header-column justify-content-start"> 
          <!-- Logo
          ============================= -->
           <!-- Logo end --> 
          <!-- Collapse Button
          ============================== -->
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#header-nav"> <span></span> <span></span> <span></span> </button>
          <!-- Collapse Button end --> 
          
          <!-- Primary Navigation
          ============================== -->
          <nav class="primary-menu navbar navbar-expand-lg">
            <div id="header-nav" class="collapse navbar-collapse">
              <ul class="navbar-nav me-auto">
               <li>
                
                 <a class="d-flex" href="{{route('dashboard')}}" title=""><i class="fas fa-th text-3 me-2"></i><span class="text-success text-3">Hisense Pay</span></a> 
               </li>
                <li>
                  <a href="{{route('payments')}}">Received Payments</a>
                  
                </li>
                
                @can('Show Transactions')
                <li class="dropdown language"> <a class="dropdown-toggle" href="#">Transactions</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{route('transactions.gcb')}}">GCB</a></li>
                    <li><a class="dropdown-item" href="{{route('transactions.uba')}}">UBA</a></li>
                    <li><a class="dropdown-item" href="{{route('transactions')}}">CALBANK</a></li>
                    <li><a class="dropdown-item" href="{{route('transactions.zenith')}}">ZENITH BANK</a></li>
                  
                  </ul>
                </li>
                @endcan
                
              
               
              
                
              </ul>
            </div>
          </nav>
          <!-- Primary Navigation end --> 
        </div>
        <div class="header-column justify-content-end"> 
          <!-- My Profile
          ============================== -->
          <nav class="login-signup navbar navbar-expand">
            <ul class="navbar-nav">
              @can('Access All')
              <li class="dropdown language"> <a class="dropdown-toggle" href="#"><i class="fas text-3 fa-user-cog me-2"></i>Settings</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="{{route('users')}}">Users</a></li>
                  <li><a class="dropdown-item" href="{{route('roles')}}">Roles</a></li>
                
                  <li><a class="dropdown-item" href="{{route('showrooms')}}">Showrooms</a></li>
              
                </ul>
              </li>
              @endcan
              <li class="dropdown profile ms-2"> <a class="px-0 dropdown-toggle " href="#"><i class="fas fa-user text-3 text-primary"></i><span class="text-1 ms-2">{{Auth::user()->name}}</span></a>
                
                
                <ul class="dropdown-menu">
                  <li class="text-center text-3 py-2">hi {{Auth::user()->name}}</li>
                  <li class="dropdown-divider mx-n3"></li>
                  <li><a class="dropdown-item" href="#"><i class="fas fa-user"></i>My Profile</a></li>

                  <li><a class="dropdown-item" href="{{route('transactions')}}"><i class="fas fa-credit-card"></i>Transactions</a></li>
                    
                  {{-- <li><a class="dropdown-item" href="{{route('logout')}}"><i class="fas fa-sign-out-alt"></i>Sign Out</a></li> --}}
                  <li>
                    <span class="text-white pr-3">
                     <form method="POST" action="{{ route('logout') }}">
                         @csrf

                         <a href="route('logout')"
                                 onclick="event.preventDefault();
                                             this.closest('form').submit();">
                             {{ __('Log Out') }}
                             <i class="fas fa-sign-out-alt"></i>
                     </a>
                     
                     </form>
                    </span>
                 </li>
                </ul>
              </li>
            </ul>
          </nav>
          <!-- My Profile end --> 
        </div>
      </div>
    </div>
  </header>
  <!-- Header End -->
  
<div>
  
  @yield('content')
</div>


  <!-- Footer
  ============================================= -->
  <footer id="footer">
    <div class="container">
      <div class="row">
        <div class="col-lg d-lg-flex align-items-center">
          <ul class="nav justify-content-center justify-content-lg-start text-3">
            <li class="nav-item"> <a class="nav-link active" href="#">About Us</a></li>
            <li class="nav-item"> <a class="nav-link" href="#">Support</a></li>
            <li class="nav-item"> <a class="nav-link" href="#">Help</a></li>
           
          </ul>
        </div>
        <div class="col-lg d-lg-flex justify-content-lg-end mt-3 mt-lg-0">
          
        </div>
      </div>
      <div class="footer-copyright pt-3 pt-lg-2 mt-2">
        <div class="row">
          <div class="col-lg">
            <p class="text-center text-lg-start mb-2 mb-lg-0">Copyright &copy; 2022 <a href="#">HisenseGH</a>. All Rights Reserved.</p>
          </div>
          <div class="col-lg d-lg-flex align-items-center justify-content-lg-end">
            <ul class="nav justify-content-center">
              <li class="nav-item"> <a class="nav-link active" href="#">Security</a></li>
              <li class="nav-item"> <a class="nav-link" href="#">Terms</a></li>
              <li class="nav-item"> <a class="nav-link" href="#">Privacy</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- Footer end --> 
  
</div>
<!-- Document Wrapper end --> 

<!-- Back to Top
============================================= --> 
<a id="back-to-top" data-bs-toggle="tooltip" title="Back to Top" href="javascript:void(0)"><i class="fa fa-chevron-up"></i></a> 


<!-- Script --> 

<script src="{{asset("assets1/vendor/jquery/jquery.min.js")}}"></script> 
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="{{asset("assets1/vendor/bootstrap/js/bootstrap.bundle.min.js")}}"></script> 
<!-- Style Switcher --> 
<script src="{{asset("assets1/js/switcher.min.js")}}"></script> 
<script src="{{asset("assets1/js/theme.js")}}"></script>

<script >
  
  let BASE_URL ='https://api.hisense.com.gh'
     
     $(document).on('click',`#close` , function(){
        $("#fullModal").modal("hide");
      })
     $(document).on('click',`.close` , function(){
        $("#fullModal").modal("hide");
      })
   
</script>
<script src="{{asset("assets1/app/js/showrooms.js")}}"></script>
<script src="{{asset("assets1/app/js/transactions.js")}}"></script>
<script src="{{asset("assets1/app/js/user.js")}}"></script>
<script src="{{asset("assets1/app/js/role.js")}}"></script>
@yield("script")
</body>
</html>