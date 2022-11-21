@extends('layouts.layout1')
@section('content')
    <!-- Content ============================================= -->
    <div id="content" class="py-4">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('showrooms.transaction') }}">All Showrooms</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $showroom->name }}</li>
                </ol>
            </nav>

            <div class="row">
                <!-- Left Panel ============================================= -->
                <aside class="col-lg-3 col-md-3 col-sm-12">

           
                    <div class="bg-primary shadow-sm rounded text-center py-2 mb-4">
                        <a href="">
                            <h3 class="text-4 text-white  fw-600">{{ $showroom->name }}</h3>

                        </a>


                    </div>
                    <div class="bg-white shadow-sm rounded text-center p-3 mb-4">
                        <a href="#">
                            <div class="text-10 text-primary my-3"><i class="fas fa-building"></i></div>
                            <h3 class="text-3  fw-400"> {{ $total }}</h3>
                            <p class="text-muted   fw-600"> Total</p>
                        </a>


                    </div>
                    <div class="bg-white shadow-sm rounded text-center p-3 mb-4">
                        <a href="{{ route('transactions.gcb') }}">
                            <div class="text-10 text-primary my-3"><i class="fas fa-building"></i></div>
                            <h3 class="text-3  fw-400"> {{ $gcb }}</h3>
                            <p class="text-muted   fw-600">GCB Transactions</p>
                        </a>


                    </div>
                
                    <div class="bg-white shadow-sm rounded text-center p-3 mb-4">
                        <a href="{{ route('transactions.uba') }}">
                            <div class="text-10 text-primary my-3"><i class="fas fa-building"></i></div>
                            <h3 class="text-3 fw-400"> {{ $uba }}</h3>
                            <p class="text-muted   fw-600 ">UBA Transactions</p>
                        </a>


                    </div>



                </aside>
             <!-- Left Panel end ============================================= -->
                <div class="col-lg-9 col-md-9 col-sm-12">

                    <div class="bg-white shadow-sm rounded p-4 mb-2">

                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <div class="bg-white shadow-sm rounded text-center p-2 ">
                                    <a href="{{ route('showrooms.indexdaily') . '?showroom=' . $showroom->name }}">
                                        <div class="text-7 text-primary my-3"><i class="fas fa-wallet"></i></div>
                                        <h3 class="text-3  fw-400"> {{ $transactions_today }}</h3>
                                        <p class=" text-muted   fw-600">Today</p>

                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="bg-white shadow-sm rounded text-center p-2 ">
                                    <a href="{{ route('showrooms.indexweekly') . '?showroom=' . $showroom->name }}">
                                        <div class="text-7 text-primary my-3"><i class="fas fa-wallet"></i></div>
                                        <h3 class="text-3  fw-400"> {{ $transactions_week }}</h3>
                                        <p class=" text-muted   fw-600">This Week</p>

                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="bg-white shadow-sm rounded text-center p-2">
                                    <a href="{{ route('showrooms.indexmonthly') . '?showroom=' . $showroom->name }}">
                                        <div class="text-7 text-primary my-3"><i class="fas fa-wallet"></i></div>
                                        <h3 class="text-3  fw-400"> {{ $transactions_month }}</h3>
                                        <p class=" text-muted   fw-600">This Month</p>

                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="bg-white shadow-sm rounded text-center p-2 ">
                                    <a href="{{ route('showrooms.indexyearly') . '?showroom=' . $showroom->name }}">
                                        <div class="text-7 text-primary my-3"><i class="fas fa-wallet"></i></div>
                                        <h3 class="text-3  fw-400"> {{ $transactions_year }}</h3>
                                        <p class=" text-muted   fw-600">This Year</p>
                                    </a>

                                </div>
                            </div>
                        </div>
                        <!-----==========================================-->
                        <div class="row my-2">
                          <div class="col-sm-6 col-md-3">
                              <div class="bg-white shadow-sm rounded text-center p-2 ">
                                  <a href="{{ route('showrooms.typeTrans','CASH') . '?showroom=' . $showroom->name }}">
                                      <div class="text-7 text-primary my-3"><i class="far fa-money-bill-alt"></i></div>
                                      <h3 class="text-3  fw-400"> {{ $cash }}</h3>
                                      <p class=" text-muted   fw-600">Cash </p>

                                  </a>
                              </div>
                          </div>
                          <div class="col-sm-6 col-md-3">
                              <div class="bg-white shadow-sm rounded text-center p-2 ">
                                  <a href="{{ route('showrooms.typeTrans','MOMO') . '?showroom=' . $showroom->name }}">
                                      <div class="text-7 text-primary my-3"><i class="fas fa-mobile"></i></div>
                                      <h3 class="text-3  fw-400"> {{ $momo }}</h3>
                                      <p class=" text-muted   fw-600">Mobile Money</p>

                                  </a>
                              </div>
                          </div>
                          <div class="col-sm-6 col-md-3">
                              <div class="bg-white shadow-sm rounded text-center p-2">
                                  <a href="{{ route('showrooms.typeTrans','CARD') . '?showroom=' . $showroom->name }}">
                                      <div class="text-7 text-primary my-3"><i class="fas fa-credit-card"></i></div>
                                      <h3 class="text-3  fw-400"> {{ $card }}</h3>
                                      <p class=" text-muted   fw-600">Card</p>

                                  </a>
                              </div>
                          </div>
                          <div class="col-sm-6 col-md-3">
                              <div class="bg-white shadow-sm rounded text-center p-2 ">
                                  <a href="{{ route('showrooms.typeTrans','GCB') . '?showroom=' . $showroom->name }}">
                                      <div class="text-7 text-primary my-3"><i class="fas fa-money-check"></i></div>
                                      <h3 class="text-3  fw-400"> {{ $gcb }}</h3>
                                      <p class=" text-muted   fw-600">GCB</p>
                                  </a>

                              </div>
                          </div>
                      </div>
                      <!--===========================================================-->
                    </div>
                
                    <div class="bg-white shadow-sm rounded py-4 mb-4">
                        <h3 class="text-5 fw-400 d-flex align-items-center px-4 mb-1">Recent</h3>

                        <!-- Transaction List-->
                        <div class="bg-white shadow-sm rounded p-4 mb-4">
                            <div class="table-responsive mt-2">
                                <div class="d-md-flex justify-content-between flex-sm-column flex-md-row">
                                    <div class="col-md-6 col-sm-12 col-lg-6">
                                        <div class="flex-grow-2 ">
                                          <div class="input-group input-group-sm mb-3 ">
                                              <span class="input-group-text" id="inputGroup-sizing-sm"><i class="fas fa-search"></i></span>
                                              <input type="text" placeholder="transactions" id="search1" class="form-control form-control-sm search" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                            </div>
                                      </div>
                                      </div>
                                      <div class="reconsile">
                                       <form method="POST" action="{{route('payments.reconsile')}}" id="reconsile">
                                       @csrf
                                        <button type="submit" class="btn btn-sm btn-primary">Reconcile</button>
                                       </form>
                                      </div>
                                   </div>
                                   <table id="dataTable2" width="100%" class="table table-striped table-hover dataTable2">
                                    <thead class="table-dark_">
                                        <tr>
                                            <th class="border-top-0 text-white_">#</th>
                                            <th class="border-top-0 text-white_">Date</th>
                                            <th class="border-top-0 text-white_">Sales Ref</th>
                                            <th class="border-top-0 text-white_">Transaction ID</th>
                                            <th class="border-top-0 text-white_">Transaction Type</th>
                                            <th class="border-top-0 text-white_">Amount</th>
                                          
                                            <th class="border-top-0 text-white_">Showroom</th>
                                            <th class="border-top-0 text-white_">Status</th>
                                            <th class="border-top-0 text-white_">Reconcile Status</th>
                    
                                        </tr>
                                    </thead>
                            
                                    <tbody>
                                       
                                    </tbody>
                                </table>

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

function load_data(from_date = '', to_date = '')
{
            var table = $('.dataTable2').DataTable({
                processing: true,
                serverSide: true, 
                bFilter: false,
                "dom": '<"top"f>rt<"bottom"lp><"clear">',
                ajax: {
                    url: "{{ route('showrooms.weekly', $showroom->name) }}",
                data: function (d) {
                          d._token = "{{ csrf_token() }}",
                            d.search = $('#search1').val(),
                            d.date1 = from_date,
                            d.date2 = to_date,
                           
                            d.showroom = "{{$showroom}}"
                        
                        }
                    },
                    columns: [
                        {
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
                data: 'sales_reference_id',
                name: 'sales_reference_id',
                searchable: true
            },
            {
                data: 'transaction_id',
                name: 'transaction_id'
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
            $("#search1").keyup(function(){
        table.draw();})     

        
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
}













        });
    </script>
@endsection
