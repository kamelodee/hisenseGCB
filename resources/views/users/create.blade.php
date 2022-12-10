

  <form id="form-send-money" method="post" action="{{route('users.store')}}">
    @csrf
    <div class="mb-3">
      <label for="payerName" class="form-label">Name</label>
      <input type="text" value="" name="name" class="form-control" data-bv-field="payerName" id="payerName" required="" placeholder="Enter Name">
    </div>

    <div class="mb-3">
      <label for="emailID" class="form-label">Phone</label>
      <input type="text" value="" name="phone" class="form-control" data-bv-field="emailid" id="emailID" required="" placeholder="Enter Phone Number">
    </div>
    <div class="mb-3">
      <label for="emailID" class="form-label">Email</label>
      <input type="email" value="" name="email" class="form-control" data-bv-field="emailid" id="emailID" required="" placeholder="Enter Email">
    </div>
    <div class="mb-3">
      <label for="inputCountry" class="form-label">Showroom</label>
                <select class="form-select" id="inputCountry" name="showroom">
                  <option value="">Select Showroom</option>
                  @foreach ($list as $showroom )
                  <option value="{{$showroom->name}}">{{$showroom->name}}</option>
                  @endforeach
                </select> </div>
    <div class="mb-3">
      <label for="inputCountry" class="form-label">Roles</label>
                <select class="form-select" id="inputCountry"  name="roles[]" multiple>
                  <option value="">Select Roles</option>
                  @foreach ($roles as $role )
                  <option value="{{$role}}">{{$role}}</option>
                  @endforeach
                </select> </div>
    <div class="mb-3">
      <label for="emailID" class="form-label">Password</label>
      <input type="password" value="" name="password" class="form-control" data-bv-field="emailid" id="emailID" required="" placeholder="Enter Password">
    </div>
    <div class="mb-3">
      <label for="emailID" class="form-label">Password</label>
      <input type="password" value="" name="password_confirmation" class="form-control" data-bv-field="emailid" id="emailID" required="" placeholder="Enter Password">
    </div>
    
    
   
   
    <div class="d-grid mt-4"><button type="submit" class="btn btn-primary">Save</button></div>
  </form>