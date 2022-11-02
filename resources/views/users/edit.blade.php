<form action="{{route('users.update',$user->id)}}" method="POST">
    @csrf
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Name</label>
      <input type="text" name="name" value="{{$user->name}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
      
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Phone</label>
     <input type="text" class="form-control"  value="{{$user->phone}}" name="phone"required>
    
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Email</label>
     <input type="email" class="form-control" value="{{$user->email}}" name="email">
    
    </div>
    <div class="mb-3">
      <label for="inputCountry" class="form-label">Showroom</label>
                <select class="form-select" id="inputCountry" name="showroom" name="showroom">
                  <option value="">Select Showroom</option>
                  @foreach ($list as $showroom )
                  <option value="{{$showroom->name}}">{{$showroom->name}}</option>
                  @endforeach
                </select> </div>
    <div class="mb-3">
      <label for="inputCountry" class="form-label">Roles</label>
                <select class="form-select" id="inputCountry"  name="roles[]" multiple>
                  
                  @foreach ($roles as $role )
                  <option value="{{$role}}">{{$role}}</option>
                  @endforeach
                </select> </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Password</label>
     <input type="password" class="form-control" name="password">
    
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
     <input type="password" class="form-control" name="password_confirmation">
    
    </div>
   
    
    <button type="submit" class="btn btn-primary btn-sm text-white">Update</button>
  </form>