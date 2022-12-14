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
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="table-responsive">
                        <div class="card p-3">
                            <div class="d-flex">

                                
                                <h5 class="mx-3">Activities Logs</h5>
                            </div>

                            <div class="table-responsive mt-2">

                                <table id="dataTable2" width="100%" class="table table-striped table-hover dataTable2">
                                    <thead class="table-dark_">
                                        <tr>
                                            <th class="border-top-0 text-white_">#</th>
                                            <th class="border-top-0 text-white_">User</th>
                                            <th class="border-top-0 text-white_">Showroom</th>
                                            <th class="border-top-0 text-white_">Description</th>
                                            <th class="border-top-0 text-white_">Ceated At</th>
                                        
                                           
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
                ajax: "{{ route('activities.list') }}",
                columns: [{
                        data: 'id',
                        name: 'id',
                        searchable: true
                    },
                    {
                        data: 'user_name',
                        name: 'user_name'
                    },
                    {
                        data: 'showroom',
                        name: 'showroom',
                        searchable: true
                    },
                    {
                        data: 'description',
                        name: 'description',
                        searchable: true
                    },
                   
                   

                    {
                        data: 'created_at',
                        name: 'created_at',
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
