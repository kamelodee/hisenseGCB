@extends('layouts.layout1')
@section('content')
<div id="content" class="py-4">
    <div class="container">



        <div class="row">
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto">
                <div class="bg-white shadow-sm rounded  pt-sm-4 pb-sm-5 px-sm-5 mb-4">
                    <h3 class="text-5 fw-400 mb-3 mb-sm-4 text-center">Payment Processing</h3>
                    
                     <img src="{{asset("assets1/images/loader.gif")}}" alt="" srcset="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content end -->

@endsection
@section('script')
    <script type="text/javascript">
    setInterval(function () {
        location.reload();
    }, 5000);
    
    </script>
@endsection