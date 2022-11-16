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
            <h3 class="text-3 fw-400">GHC {{$total}}</h3>
            <p class="mb-1 text-muted opacity-8">Total Sum</p>
            <small class="text-muted opacity-8">Successful Payments</small>
            <hr class="mx-n3">
           
          </div>
          <!-- Available Balance End --> 
          
        
          @can('Access All')
          <h3 class="text-3 fw-400">Activities</h3>
          @foreach ($activities as $cti )
          <div class=" shadow-sm rounded text-center p-3 mb-4">
           
            <h3 class="text-2 fw-400"><i class="fas fa-user mx-2"></i>{{ $cti->user_name }}</h3>
            <hr class="mx-n3">
            <p class="mb-1 text-1 "><a onclick="TransactionDetails({{$cti->model_id}})" href="javascript:void()">{{$cti->description}} at <br>{{$cti->created_at}}</a></p>
         
            

        </div>
          @endforeach
          {{ $activities->links() }}
          <!-- Available Balance End -->


      @endcan
        </aside>
        <!-- Left Panel End -->
        
        <!-- Middle Panel
        ============================================= -->
        <div class="col-lg-10 col-md-9 col-sm-12 ">
          <h4 class="fw-400 mb-3">UBA Transactions</h4>
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
                            <th class="border-top-0 text-white_">Sales Reference ID</th>
                            <th class="border-top-0 text-white_">Bank Transaction ID</th>
                            
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
@section('bank')
<li>
  <a class="text-success" href="{{route('transactions.uba')}}">UBA Transactions</a>
  
</li>
@endsection

@section('script')
<script type="text/javascript">

$(function() {
   
    var table = $('.dataTable2').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('transactions.ubalist') }}",
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

});
</script>
@endsection