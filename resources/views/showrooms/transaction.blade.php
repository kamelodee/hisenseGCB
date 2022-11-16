@extends('layouts.layout1')
@section('content')
    <div id="content" class="py-4">

        <div class="container">



            @foreach ($errors->all() as $error)
                <li class="text-danger">{{ $error }}</li>
            @endforeach
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif


            <div class="row">
            <div class="col-md-3 col-lg-3 col-sm-12">
                    <div class="bg-white shadow-sm rounded text-center p-3 mb-4">
            <a href="{{route('showrooms.transaction')}}">
            <div class="text-10 text-primary my-3"><i class="fas fa-building"></i></div>
            <h3 class="text-3  fw-400">GHC {{$total}}</h3>
            <p class="text-muted   fw-600">All Showrooms Total</p>
            </a>
           
          
          </div>
          </div>
               
                <div class="col-md-8 col-lg-8 col-sm-12">
                    <div class="table-responsive">
                        <div class="card p-3">
                            <div class="d-flex">

                               
                                <h5 class="mx-3">Showrooms</h5>
                            </div>

                            <div class="table-responsive mt-2">

                                <table id="dataTable2" width="100%" class="table table-striped table-hover dataTable2">
                                    <thead class="table-dark_">
                                        <tr>
                                            <th class="border-top-0 text-white_">#</th>
                                            <th class="border-top-0 text-white_">Showroom</th>
                                            <th class="border-top-0 text-white_">Total Amount</th>
                                           
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

            var table = $('.dataTable2').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('showrooms.translist') }}",
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
                        data: 'total',
                        name: 'total',
                        searchable: true
                    },
                    
                   
                   


                ],
                "order": [
                    [0, 1, 2, 3, 'desc']
                ]
            });

        });
    </script>
@endsection
