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
                <div class="col-md-12 col-lg-12col-sm-12">
                    <div class="table-responsive">
                        <div class="card p-3">
                            <div class="d-flex">

                                <h5 class="form-header_ ">
                                    @can('Create Showroom')
                                    <a href="javascript:void()" class="btn  btn-primary  btn-sm float-right"
                                        onclick="showroomadd()"><i class="os-icon os-icon-plus-square"></i> Add </a>
                               @endcan
                                    </h5>
                                <h5 class="mx-3">Showrooms</h5>
                            </div>

                            <div class="table-responsive mt-2">

                                <table id="dataTable2" width="100%" class="table table-striped table-hover dataTable2">
                                    <thead class="table-dark_">
                                        <tr>
                                            <th class="border-top-0 text-white_"></th>
                                            <th class="border-top-0 text-white_">Name</th>
                                            <th class="border-top-0 text-white_">Street</th>
                                            <th class="border-top-0 text-white_">City</th>
                                            <th class="border-top-0 text-white_">Phone</th>
                                            <th class="border-top-0 text-white_">Account Number</th>


                                            <th class="border-top-0 text-white_">Ceated At</th>
                                            <th class="border-top-0 text-white_">Action</th>

                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-1 col-lg-1 col-sm-0"></div>
                
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
                "dom": '<"top"f>rt<"bottom m-3"lp><"clear">',
                ajax: "{{ route('showrooms.list') }}",
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
                        data: 'street',
                        name: 'street',
                        searchable: true
                    },
                    {
                        data: 'city',
                        name: 'city',
                        searchable: true
                    },
                    {
                        data: 'phone',
                        name: 'phone',
                        searchable: true
                    },
                    {
                        data: 'account_number',
                        name: 'account_number',
                        searchable: true
                    },

                    {
                        data: 'created_at',
                        name: 'created_at',
                        searchable: true
                    },
                    {
                        data: 'action',
                        name: 'action',
                        searchable: true
                    }


                ],
                "order": [
                    [0, 1, 2, 3, 'desc']
                ]
            });

            
        $('#reconsile').on('submit', function(e){
    // e.preventDefault();
      var form = this;

      var rows_selected = table.column(0).checkboxes.selected();

      // Iterate over all selected checkboxes
      $.each(rows_selected, function(index, rowId){
         // Create a hidden element
         $(form).append(
             $('<input>')
                .attr('type', 'hidden')
                .attr('name', 'id[]')
                .val(rowId)
         );
      });
      console.log(form)
   });

        });
    </script>
@endsection
