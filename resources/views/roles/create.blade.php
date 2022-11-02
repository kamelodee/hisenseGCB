<form id="form-send-money" method="post" action="{{route('roles.store')}}">
    @csrf
    <div class="mb-3">
      <label for="payerName" class="form-label">Name</label>
      <input type="text" value="" name="name" class="form-control" data-bv-field="payerName" id="payerName" required="" placeholder="Enter Name">
    </div>
    <div class="mb-3 p-3">
      <label for="payerName" class="form-label">Permissions</label>
      <div class="row">
        @foreach($permission as $value)
        <div class="form-check col-3">
            <input name="permission[]" class="form-check-input" type="checkbox" value="{{$value->name}}" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
             {{$value->name}}
            </label>
          </div>
            @endforeach
          </div>
        </div>
    <div class="d-grid mt-4"><button type="submit" class="btn btn-primary">Save</button></div>
  </form>