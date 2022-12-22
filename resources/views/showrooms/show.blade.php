<form id="form-send-money" method="post" action="">
    @csrf
    <div class="mb-3">
      <label for="payerName" class="form-label">Name</label>
      <input type="text" disabled value="{{$showroom->name}}" name="name" class="form-control" data-bv-field="payerName" id="payerName" required="" placeholder="Enter Name">
    </div>
    <div class="mb-3">
      <label for="payerName" class="form-label">Street</label>
      <input type="text" disabled value="{{$showroom->street}}" name="street" class="form-control" data-bv-field="payerName" id="payerName" required="" placeholder="Enter Name">
    </div>
    <div class="mb-3">
      <label for="payerName" class="form-label">City</label>
      <input type="text" disabled value="{{$showroom->city}}" name="city" class="form-control" data-bv-field="payerName" id="payerName" required="" placeholder="Enter Name">
    </div>
   
   
    <div class="mb-3">
      <label for="emailID" class="form-label">Phone</label>
      <input type="text" disabled value="{{$showroom->phone}}" name="phone" class="form-control" data-bv-field="emailid" id="emailID" required="" placeholder="Enter Phone Number">
    </div>
    
    <div class="mb-3">
      <label for="emailID" class="form-label">Account numbers</label>
       <ul class="list-group list-group-horizontal">
        <li class="list-group-item">Default Bank</li>
        <li class="list-group-item">{{$showroom->account_number}}</li>
      
      </ul>
      <div class="row">
      @foreach ( $showroom->accounts as $account)
      <div class="col-md-6 col-lg-6 col-sm-12">

      <div><ul class="list-group list-group-horizontal">
        <li class="list-group-item">{{$account->bank}}</li>
        <li class="list-group-item">{{$account->account_number}}</li>
      </ul></div>
    </div>
      @endforeach
    </div>
    </div>
    
    
   
   
   
  </form>