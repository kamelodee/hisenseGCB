@extends('layouts.layout1')
@section('content')
    <div id="content" class="py-4">

        <div class="container">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item">All Showrooms</li>
                
                </ol>
              </nav>

            @foreach ($errors->all() as $error)
                <li class="text-danger">{{ $error }}</li>
            @endforeach
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif


            <div class="row">
            <div class="col-md-2 col-lg-3 col-sm-12">
                <div class="bg-primary shadow-sm rounded text-center py-2 mb-4">
                    <a href="#">
                    <h3 class="text-4 text-white  fw-600">All Showrooms</h3>
                   
                    </a>
                
                  </div>
                    <div class="bg-white shadow-sm rounded text-center p-3 mb-4">
            <a href="{{route('showrooms.transaction')}}">
            <div class="text-10 text-primary my-3"><i class="fas fa-building"></i></div>
            <h3 class="text-3  fw-400">  {{$total}} </h3>
            <p class="text-muted   fw-600">All Showrooms Total</p>
            </a>
           
          
          </div>
          </div>
               
                <div class="col-md-9 col-lg-9 col-sm-12">
                    <div class="table-responsive">
                        <div class="card p-3">
                            <div class="d-md-flex justify-content-between flex-sm-column flex-md-row">
                                <h5 class="mx-3">Showrooms</h5>
                                <div class="flex-shrink-1">
                                    <div class="input-group input-group-sm mb-3 ">
                                        <span class="input-group-text" id="inputGroup-sizing-sm"><i class="fas fa-search"></i></span>
                                        <input type="text" placeholder="search showrooms" id="search1" class="form-control form-control-sm search" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                      </div>
                                </div>
                               
                                  <div class="mx-3"><h3 class="text-3  fw-600"> {{$total}}</h3></div>
                            </div>

                            <div class="table-responsive mt-2">

                                <table id="dataTable2" width="100%" class="table table-striped table-hover dataTable2">
                                    <thead class="table-dark_">
                                        <tr>
                                            <th class="border-top-0 text-white_">#</th>
                                            <th class="border-top-0 text-white_">Showroom</th>
                                            <th class="border-top-0 text-white_">Today</th>
                                            <th class="border-top-0 text-white_">This Week</th>
                                            <th class="border-top-0 text-white_">This Month</th>
                                            <th class="border-top-0 text-white_">This Year</th>
                                            <th class="border-top-0 text-white_">MOMO</th>
                                            <th class="border-top-0 text-white_">Deposits</th>
                                            <th class="border-top-0 text-white_">Card</th>
                                            <th class="border-top-0 text-white_">Total</th>
                                           
                                        </tr>
                                    </thead>

                                    <tbody>

                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                </div>
                
               
            </div>


        </div>
    </div>

    <!-- Modal -->

    @include('partials._fullModal')
@endsection


@section('script')
    <script type="text/javascript">
        $(function() {
            
console.log($('#search1').val());
            var table = $('.dataTable2').DataTable({
                processing: true,
                serverSide: true,
                bFilter: false,
                "dom": '<"top"f>rt<"bottom m-3"lp><"clear">',
                ajax: {
                    url: "{{ route('showrooms.translist') }}",
                data: function (d) {
                          d._token = "{{ csrf_token() }}",
                            d.search = $('#search1').val()
                        
                        }
                    },
        
                columns: [{
                        data: 'id',
                        name: 'id',
                        searchable: true
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'today',
                        name: 'today',
                        searchable: true
                    },
                    {
                        data: 'week',
                        name: 'week',
                        searchable: true
                    },
                    {
                        data: 'month',
                        name: 'month',
                        searchable: true
                    },
                    {
                        data: 'year',
                        name: 'year',
                        searchable: true
                    },
                    {
                        data: 'momo',
                        name: 'momo',
                        searchable: true
                    },
                    {
                        data: 'gcb',
                        name: 'gcb',
                        searchable: true
                    },
                    {
                        data: 'card',
                        name: 'card',
                        searchable: true
                    },
                    {
                        data: 'total',
                        name: 'total',
                        searchable: true
                    },
                    
                   
                   


                ],
                "order": [
                    [0, 1, 2, 3, 'desc']
                ]
            });
            $("#search1").keyup(function(){
        table.draw();
    });
        });
    </script>
@endsection
