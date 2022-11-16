@extends('layouts.layout1')
@section('content')
    <!-- Content
      ============================================= -->
    <div id="content" class="py-4">
        <div class="container">
            <div class="row">

                <aside class="col-lg-2 col-md-3 col-sm-12">

                    <!-- Available Balance
              =============================== -->
                    <div class="bg-white shadow-sm rounded text-center p-3 mb-4">
                        <div class="text-10 text-primary my-3"><i class="fas fa-wallet"></i></div>
                        <h3 class="text-3 fw-400">GHC {{ $total }}</h3>
                        <p class="mb-2 text-muted opacity-8">Total Copleted Transactions</p>
                        <hr class="mx-n3">

                    </div>
                    <hr> 
                    
                </aside>
                <!-- Left Panel End -->

                <!-- Middle Panel
            ============================================= -->
                <div class="col-lg-10 col-md-9 col-sm-12 ">
                    <h4 class="fw-400 mb-3">Monthly Transactions</h4>
                    @foreach ($errors->all() as $error)
                        <li class="text-danger">{{ $error }}</li>
                    @endforeach
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <!-- All Transactions
              ============================================= -->
                    <div class="bg-white shadow-sm rounded p-4 mb-4">

                        <div class="col-2">
                            <a class="btn btn-primary btn-sm" href="{{ route('transactions.load') }}">Refresh</a>
                        </div>
                        <div class="table-responsive mt-2">

                            <table id="dataTable2" width="100%" class="table table-striped table-hover dataTable2">
                                <thead class="table-dark_">
                                    <tr>
                                        <th class="border-top-0 text-white_">#</th>
                                        <th class="border-top-0 text-white_">Date</th>
                                        <th class="border-top-0 text-white_">Bank Transaction ID</th>
                                        <th class="border-top-0 text-white_">Sales Reference ID</th>
                                        <th class="border-top-0 text-white_">Amount</th>
                                        <th class="border-top-0 text-white_">Showroom</th>
                                        <th class="border-top-0 text-white_">Staus</th>

                                    </tr>
                                </thead>

                                <tbody>

                                </tbody>
                            </table>

                        </div>

                    </div>
                    <!-- All Transactions End -->
                </div>
                <!-- Middle End -->
            </div>
        </div>
    </div>
    <!-- Content end -->

    @include('partials._fullModal')
@endsection


@section('script')
    <script type="text/javascript">
        $(function() {

            var table = $('.dataTable2').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('monthly') }}",
                columns: [{
                        data: 'id',
                        name: 'id',
                        searchable: true
                    },
                    {
                        data: 'date',
                        name: 'date',
                        searchable: true
                    },
                    {
                        data: 'transaction_id',
                        name: 'transaction_id'
                    },
                    {
                        data: 'sales_reference_id',
                        name: 'sales_reference_id'
                    },
                    
                    {
                        data: 'amount',
                        name: 'amount',
                        searchable: true
                    },

                    {
                        data: 'showroom',
                        name: 'showroom',
                        searchable: true
                    },
                    {
                        data: 'status',
                        name: 'status',
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
