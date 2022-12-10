@extends('layouts.layout1')
@section('content')
    <!-- Content
      ============================================= -->
    <div id="content" class="py-4">
        <div class="container">
           <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item">All Payments</li>
                
                </ol>
              </nav>
            <div class="row">

                <aside class="col-lg-2 col-md-3 col-sm-12">
                    <div class="bg-primary shadow-sm rounded text-center py-2 mb-4">
                        <a href="">
                        <h3 class="text-4 text-white  fw-600">All Payments</h3>
                       
                        </a>
                    
                      </div>
                    <!-- Available Balance
              =============================== -->
                    <div class="bg-white shadow-sm rounded text-center p-3 mb-4">
                        <div class="text-10 text-primary my-3"><i class="fas fa-wallet"></i></div>
                        <h3 class="text-3 fw-400"> {{ $total }}</h3>
                        <p class="mb-1 text-muted opacity-8">Total Sum</p>
                        <small class="text-muted opacity-8">Successful Payments</small>
                        <hr class="mx-n3">

                    </div>
                    <hr> 

                    @if(App\Models\Bank::where('name',"GCB")->first()->status =="ACTIVE")
                    <div class="bg-white shadow-sm rounded text-center p-3 mb-4">
                        <a href="{{route('transactions.gcb')}}">
                        <div class="text-10 text-primary my-3"><i class="fas fa-building"></i></div>
                        <h3 class="text-3  fw-400"> {{$gcb}}</h3>
                        <p class="text-muted   fw-600">GCB Transactions</p>
                        </a>
                       
                      
                      </div>
                      @endif
                      @if(App\Models\Bank::where('name',"ZENITH")->first()->status =="ACTIVE")
                      <div class="bg-white shadow-sm rounded text-center p-3 mb-4">
                        <a href="{{route('transactions.zenith')}}">
                        <div class="text-10 text-primary my-3"><i class="fas fa-building"></i></div>
                        <h3 class="text-3 fw-400">GHC {{$zenith}}</h3>
                        <p class="text-muted   fw-600">Zenith Transactions</p>
                      </a>
                        <hr class="mx-n3">
                      
                      </div>
                      @endif
                      @if(App\Models\Bank::where('name',"UBA")->first()->status =="ACTIVE")
                      <div class="bg-white shadow-sm rounded text-center p-3 mb-4">
                        <a href="{{route('transactions.uba')}}">
                        <div class="text-10 text-primary my-3"><i class="fas fa-building"></i></div>
                        <h3 class="text-3 fw-400"> {{$uba}}</h3>
                        <p class="text-muted   fw-600 ">UBA Transactions</p>
                        </a>
                      
                      
                      </div>
                     @endif
                </aside>
                <!-- Left Panel End -->

                <!-- Middle Panel
            ============================================= -->
                <div class="col-lg-10 col-md-9 col-sm-12 ">
                   
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

                       
                        <div class="table-responsive mt-2">
                            <div class="d-md-flex justify-content-between flex-sm-column flex-md-row">
                                <div class="flex-grow-2">
                                    <div class="input-group input-group-sm mb-3 ">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">From</span>
                                        <input type="date" placeholder="" id="date1" name="date1" class="form-control form-control-sm search" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                      </div>
                                </div>
                                <div class="flex-grow-2 mx-2">
                                    <div class="input-group input-group-sm mb-3 ">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">To</span>
                                        <input type="date" placeholder="search showrooms" name="date2" id="date2" class="form-control form-control-sm search" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                      </div>
                                </div>
                                <div class="flex-grow-2 mx-2 ">
                                    <div class="input-group input-group-sm mb-3 ">
                                    <button type="button" name="filter" id="filter" class=" btn btn-sm btn-outline-primary mb-4">Filter</button>
                                    <button type="button" name="refresh" id="refresh" class="btn btn-sm btn-outline-primary mb-4">Refresh</button>
                                </div>
                                </div>
                               
                                  <div class="mx-3 flex-grow-1 "><h3 class="text-3 text-end  fw-600"> {{$total}}</h3></div>
                            </div>
                           <div class="d-md-flex justify-content-between flex-sm-column flex-md-row">
                            <div class="col-md-6 col-sm-12 col-lg-6">
                                <div class="flex-grow-2 mx-2">
                                  <div class="input-group input-group-sm mb-3 ">
                                      <span class="input-group-text" id="inputGroup-sizing-sm"><i class="fas fa-search"></i></span>
                                      <input type="text" placeholder="transactions" id="search1" class="form-control form-control-sm search" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                    </div>
                              </div>
                              </div>
                             
                           </div>
                            <table id="dataTable2" width="100%" class="table table-striped table-hover dataTable2 display"  cellspacing="0"  width="100%">
                                <thead class="table-dark_">
                                    <tr>
                                      
                                        <th class="border-top-0 text-white_"></th>

                                        <th class="border-top-0 text-white_">Date</th>
                                        <th class="border-top-0 text-white_">Sales Ref</th>
                                    
                                       
                                        <th class="border-top-0 text-white_">Amount</th>
                                        <th class="border-top-0 text-white_">Customer</th>
                                        <th class="border-top-0 text-white_">Showroom</th>
                                        <th class="border-top-0 text-white_">Status</th>
                                        <th class="border-top-0 text-white_">Reconcile Status</th>
                                    </tr>
                                </thead>

                                <tbody>

                                </tbody>
                                <tfoot>
                                    <tr>
                                      
                                        <th class="border-top-0 text-white_"></th>
                                     
                                        <th class="border-top-0 text-white_">Date</th>
                                        <th class="border-top-0 text-white_">Sales Ref</th>
                                      
                                       
                                        <th class="border-top-0 text-white_">Amount</th>
                                        <th class="border-top-0 text-white_">Customer</th>
                                        <th class="border-top-0 text-white_">Showroom</th>
                                        <th class="border-top-0 text-white_">Status</th>
                                        <th class="border-top-0 text-white_">Reconsile Status</th>

                                    </tr>
                                 </tfoot>
                            </table>
                            <div class="reconsile">
                                <form method="POST" action="{{route('payments.reconsile')}}" id="reconsile">
                                @csrf
                                 <button type="submit" class="btn btn-sm btn-primary">Reconcile</button>
                                </form>
                               </div>
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
           
            load_data();

function load_data(from_date = '', to_date = '')
{
            var table = $('.dataTable2').DataTable({
                processing: true,
                serverSide: true, 
                bFilter: false,
                "dom": '<"top"f>rt<"bottom m-3"lp><"clear">',
                ajax: {
                    url: "{{ route('all') }}",
                data: function (d) {
                          d._token = "{{ csrf_token() }}",
                            d.search = $('#search1').val(),
                            d.date1 = from_date,
                            d.date2 = to_date
                        
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
                        name: 'sales_reference_id'
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
                "order": [
                    [0, 1, 2, 3, 'desc']
                ]
            });
            $("#search1").keyup(function(){
        table.draw();
    });
            $("#date1").keyup(function(){
        table.draw();
    });
            $("#date2").keyup(function(){
        table.draw();
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
}


$('#filter').click(function(){
  var from_date = $('#date1').val();
  var to_date = $('#date2').val();
  if(from_date != '' &&  to_date != '')
  {
   $('#dataTable2').DataTable().destroy();
   load_data(from_date, to_date);
  }
  else
  {
   alert('Both Date is required');
  }
 });

 $('#refresh').click(function(){
  $('#fdate1').val('');
  $('#date2').val('');
  $('#dataTable2').DataTable().destroy();
  load_data();
 });



        });
      
    </script>
@endsection
