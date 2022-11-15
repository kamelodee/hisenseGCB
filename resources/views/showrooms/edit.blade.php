<form id="form-send-money" method="post" action="{{route('showrooms.update',$showroom->id)}}">
    @csrf
    <div class="mb-3">
      <label for="payerName" class="form-label">Name</label>
      <input type="text" value="{{$showroom->name}}" name="name" class="form-control" data-bv-field="payerName" id="payerName" required="" placeholder="Enter Name">
    </div>
    <div class="mb-3">
      <label for="payerName" class="form-label">Street</label>
      <input type="text" value="{{$showroom->street}}" name="street" class="form-control" data-bv-field="payerName" id="payerName" required="" placeholder="Enter Name">
    </div>
    <div class="mb-3">
      <label for="payerName" class="form-label">City</label>
      <input type="text" value="{{$showroom->city}}" name="city" class="form-control" data-bv-field="payerName" id="payerName" required="" placeholder="Enter Name">
    </div>
   
   
    <div class="mb-3">
      <label for="emailID" class="form-label">Phone</label>
      <input type="text" value="{{$showroom->phone}}" name="phone" class="form-control" data-bv-field="emailid" id="emailID" required="" placeholder="Enter Phone Number">
    </div>
    <div class="mb-3">
      <label for="emailID" class="form-label">Account Number</label>
      <input type="text" value="{{$showroom->account_number}}" name="account_number" class="form-control" data-bv-field="emailid" id="emailID"  placeholder="account_number">
    </div>
    
    
   
   
    <div class="d-grid mt-4"><button type="submit" class="btn btn-primary">Save</button></div>
  </form>