<form id="form-send-money" method="post" action="{{route('showrooms.storeaccount')}}">
    @csrf
    
     <h3>{{$showroom->name}}</h3>
    
    <div class="mb-3">
      <label for="emailID" class="form-label">Account number</label>
      <input type="hidden" value="{{$showroom->id}}" name="showroom_id">
      <input required type="text" value="" name="account_number" class="form-control" data-bv-field="emailid" id="emailID"  placeholder="account_number">
    </div>

    <div class="mb-3">
      <label for="emailID" class="form-label">Bank Name</label>
     
      <input required type="text" value="" name="bank" class="form-control"  id="emailID"  placeholder="bank name">
    </div>
    
    
   
   
    <div class="d-grid mt-4"><button type="submit" class="btn btn-primary">Save</button></div>
  </form>