<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
<link href="{{asset('images/favicon.png')}}" rel="icon">
<title>{{Auth::user()->showroom}}</title>
<meta name="description" content="HisenseGh payment gatewy">
<meta name="author" content="harnishdesign.net">

<!-- Web Fonts
============================================= -->
<link rel="stylesheet" href="../../../css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">

<!-- Stylesheet
============================================= -->
<link rel="stylesheet" href="https://cdn.datatables.net/v/dt/dt-1.10.16/sl-1.2.5/datatables.min.css">
<link rel="stylesheet" type="text/css" href="{{asset("assets1/vendor/bootstrap/css/bootstrap.min.css")}}">
<link rel="stylesheet" type="text/css" href="{{asset("assets1/vendor/font-awesome/css/all.min.css")}}">
<link rel="stylesheet" type="text/css" href="{{asset("assets1/css/stylesheet.css")}}">
<!-- Colors Css -->
<link type="text/css" href="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css" rel="stylesheet" />
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
     
  <nav class="navbar navbar-expand-lg bg-white sticky-top">
    <div class="container">
      
      <nav class="primary-menu ">
        <div id="header-nav_" class="collapse navbar-collapse">
          <ul class="navbar-nav me-auto">

            <li class="dropdown language"> <a class="px-0 dropdown-toggle fw-600" href="{{route('dashboard')}}"><i class="fas fa-th text-3 me-2"></i><span class="text-2 ms-2 me-4">Hisense Pay</span></a>
              @can('Show Transactions')
              <ul class="dropdown-menu">
             
                <li><a class="dropdown-item" href="{{route('transactions.all')}}">ALL Payments</a></li>
                <li><a class="dropdown-item" href="{{route('transactions.gcb')}}">GCB Payments</a></li>
                <li><a class="dropdown-item" href="{{route('transactions.uba')}}">UBA Payments</a></li>
                <li><a class="dropdown-item" href="{{route('transactions.zenith')}}">ZENITH Payments</a></li>
              
               
              </ul>
              @endcan
            </li>
          
            @yield('bank')
          
            
          </ul>
        </div>
      </nav>
      <a class="btn text-2 btn-primary btn-sm mx-5 my-3 fw-600 ms-5" href="{{route('payments')}}">TAKE PAYMENT</a>
  
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span></span> <span></span> <span></span> 
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
        </ul>
        <nav class="primary-menu">
          <div >
          <ul class="navbar-nav">
           
            <li class="dropdown language fw-600"><a class="fw-600 text-2" href=""><i class="fas fa-map-marker-alt mx-2"></i> {{Auth::user()->showroom}}</a></li>
            @can('Access All')
            <li class="dropdown language"> <a class="dropdown-toggle fw-600" href="#"><i class="fas text-2 fa-user-cog me-2"></i>Settings</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{route('users')}}">Users</a></li>
                <li><a class="dropdown-item" href="{{route('roles')}}">Roles</a></li>
              
                <li><a class="dropdown-item" href="{{route('showrooms')}}">Showrooms</a></li>
                <li><a class="dropdown-item" href="{{route('api')}}">API docs</a></li>
            
              </ul>
            </li>
            @endcan
           
            <li class="dropdown profile ms-2"> <a class="px-0 dropdown-toggle fw-600 " href="#"><i class="fas fa-user text-2 text-primary"></i><span class="text-1 ms-2 mx-4">{{Auth::user()->name}}</span></a>
                
              <ul class="dropdown-menu">
                <li class="text-center text-3 py-2">hi {{Auth::user()->name}}</li>
                <li class="dropdown-divider mx-n3"></li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-user"></i>My Profile</a></li>
               <li><a class="dropdown-item" href="{{route('activities')}}"><i class="fas fa-credit-card"></i>Activities Logs</a></li>
                  
                {{-- <li><a class="dropdown-item" href="{{route('logout')}}"><i class="fas fa-sign-out-alt"></i>Sign Out</a></li> --}}
                <li>
                  <span class="text-white pr-3">
                   <form method="POST" action="{{ route('logout') }}">
                       @csrf

                       <a class="dropdown-item" href="route('logout')"
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
          </div>
        </nav>
      </div>
    </div>
  </nav>



  
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
              <li class="nav-item"> <a class="nav-link" href="{{route('api')}}">API Docs</a></li>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<script src="https://cdn.datatables.net/v/dt/dt-1.10.16/sl-1.2.5/datatables.min.js"></script>

<script type="text/javascript" src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>
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