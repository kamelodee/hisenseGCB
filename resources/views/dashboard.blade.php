@extends('layouts.layout1')
@section('content')
    <!-- Content
          ============================================= -->
    <div id="content" class="py-4">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">home</a></li>
                    <li class="breadcrumb-item">Dashboard</li>

                </ol>
            </nav>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <div class="row">
                <!-- Left Panel
                ============================================= -->
                <aside class="col-lg-3 col-md-3 col-sm-12">

                    <!-- Available Balance
                  =============================== -->
                    <div class="bg-white shadow-sm rounded text-center p-3 mb-4">
                        <a href="{{ route('showrooms.transaction') }}">
                            <div class="text-10 text-primary my-3"><i class="fas fa-building"></i></div>
                            <h3 class="text-3  fw-400"> {{ $total }}</h3>
                            <p class="text-muted   fw-600">All Showrooms Total</p>
                        </a>


                    </div>

                    @if (App\Models\Bank::where('name', 'GCB')->first()->status == 'ACTIVE')
                        <div class="bg-white shadow-sm rounded text-center p-3 mb-4">
                            <a href="{{ route('transactions.gcb') }}">
                                <div class="text-10 text-primary my-3"><i class="fas fa-building"></i></div>
                                <h3 class="text-3  fw-400"> {{ $gcb }}</h3>
                                <p class="text-muted   fw-600">GCB Transactions</p>
                            </a>


                        </div>
                    @endif
                    @if (App\Models\Bank::where('name', 'ZENITH')->first()->status == 'ACTIVE')
                        <div class="bg-white shadow-sm rounded text-center p-3 mb-4">
                            <a href="{{ route('transactions.zenith') }}">
                                <div class="text-10 text-primary my-3"><i class="fas fa-building"></i></div>
                                <h3 class="text-3 fw-400">GHC {{ $zenith }}</h3>
                                <p class="text-muted   fw-600">Zenith Transactions</p>
                            </a>
                            <hr class="mx-n3">

                        </div>
                    @endif
                    @if (App\Models\Bank::where('name', 'UBA')->first()->status == 'ACTIVE')
                        <div class="bg-white shadow-sm rounded text-center p-3 mb-4">
                            <a href="{{ route('transactions.uba') }}">
                                <div class="text-10 text-primary my-3"><i class="fas fa-building"></i></div>
                                <h3 class="text-3 fw-400"> {{ $uba }}</h3>
                                <p class="text-muted   fw-600 ">UBA Transactions</p>
                            </a>


                        </div>
                    @endif
                    @if (App\Models\Bank::where('name', 'CALBANK')->first()->status == 'ACTIVE')
                        <div class="bg-white shadow-sm rounded text-center p-3 mb-4">
                            <a href="{{ route('transactions.calbank') }}">
                                <div class="text-10 text-primary my-3"><i class="fas fa-building"></i></div>
                                <h3 class="text-3 fw-400">GHC {{ $calbank }}</h3>
                                <p class="mb-2 ">Calbank Transactions</p>
                            </a>
                            <hr class="mx-n3">

                        </div>
                    @endif <!-- Available Balance End -->



                </aside>
                <!-- Left Panel End -->

                <!-- Middle Panel
                ============================================= -->
                <div class="col-lg-9 col-md-9 col-sm-12">

                    <!-- Profile Completeness
                  =============================== -->
                    <div class="bg-white shadow-sm rounded p-4 mb-2">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active text-3 text-dark  mx-3 fw-600" id="nav-home-tab"
                                    data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab"
                                    aria-controls="nav-home" aria-selected="true">Today <i
                                        class="fas fa-wallet text-primary"></i></button>
                                <button class="nav-link text-3 text-dark mx-3 fw-600" id="nav-profile-tab"
                                    data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab"
                                    aria-controls="nav-profile" aria-selected="false">This Week <i
                                        class="fas fa-wallet text-primary"></i></button>
                                <button class="nav-link text-3 text-dark mx-3 fw-600" id="nav-contact-tab"
                                    data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab"
                                    aria-controls="nav-contact" aria-selected="false">This Month <i
                                        class="fas fa-wallet text-primary"></i></button>
                                <button class="nav-link text-3 text-dark mx-3 fw-600" id="nav-disabled-tab"
                                    data-bs-toggle="tab" data-bs-target="#nav-disabled" type="button" role="tab"
                                    aria-controls="nav-disabled" aria-selected="false">This Year <i
                                        class="fas fa-wallet text-primary"></i></button>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab" tabindex="0">

                                {{--  --}}

                                <div class="row">
                                    <div class="col-sm-6 col-md-3">
                                        <div class="bg-white shadow-sm rounded text-center p-2 ">
                                            <a href="{{ route('indexdaily') }}">
                                                <div class="text-7 text-primary my-3"><i class="fas fa-wallet"></i></div>
                                                <h3 class="text-3  fw-400"> {{ $transactions_today }}</h3>
                                                <p class=" text-muted   fw-600">Reconcile Today</p>

                                            </a>
                                            @can('Reconcile')
                                                <div class="reconsile">
                                                    <form method="POST" action="{{ route('payments.reconsileweek') }}"
                                                        id="reconsile2">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-primary">Reconcile
                                                            Today</button>
                                                    </form>
                                                </div>
                                            @endcan

                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-3">
                                        <div class="bg-white shadow-sm rounded text-center p-2 ">
                                            <a href="{{ route('indexweekly') }}">
                                                <div class="text-7 text-primary my-3"><i class="fas fa-wallet"></i></div>
                                                <h3 class="text-3  fw-400">{{ $transactions_todaydepo }}</h3>
                                                <p class=" text-muted   fw-600">Deposits</p>

                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="bg-white shadow-sm rounded text-center p-2 ">
                                            <a href="{{ route('indexweekly') }}">
                                                <div class="text-7 text-primary my-3"><i class="fas fa-wallet"></i></div>
                                                <h3 class="text-3  fw-400">{{ $transactions_todaymomo }}</h3>
                                                <p class=" text-muted   fw-600">Mobile Money</p>

                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="bg-white shadow-sm rounded text-center p-2">
                                            <a href="{{ route('indexmonthly') }}">
                                                <div class="text-7 text-primary my-3"><i class="fas fa-wallet"></i></div>
                                                <h3 class="text-3  fw-400">{{ $transactions_todaycard }}</h3>
                                                <p class=" text-muted   fw-600">Card</p>

                                            </a>
                                        </div>
                                    </div>

                                </div>

                                {{--  --}}

                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                aria-labelledby="nav-profile-tab" tabindex="0">

                                {{--  --}}

                                <div class="row">
                                    <div class="col-sm-6 col-md-3">
                                        <div class="bg-white shadow-sm rounded text-center p-2 ">
                                            <a href="{{ route('indexdaily') }}">
                                                <div class="text-7 text-primary my-3"><i class="fas fa-wallet"></i></div>
                                                <h3 class="text-3  fw-400"> {{ $transactions_week }}</h3>
                                                <p class=" text-muted   fw-600">This Week</p>

                                            </a>


                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-3">
                                        <div class="bg-white shadow-sm rounded text-center p-2 ">
                                            <a href="{{ route('indexweekly') }}">
                                                <div class="text-7 text-primary my-3"><i class="fas fa-wallet"></i></div>
                                                <h3 class="text-3  fw-400">{{ $transactions_weekdepo }}</h3>
                                                <p class=" text-muted   fw-600">Deposits</p>

                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="bg-white shadow-sm rounded text-center p-2 ">
                                            <a href="{{ route('indexweekly') }}">
                                                <div class="text-7 text-primary my-3"><i class="fas fa-wallet"></i></div>
                                                <h3 class="text-3  fw-400">{{ $transactions_weekmomo }}</h3>
                                                <p class=" text-muted   fw-600">Mobile Money</p>

                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="bg-white shadow-sm rounded text-center p-2">
                                            <a href="{{ route('indexmonthly') }}">
                                                <div class="text-7 text-primary my-3"><i class="fas fa-wallet"></i></div>
                                                <h3 class="text-3  fw-400">{{ $transactions_weekcard }}</h3>
                                                <p class=" text-muted   fw-600">Card</p>

                                            </a>
                                        </div>
                                    </div>

                                </div>

                                {{--  --}}
                            </div>
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel"
                                aria-labelledby="nav-contact-tab" tabindex="0">

                                {{--  --}}

                                <div class="row">
                                    <div class="col-sm-6 col-md-3">
                                        <div class="bg-white shadow-sm rounded text-center p-2 ">
                                            <a href="{{ route('indexdaily') }}">
                                                <div class="text-7 text-primary my-3"><i class="fas fa-wallet"></i></div>
                                                <h3 class="text-3  fw-400"> {{ $transactions_month }}</h3>
                                                <p class=" text-muted   fw-600">This Month</p>

                                            </a>


                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-3">
                                        <div class="bg-white shadow-sm rounded text-center p-2 ">
                                            <a href="{{ route('indexweekly') }}">
                                                <div class="text-7 text-primary my-3"><i class="fas fa-wallet"></i></div>
                                                <h3 class="text-3  fw-400">{{ $transactions_monthdepo }}</h3>
                                                <p class=" text-muted   fw-600">Deposits</p>

                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="bg-white shadow-sm rounded text-center p-2 ">
                                            <a href="{{ route('indexweekly') }}">
                                                <div class="text-7 text-primary my-3"><i class="fas fa-wallet"></i></div>
                                                <h3 class="text-3  fw-400">{{ $transactions_monthmomo }}</h3>
                                                <p class=" text-muted   fw-600">Mobile Money</p>

                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="bg-white shadow-sm rounded text-center p-2">
                                            <a href="{{ route('indexmonthly') }}">
                                                <div class="text-7 text-primary my-3"><i class="fas fa-wallet"></i></div>
                                                <h3 class="text-3  fw-400">{{ $transactions_monthcard }}</h3>
                                                <p class=" text-muted   fw-600">Card</p>

                                            </a>
                                        </div>
                                    </div>

                                </div>

                                {{--  --}}
                            </div>
                            <div class="tab-pane fade" id="nav-disabled" role="tabpanel"
                                aria-labelledby="nav-disabled-tab" tabindex="0">

                                {{--  --}}

                                <div class="row">
                                    <div class="col-sm-6 col-md-3">
                                        <div class="bg-white shadow-sm rounded text-center p-2 ">
                                            <a href="{{ route('indexdaily') }}">
                                                <div class="text-7 text-primary my-3"><i class="fas fa-wallet"></i></div>
                                                <h3 class="text-3  fw-400"> {{ $transactions_year }}</h3>
                                                <p class=" text-muted   fw-600">This Year</p>

                                            </a>


                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-3">
                                        <div class="bg-white shadow-sm rounded text-center p-2 ">
                                            <a href="{{ route('indexweekly') }}">
                                                <div class="text-7 text-primary my-3"><i class="fas fa-wallet"></i></div>
                                                <h3 class="text-3  fw-400">{{ $transactions_yeardepo }}</h3>
                                                <p class=" text-muted   fw-600">Deposits</p>

                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="bg-white shadow-sm rounded text-center p-2 ">
                                            <a href="{{ route('indexweekly') }}">
                                                <div class="text-7 text-primary my-3"><i class="fas fa-wallet"></i></div>
                                                <h3 class="text-3  fw-400">{{ $transactions_yearmomo }}</h3>
                                                <p class=" text-muted   fw-600">Mobile Money</p>

                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="bg-white shadow-sm rounded text-center p-2">
                                            <a href="{{ route('indexmonthly') }}">
                                                <div class="text-7 text-primary my-3"><i class="fas fa-wallet"></i></div>
                                                <h3 class="text-3  fw-400">{{ $transactions_yearcard }}</h3>
                                                <p class=" text-muted   fw-600">Card</p>

                                            </a>
                                        </div>
                                    </div>

                                </div>

                                {{--  --}}
                            </div>
                        </div>





                    </div>
                    <!-- Profile Completeness End -->

                    {{-- showrooms --}}

                    {{-- showrooms end --}}
                    <!-- Recent Activity
                  =============================== -->
                    <div class="bg-white shadow-sm rounded py-4 mb-4">
                        <h3 class="text-5 fw-400 d-flex align-items-center px-4 mb-1">Recent</h3>

                        <!-- Transaction List-->
                        <div class="bg-white shadow-sm rounded p-4 mb-4">


                            <div class="table-responsive mt-2">
                                <div class="d-md-flex justify-content-between flex-sm-column flex-md-row">
                                    <div class="flex-grow-2">
                                        <div class="input-group input-group-sm mb-1 ">
                                            <span class="input-group-text" id="inputGroup-sizing-sm">From</span>
                                            <input type="date" placeholder="" id="date1" name="date1"
                                                class="form-control form-control-sm search"
                                                aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                        </div>
                                    </div>
                                    <div class="flex-grow-2 mx-2">
                                        <div class="input-group input-group-sm mb-1 ">
                                            <span class="input-group-text" id="inputGroup-sizing-sm">To</span>
                                            <input type="date" placeholder="search showrooms" name="date2"
                                                id="date2" class="form-control form-control-sm search"
                                                aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                        </div>
                                    </div>
                                    <div class="flex-grow-2 mx-2 ">
                                        <div class="input-group input-group-sm mb-1 ">
                                            <button type="button" name="filter" id="filter"
                                                class=" btn btn-sm btn-outline-primary mb-4">Filter</button>
                                            <button type="button" name="refresh" id="refresh"
                                                class="btn btn-sm btn-outline-primary mb-4">Refresh</button>
                                        </div>
                                    </div>


                                    <div class="mx-3 flex-grow-1 ">
                                        <h3 class="text-3 text-end  fw-600 "> <a
                                                class="btn btn-sm btn-outline-primary fw-600 btn-sm mb-4"
                                                href="#">{{ $total }}</a> </h3>
                                    </div>
                                </div>
                                <div class="d-md-flex justify-content-between flex-sm-column flex-md-row">
                                    <div class="col-md-6 col-sm-12 col-lg-6">
                                        <div class="flex-grow-2 ">
                                            <div class="input-group input-group-sm mb-3 ">
                                                <span class="input-group-text" id="inputGroup-sizing-sm"><i
                                                        class="fas fa-search"></i></span>
                                                <input type="text" placeholder="transactions" id="search1"
                                                    class="form-control form-control-sm search"
                                                    aria-label="Sizing example input"
                                                    aria-describedby="inputGroup-sizing-sm">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <table id="dataTable2" width="100%" class="table table-striped table-hover dataTable2">
                                    <thead class="table-dark_">
                                        <tr>
                                            <th class="border-top-0 text-white_"></th>
                                            <th class="border-top-0 text-white_">Date</th>
                                            <th class="border-top-0 text-white_">Bank</th>
                                            <th class="border-top-0 text-white_">Sales Ref</th>

                                            <th class="border-top-0 text-white_">Type</th>
                                            <th class="border-top-0 text-white_">Amount</th>
                                            <th class="border-top-0 text-white_">Customer</th>

                                            <th class="border-top-0 text-white_">Showroom</th>
                                            <th class="border-top-0 text-white_">Status</th>
                                            <th class="border-top-0 text-white_">Reconcile Status</th>




                                        </tr>
                                    </thead>

                                    <tbody>

                                    </tbody>
                                </table>
                                @can('Reconcile')
                                    <div class="reconsile">
                                        <form method="POST" action="{{ route('payments.reconsile') }}" id="reconsile">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-primary">Reconcile</button>
                                        </form>
                                    </div>
                                @endcan
                            </div>

                        </div>
                        <!-- Transaction List End -->



                    </div>
                    <!-- Recent Activity End -->
                </div>
                <!-- Middle Panel End -->
            </div>
        </div>
    </div>
    <!-- Content end -->
    @include('partials._fullModal')
@endsection


@section('script')
    <script type="text/javascript">
        $(function() {


            load_data();

            function load_data(from_date = '', to_date = '') {
                var table = $('.dataTable2').DataTable({
                    processing: true,
                    serverSide: true,
                    bFilter: false,
                    "dom": '<"top"f>rt<"bottom m-3"lp><"clear">',
                    ajax: {
                        url: "{{ route('weekly') }}",
                        data: function(d) {
                            d._token = "{{ csrf_token() }}",
                                d.search = $('#search1').val(),
                                d.date1 = from_date,
                                d.date2 = to_date

                        }
                    },
                    columns: [{
                            'targets': 0,
                            data: 'id',
                            name: 'id',
                            'checkboxes': {
                                'selectRow': true
                            }
                        },
                        {
                            data: 'date',
                            name: 'date',
                            searchable: true
                        },
                        {
                            data: 'bank',
                            name: 'bank',
                            searchable: true
                        },
                        {
                            data: 'sales_reference_id',
                            name: 'sales_reference_id',
                            searchable: true
                        },

                        {
                            data: 'transaction_type',
                            name: 'transaction_type',
                            searchable: true
                        },
                        {
                            data: 'amount',
                            name: 'amount',
                            searchable: true
                        },
                        {
                            data: 'customer_name',
                            name: 'customer_name',
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
                        {
                            data: 'reconsile',
                            name: 'reconsile',
                            searchable: true
                        },





                    ],
                    'select': {
                        'style': 'multi'
                    },
                });
                $("#search1").keyup(function() {
                    table.draw();
                })


                $('#reconsile').on('submit', function(e) {
                    // e.preventDefault();
                    var form = this;

                    var rows_selected = table.column(0).checkboxes.selected();

                    // Iterate over all selected checkboxes
                    $.each(rows_selected, function(index, rowId) {
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
            }

            $('#filter').click(function() {
                var from_date = $('#date1').val();
                var to_date = $('#date2').val();
                if (from_date != '' && to_date != '') {
                    $('#dataTable2').DataTable().destroy();
                    load_data(from_date, to_date);
                } else {
                    alert('Both Date is required');
                }
            });

            $('#refresh').click(function() {
                $('#fdate1').val('');
                $('#date2').val('');
                $('#dataTable2').DataTable().destroy();
                load_data();
            });


        });
    </script>
@endsection
