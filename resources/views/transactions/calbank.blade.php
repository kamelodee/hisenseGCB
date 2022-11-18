@extends('layouts.layout1')
@section('content')

  <!-- Content
  ============================================= -->
  <div id="content" class="py-4">
    <div class="container">
      <div class="row"> 

        <aside class="col-lg-2 col-md-3 col-sm-12"> 
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item">CALBANK Payments</li>
            
            </ol>
          </nav>
          <!-- Available Balance
          =============================== -->
          <div class="bg-white shadow-sm rounded text-center p-3 mb-4">
            <div class="text-17 text-light my-3"><i class="fas fa-wallet"></i></div>
            <h3 class="text-3 fw-400">2956.00</h3>
            <p class="mb-2 text-muted opacity-8">Total Transactions</p>
            <hr class="mx-n3">
           
          </div>
          <!-- Available Balance End --> 
          
        
          
        </aside>
        <!-- Left Panel End -->
        
        <!-- Middle Panel
        ============================================= -->
        <div class="col-lg-10 col-md-9 col-sm-12 ">
          <h2 class="fw-400 mb-3">Transactions</h2>
          
          <!-- All Transactions
          ============================================= -->
          <div class="bg-white shadow-sm rounded p-4 mb-4">
            <h3 class="text-5 fw-400 d-flex align-items-center px-4 mb-4">All Transactions</h3>
           
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
                <div class="flex-grow-2 mx-2">
                    <div class="input-group input-group-sm mb-3 ">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Search</span>
                        <input type="text" placeholder="transactions" id="search1" class="form-control form-control-sm search" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                      </div>
                </div>
               
                  <div class="mx-3 flex-grow-1 "><h3 class="text-3 text-end  fw-600"> {{$total}}</h3></div>
            </div>
              <table id="dataTable2" width="100%" class="table table-striped table-hover dataTable2">
                  <thead class="table-dark_">
                      <tr>
                          <th class="border-top-0 text-white_">#</th>
                          <th class="border-top-0 text-white_">Date</th>
                          <th class="border-top-0 text-white_">Transaction ID</th>
                          <th class="border-top-0 text-white_">Transaction Type</th>
                          <th class="border-top-0 text-white_">Amount</th>
                          <th class="border-top-0 text-white_">Ref</th>
                          <th class="border-top-0 text-white_">Showroom</th>
                          <th class="border-top-0 text-white_">Ceated At</th>
                         
                         
                         
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
            load_data();

function load_data(from_date = '', to_date = '')
{
            var table = $('.dataTable2').DataTable({
                processing: true,
                serverSide: true, 
                bFilter: false,
                ajax: {
                    url: "{{ route('transactions.list') }}",
                data: function (d) {
                          d._token = "{{ csrf_token() }}",
                            d.search = $('#search1').val(),
                            d.date1 = from_date,
                            d.date2 = to_date
                        
                        }
                    },
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
                        data: 'sales_reference_id',
                        name: 'sales_reference_id'
                    },
                    {
                        data: 'transaction_id',
                        name: 'transaction_id'
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
            $("#search1").keyup(function(){
        table.draw();
    });
            $("#date1").keyup(function(){
        table.draw();
    });
            $("#date2").keyup(function(){
        table.draw();
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