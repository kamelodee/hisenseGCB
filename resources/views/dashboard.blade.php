@extends('layouts.layout1')
@section('content')

  <!-- Content
  ============================================= -->
  <div id="content" class="py-4">
    <div class="container">
      <div class="row"> 
        <!-- Left Panel
        ============================================= -->
        <aside class="col-lg-3 col-md-3 col-sm-12"> 
       
          <!-- Available Balance
          =============================== -->
          <div class="bg-white shadow-sm rounded text-center p-3 mb-4">
            <a href="{{route('transactions.calbank')}}">
            <div class="text-10 text-primary my-3"><i class="fas fa-building"></i></div>
            <h3 class="text-3 fw-400">GHC {{$calbank}}</h3>
            <p class="mb-2 text-muted opacity-8">CalBank</p>
          </a>
            <hr class="mx-n3">
          
          </div>
          <div class="bg-white shadow-sm rounded text-center p-3 mb-4">
            <a href="{{route('transactions.uba')}}">
            <div class="text-10 text-primary my-3"><i class="fas fa-building"></i></div>
            <h3 class="text-3 fw-400">GHC {{$uba}}</h3>
            <p class="mb-2 text-muted opacity-8">UBA</p>
            </a>
            <hr class="mx-n3">
          
          </div>
          <div class="bg-white shadow-sm rounded text-center p-3 mb-4">
            <a href="{{route('transactions.gcb')}}">
            <div class="text-10 text-primary my-3"><i class="fas fa-building"></i></div>
            <h3 class="text-3  fw-400">GHC {{$gcb}}</h3>
            <p class="mb-2 text-muted opacity-8">GCB</p>
            </a>
            <hr class="mx-n3">
          
          </div>
          <div class="bg-white shadow-sm rounded text-center p-3 mb-4">
            <a href="{{route('transactions.zenith')}}">
            <div class="text-10 text-primary my-3"><i class="fas fa-building"></i></div>
            <h3 class="text-3 fw-400">GHC {{$zenith}}</h3>
            <p class="mb-2 text-muted opacity-8">ZenithBank</p>
            </a>
            <hr class="mx-n3">
          
          </div>
          <!-- Available Balance End --> 
          
         
          
        </aside>
        <!-- Left Panel End -->
        
        <!-- Middle Panel
        ============================================= -->
        <div class="col-lg-9 col-md-9 col-sm-12"> 
          
          <!-- Profile Completeness
          =============================== -->
          <div class="bg-white shadow-sm rounded p-4 mb-4">
            
            <div class="row gy-4 profile-completeness">
              <div class="col-sm-6 col-md-3">
                <div class="bg-white shadow-sm rounded text-center p-3 mb-4">
                  <a href="{{route('indexdaily')}}">
                  <div class="text-10 text-primary my-3"><i class="fas fa-wallet"></i></div>
                  <h3 class="text-3  fw-400">GHC {{$transactions_today}}</h3>
                  <p class="mb-2 text-muted opacity-8">Daily Transactions</p>
                 
                </a>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="bg-white shadow-sm rounded text-center p-3 mb-4">
                  <a href="{{route('indexweekly')}}">
                  <div class="text-10 text-primary my-3"><i class="fas fa-wallet"></i></div>
                  <h3 class="text-3  fw-400">GHC {{$transactions_week}}</h3>
                  <p class="mb-2 text-muted opacity-8">Weekly Transactions</p>
                
                  </a>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="bg-white shadow-sm rounded text-center p-3 mb-4">
                  <a href="{{route('indexmonthly')}}">
                  <div class="text-10 text-primary my-3"><i class="fas fa-wallet"></i></div>
                  <h3 class="text-3  fw-400">GHC {{$transactions_month}}</h3>
                  <p class="mb-2 text-muted opacity-8">Monthly Transactions</p>
                  
                  </a>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="bg-white shadow-sm rounded text-center p-3 mb-4">
                  <a href="{{route('indexyearly')}}">
                  <div class="text-10 text-primary my-3"><i class="fas fa-wallet"></i></div>
                  <h3 class="text-3  fw-400">GHC {{$transactions_year}}</h3>
                  <p class="mb-2 text-muted opacity-8">Yearly Transactions</p>
                  </a>
                
                </div>
              </div>
            </div>
          </div>
          <!-- Profile Completeness End --> 
          
          <!-- Recent Activity
          =============================== -->
          <div class="bg-white shadow-sm rounded py-4 mb-4">
            <h3 class="text-5 fw-400 d-flex align-items-center px-4 mb-1">Recent Transactions</h3>
            
            
            
            <!-- Transaction List-->
           <div class="bg-white shadow-sm rounded p-4 mb-4">
           
           
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
     
      var table = $('.dataTable2').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('transactions.ubalist') }}",
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