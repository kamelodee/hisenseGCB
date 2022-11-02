@extends('layouts.layout1')
@section('content')
<!-- Secondary menu
  ============================================= -->
  <div class="bg-primary">
    <div class="container d-flex justify-content-center">
      <ul class="nav nav-pills alternate nav-lg border-bottom-0">
        <li class="nav-item"> <a class="nav-link active" href="{{route('payment')}}">CalBank</a></li>
        <li class="nav-item"> <a class="nav-link " href="{{route('uba')}}">UBA</a></li>
      </ul>
    </div>
  </div>
  <!-- Secondary menu end --> 
  <!-- Content
  ============================================= -->
  <div id="content" class="py-4">
    <div class="container"> 
      
   

      <div class="row">
        <div class="col-md-9 col-lg-7 col-xl-6 mx-auto">
          <div class="bg-white shadow-sm rounded p-3 pt-sm-4 pb-sm-5 px-sm-5 mb-4">
            <h3 class="text-5 fw-400 mb-3 mb-sm-4">Customer Details</h3>
            <hr class="mx-n3 mx-sm-n5 mb-4">
            <!-- Request Money Form
            ============================================= -->
            <form id="form-send-money" method="post">
              <div class="mb-3">
                <label for="payerName" class="form-label">FirstnName</label>
                <input type="text" value="" class="form-control" data-bv-field="payerName" id="payerName" required="" placeholder="Enter Name">
              </div>
              <div class="mb-3">
                <label for="payerName" class="form-label">Last Name</label>
                <input type="text" value="" class="form-control" data-bv-field="payerName" id="payerName" required="" placeholder="Enter Name">
              </div>
              <div class="mb-3">
                <label for="emailID" class="form-label">Email</label>
                <input type="text" value="" class="form-control" data-bv-field="emailid" id="emailID" required="" placeholder="Enter Email Address">
              </div>
              <div class="mb-3">
                <label for="emailID" class="form-label">Phone</label>
                <input type="text" value="" class="form-control" data-bv-field="emailid" id="emailID" required="" placeholder="Enter Phone Number">
              </div>



      
              <div class="mb-3">
                <label for="amount" class="form-label">Amount</label>
                <div class="input-group">
                  <span class="input-group-text">GHC</span>
                  <input type="text" class="form-control" data-bv-field="amount" id="amount" value="1,000.00" placeholder="">
                  <span class="input-group-text p-0">
                    <select id="recipientCurrency" data-style="form-select bg-transparent border-0" data-container="body" data-live-search="true" class="selectpicker form-control bg-transparent" required="">
                      <optgroup label="Popular Currency">
                      <option data-icon="currency-flag currency-flag-usd me-1" data-subtext="United States dollar" value="">GHC</option>
                       </optgroup>
                    </select>
                    </span>
                </div>
              </div>
              <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" rows="4" id="description" required="" placeholder="Payment Description"></textarea>
              </div>
             
              <div class="d-grid mt-4"><button class="btn btn-primary">Continue</button></div>
            </form>
            <!-- Request Money Form end --> 
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Content end --> 
  
@endsection