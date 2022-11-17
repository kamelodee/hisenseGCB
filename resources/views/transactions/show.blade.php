<div class="row g-0">
    <div class="col-sm-5 d-flex justify-content-center bg-primary rounded-start py-4">
      <div class="my-auto text-center">
        <div class="text-17 text-white my-3"><i class="fas fa-building"></i></div>
        <h3 class="text-4 text-white fw-400 my-3">{{$transaction->customer_name}}</h3>
        <div class="text-8 fw-500 text-white my-4">{{$amount}}</div>
        <p class="text-white">{{$transaction->date}}</p>
      </div>
    </div>
    <div class="col-sm-7">
     
      <div class="px-3">
        
        <p class="d-flex align-items-center fw-500 mb-0">Total Amount <span class="text-3 ms-auto">{{$amount}}</span></p>
        <hr class="mb-4 mt-2">
        <ul class="list-unstyled">
          <li class="fw-500">Showroom:</li>
          <li class="text-muted">{{$transaction->showroom}}</li>
        </ul>
        @if ($transaction->account_number)
        <ul class="list-unstyled">
          <li class="fw-500">Account Number:</li>
          <li class="text-muted">{{$transaction->account_number}}</li>
        </ul>
        @endif
       
        <ul class="list-unstyled">
          <li class="fw-500">Customer:</li>
          <li class="text-muted">{{$transaction->customer_name}}</li>
        </ul>
        <ul class="list-unstyled">
          <li class="fw-500">Sale Reference:</li>
          <li class="text-muted">{{$transaction->sales_reference_id}}</li>
        </ul>
        <ul class="list-unstyled">
          <li class="fw-500">Transaction ID:</li>
          <li class="text-muted">{{$transaction->transaction_id}}</li>
        </ul>
        <ul class="list-unstyled">
          <li class="fw-500">Description:</li>
          <li class="text-muted">{{$transaction->description}}</li>
        </ul>
        <ul class="list-unstyled">
          <li class="fw-500">Status:</li>
          <li class="text-muted">{{$transaction->status}}<span class="text-success text-3 ms-1"><i class="fas fa-check-circle"></i></span></li>
        </ul>
      </div>
    </div>
  </div>
