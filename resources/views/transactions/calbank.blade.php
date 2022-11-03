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
            <div class="text-17 text-light my-3"><i class="fas fa-wallet"></i></div>
            <h3 class="text-3 fw-400">GHC2956.00</h3>
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
   
    var table = $('.dataTable2').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('transactions.list') }}",
        columns: [
            {
                data: 'id',
                name: 'id',
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
                data: 'ref',
                name: 'ref',
                searchable: true
            },
            {
                data: 'showroom',
                name: 'showroom',
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